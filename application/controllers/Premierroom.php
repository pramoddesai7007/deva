<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premierroom extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model(array(
			'hotel_model'
		));
		$this->load->helper('captcha');
		$this->allmenu= $this->hotel_model->allmenu_dropdown();
		// $this->webinfo= $this->db->select('*')->from('common_setting')->get()->row();
		// $this->settinginfo= $this->db->select('*')->from('setting')->get()->row(); 
		// $this->storecurrency= $this->db->select('*')->from('currency')->where('currencyid',$this->settinginfo->currency)->get()->row();  
    }
	

public function index() {
   
    $page= $this->db->select('*')->from('page_title')->where('pageid',1)->get()->row();
    $data['title']= !empty($page->home) ? $page->home : null;
    $data['content']=$this->load->view('premierroom',$data,TRUE);
    $this->load->view('premierroom',$data);
    // application\modules\accounts\views\rooms.php
    
}

public function premierroom() {
   
    $page= $this->db->select('*')->from('page_title')->where('pageid',1)->get()->row();
    $data['title']= !empty($page->home) ? $page->home : null;
    $data['content']=$this->load->view('premierroom',$data,TRUE);
    $this->load->view('premierroom',$data);
    // application\views\deluxroom.php
    // application\modules\accounts\views\rooms.php
    
}






}