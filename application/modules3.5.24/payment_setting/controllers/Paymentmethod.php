<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmethod extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'payment_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('payment_setting','read')->redirect();
        $data['title']    = "Payment Method"; 
        #
        #pagination starts
        #
        $config["base_url"] = base_url('payment_setting/paymentmethod/index');
        $config["total_rows"]  = $this->payment_model->countlist();
        $config["per_page"]    = 15;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["paymentlist"] = $this->payment_model->read();
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "payment_setting";
        $data['page']   = "paymentlist";   
        echo Modules::run('template/layout', $data); 
    }
	
    public function create($id = null)
    {
	  $data['title'] = display('payment_add');
		$this->form_validation->set_rules('payment',display('payment_name'),'required|xss_clean');
		$this->form_validation->set_rules('status',display('status')  ,'required|xss_clean');
	   $saveid=$this->session->userdata('id');
	   $data['payments']   = (Object) $postData = [
		   'payment_method_id'   => $this->input->post('payment_method_id', TRUE),
		   'payment_method' 	 => $this->input->post('payment',TRUE),
		   'is_active' 	 		 => $this->input->post('status',TRUE),
		  ]; 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('payment_method_id', TRUE))) {
		
		$this->permission->method('payment_setting','create')->redirect();
		if ($this->payment_model->create($postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('payment_setting/payment-method-list');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("payment_setting/payment-method-list"); 
	
	   } else {
		$this->permission->method('payment_setting','update')->redirect();
		
	 
		if ($this->payment_model->update($postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("payment_setting/payment-method-list");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
	   }

	   $data['module'] = "payment_setting";
	   $data['page']   = "membershiplist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('payment_setting','update')->redirect();
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
        $data['module'] = "payment_setting";  
        $data['page']   = "paymentedit";
		$this->load->view('payment_setting/paymentedit', $data);   
	   }
	
	/**************Paymentsetup******************/
	
	public function paymentsetup($id = null)
    {
        
		$this->permission->method('payment_setting','read')->redirect();
        $data['title']    = display('paymentmethod_setup'); 
        #
        #pagination starts
        #
        $config["base_url"] = base_url('payment_setting/paymentmethod/paymentsetup');
        $config["total_rows"]  = $this->payment_model->countsetuplist();
        $config["per_page"]    = 15;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["psetuplist"] = $this->payment_model->setupread();
        $data["links"] = $this->pagination->create_links();
		$data['paymentlist']   =  $this->payment_model->payment_dropdown();
		$data['currency_list'] = array(
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
		if(!empty($id)) {
		$data['title'] = display('edit_setup');
		$data['intinfo']   = $this->payment_model->psetupById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "payment_setting";
        $data['page']   = "paymentsetup";   
        echo Modules::run('template/layout', $data); 
    }
	
	public function psetupcreate($id = null)
    {
	  $data['title'] = display('add_paymentsetup');
	   $this->form_validation->set_rules('payment',display('payment_name'),'required|max_length[50]|xss_clean');
	   $this->form_validation->set_rules('status',display('status')  ,'required|xss_clean');
	   $saveid=$this->session->userdata('id');
	   $data['payments']   = (Object) $postData = array(
		   'setupid'             => $this->input->post('setupid', TRUE),
		   'paymentid' 	         => $this->input->post('payment',TRUE),
		   'marchantid' 	     => $this->input->post('marchantid',TRUE),
		   'password' 	         => $this->input->post('password',TRUE),
		   'email' 	             => $this->input->post('email',TRUE),
		   'currency' 	         => $this->input->post('currency',TRUE),
		   'Islive' 	         => $this->input->post('islive',TRUE),
		   'status' 	 		 => $this->input->post('status',TRUE),
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('setupid', TRUE))) {
		
		$this->permission->method('payment_setting','create')->redirect();
	
		if ($this->payment_model->psetupcreate($postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('payment_setting/payment-setup');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("payment_setting/payment-setup"); 
	
	   } else {
		$this->permission->method('payment_setting','update')->redirect();
	
		if ($this->payment_model->psetupupdate($postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("payment_setting/payment-setup");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_setup');
		$data['intinfo']   = $this->payment_model->psetupById($id);
	   }
	   $data['paymentlist']   =  $this->payment_model->payment_dropdown();
	   $data['currency_list'] = array(
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
	   $data['module'] = "payment_setting";
	   $data['page']   = "paymentsetup";   
	   echo Modules::run('template/layout', $data); 
	   }   
    }
   public function psetupupdateintfrm($id){
	  
		$this->permission->method('payment_setting','update')->redirect();
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->psetupById($id);
		$data['paymentlist']   =  $this->payment_model->payment_dropdown();
		 $data['currency_list'] = array(
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
        $data['module'] = "payment_setting";  
        $data['page']   = "paymentsetupedit";
		$this->load->view('payment_setting/paymentsetupedit', $data);   
	   }
 
}
