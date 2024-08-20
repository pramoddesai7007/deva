<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_companidetails extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'roomcompanidetails_model'
		));	
    }
    public function testdatatable(){
		$this->permission->method('room_companies','read')->redirect();
        $data['title']    = display('room_companies_list'); 
		$data['module'] = "room_facilities";
        $data['page']   = "roomcompanydetailslist";   
        echo Modules::run('template/layout', $data); 
		}
	
	public function responses(){
		$params = $columns = $totalRecords = $data = array();
		$params = $_REQUEST;
	    $columns = array( 
		0 => 'roomcompanydetails.companyid', 
		1 => 'name', 
		2 => 'name'
	);

	$where = $sqlTot = $sqlRec = "";
	// check search value exist
	if(!empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( roomfacilitytype.facilitytypetitle LIKE '".$params['search']['value']."%' ";    
		$where .=" OR roomcompanydetails.name LIKE '".$params['search']['value']."%' )";
	}
	// getting total number records without any search
	$sql = "SELECT roomcompanydetails.*,roomfacilitytype.facilitytypetitle FROM roomcompanydetails Left Join roomfacilitytype ON roomfacilitytype.facilitytypeid=roomcompanydetails.facilitytypeid";
	
	
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && ($where != '')) {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}
	
 	$sqlRec .=  " ORDER BY ".$columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";
	$SQLtotal=$this->db->query($sqlTot);
	$SQLoffer=$this->db->query($sqlRec);
	$totalRecords = $SQLtotal->num_rows();	
	$queryRecords=$SQLoffer->result();
	$i=0;
	foreach($queryRecords as  $value){
		$i++;
		$row = array();
		$update='';
		$delete='';
		if($this->permission->method('room_companies','update')->access()):
		$update='<input name="url" type="hidden" id="url_'.$value->companyid.'" value="'.base_url().'room_facilities/room_companidetails/updateintfrm" /><a onclick="editinforoom('.$value->companyid.')" class="btn btn-info btn-sm margin_right_5px" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>';
		endif;
		 if($this->permission->method('room_companies','delete')->access()):
		 $delete='<input name="delurl" type="hidden" id="delurl_'.$value->companyid.'" value="'.base_url().'room_facilities/room-company-details-delete/'.$value->companyid.'" /><a onclick="deleteitem('.$value->companyid.');" class="btn btn-danger btn-sm color_fff" data-toggle="tooltip" data-placement="right" title="Delete "><i class="ti-trash text-white"></i></a>';
		 endif;
		$row[] =$i;
		$row[] =$value->name;
		$row[] =$value->address;
		// $row[] =$value->contact_person;
		$row[] =$value->contact_person;
		$row[] =$value->contact;
		$row[] =$update.$delete;
        $data[] = $row;
		
		}
	
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);
	
	}
    public function index($id = null)
    { 
		$this->permission->method('room_companies','read')->redirect();
        $data['title']    = 'Company Details'; 
		$data['facilitytype']   = $this->roomcompanidetails_model->allfacilitytype();

		$data['module'] = "room_facilities";
        $data['page']   = "roomcompanydetailslist";   
        echo Modules::run('template/layout', $data);

    }
	
	
    public function create($id = null)
    {
	  $data['title'] = 'Room Size';
	  //$this->form_validation->set_rules('facilititypeyname',display('add_facility_type'),'required|xss_clean');
	  $this->form_validation->set_rules('name',display('name'),'required|max_length[50]|xss_clean');
	  $saveid=$this->session->userdata('id');
	  $data['intinfo']="";

	  if ($this->form_validation->run()) {
		/*$img = $this->fileupload->do_upload(
			'application/modules/room_facilities/assets/images/','facilitypicture'
		);
		// if favicon is uploaded then resize the favicon
		if ($img !== false && $img != null) {
			$this->fileupload->do_resize(
				$img, 
				50,
				50
			);
		}*/
		//if favicon is not uploaded
		/*if ($img === false) {
			$this->session->set_flashdata('exception', "Please Upload a Valid Image");
		}*/

	   if(empty($this->input->post('companyid', TRUE))) {
		$facility = $this->input->post('facilititypeyname',TRUE);
		$name = $this->input->post('name',TRUE);
		$this->db->where('LOWER(name)',strtolower($name));
		$this->db->FROM('roomcompanydetails');
		$query = $this->db->get();
		$result = $query->row();

		if($result<=0){
		 $data['room_companies']   = (Object) $postData = array(
		   'companyid'     	 => $this->input->post('companyid', TRUE),
		   'facilitytypeid'      => $this->input->post('facilititypeyname', TRUE),
		   'name'  => $this->input->post('name',TRUE),
		   'address'  => $this->input->post('address',TRUE),
		   'contact_person'  => $this->input->post('contact_person',TRUE),
		   'contact'  => $this->input->post('contact',TRUE),
		   'image' => $img,
		  );


		} else {
			$this->session->set_flashdata('exception',  display('facility_details'));
			redirect("room_facilities/room-company-details-list"); 
		   }
		$this->permission->method('room_companies','create')->redirect();

		if ($this->roomcompanidetails_model->create($postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('room_facilities/room-company-details-list');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("room_facilities/room-company-details-list"); 
	
	   } else {
		$this->permission->method('room_companies','update')->redirect();
		$id = $this->input->post('companyid', TRUE);
		$imageinfo=$this->db->select('*')->from('roomcompanydetails')->where('companyid',$id)->get()->row();
		if(!empty($img)){
		   unlink($imageinfo->image);
		  }
		  else{
			  $img=$imageinfo->image;
			  } 
		$data['room_companies']   = (Object) $postData = array(
		    'companyid'     	 => $this->input->post('companyid', TRUE),
		   'facilitytypeid'      => $this->input->post('facilititypeyname', TRUE),
		   'name' 	  => $this->input->post('name',TRUE),
		   'address'  => $this->input->post('address',TRUE),
		   'contact_person'  => $this->input->post('contact_person',TRUE),
		   'contact'  => $this->input->post('contact',TRUE),
		   'image' 	     		 => $img
		  );
	 
		if ($this->roomcompanidetails_model->update($postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("room_facilities/room-company-details-list");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('room_companies_edit');
		$data['intinfo']   = $this->roomcompanidetails_model->findById($id);
	   }
	   $data['facilitytype']   = $this->roomcompanidetails_model->allfacilitytype();
	   $data['module'] = "room_facilities";
	   $data['page']   = "roomcompanydetailslist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
	}
   public function updateintfrm($id){
	  
		$this->permission->method('room_companies','update')->redirect();
		$data['title'] = display('room_companies_edit');
		$data['intinfo']   = $this->roomcompanidetails_model->findById($id);
		$data['facilitytype']   = $this->roomcompanidetails_model->allfacilitytype();
        $data['module'] = "room_facilities";  
        $data['page']   = "roomcompanydetailsedit";
		$this->load->view('room_facilities/roomcompanydetailsedit', $data);   
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('room_companies','delete')->redirect();
		
		if ($this->roomcompanidetails_model->delete($id)) {
			$this->db->where("companyid",$id)->delete("roomfaility_ref_accomodation");
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('room_facilities/room-company-details-list');
    }
 
}
