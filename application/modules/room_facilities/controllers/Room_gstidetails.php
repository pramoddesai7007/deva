<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_gstidetails extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'roomgstidetails_model'
		));	
    }
    public function testdatatable(){
		$this->permission->method('room_gsties','read')->redirect();
        $data['title']    = display('room_gsties_list'); 
		$data['module'] = "room_facilities";
        $data['page']   = "roomgstdetailslist";   
        echo Modules::run('template/layout', $data); 
		}
	
	public function responses(){
		$params = $columns = $totalRecords = $data = array();
		$params = $_REQUEST;
	    $columns = array( 
		0 => 'roomgstdetails.gstid', 
		1 => 'name', 
		2 => 'name'
	);

	$where = $sqlTot = $sqlRec = "";
	// check search value exist
	if(!empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( roomfacilitytype.facilitytypetitle LIKE '".$params['search']['value']."%' ";    
		$where .=" OR roomgstdetails.name LIKE '".$params['search']['value']."%' )";
	}
	// getting total number records without any search
	$sql = "SELECT roomgstdetails.*,roomfacilitytype.facilitytypetitle FROM roomgstdetails Left Join roomfacilitytype ON roomfacilitytype.facilitytypeid=roomgstdetails.facilitytypeid";
	
	
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
		if($this->permission->method('room_gsties','update')->access()):
		$update='<input name="url" type="hidden" id="url_'.$value->gstid.'" value="'.base_url().'room_facilities/room_gstidetails/updateintfrm" /><a onclick="editinforoom('.$value->gstid.')" class="btn btn-info btn-sm margin_right_5px" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>';
		endif;
		 if($this->permission->method('room_gsties','delete')->access()):
		 $delete='<input name="delurl" type="hidden" id="delurl_'.$value->gstid.'" value="'.base_url().'room_facilities/room-gst-details-delete/'.$value->gstid.'" /><a onclick="deleteitem('.$value->gstid.');" class="btn btn-danger btn-sm color_fff" data-toggle="tooltip" data-placement="right" title="Delete "><i class="ti-trash text-white"></i></a>';
		 endif;
		$row[] =$i;
		$row[] =$value->fromgst;
		$row[] =$value->togst;
		$row[] =$value->gst;
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
		$this->permission->method('room_gsties','read')->redirect();
        $data['title']    = 'Company Details'; 
		$data['facilitytype']   = $this->roomgstidetails_model->allfacilitytype();

		$data['module'] = "room_facilities";
        $data['page']   = "roomgstdetailslist";   
        echo Modules::run('template/layout', $data);

    }
	
	
    public function create($id = null)
    {
	  $data['title'] = 'Room Size';
	  $fromgst = $this->input->post('fromgst');
	  $togst   = $this->input->post('togst');
	  $gst     = $this->input->post('gst');

	  if($fromgst >= $togst){
	    $this->session->set_flashdata('exception', "Enter GST Range from limit is less than to limit");
	    $data['module'] = "room_facilities";
		$data['page']   = "roomgstdetailslist";   
		echo Modules::run('template/layout', $data);
		return false;
	  }

	  $get_fromlimit   = $this->roomgstidetails_model->check_already_from_limit_exist($fromgst);

	  if(!empty($get_fromlimit)){ 
	  	$this->session->set_flashdata('exception', "GST Range From limit is already exist");

	    $data['module'] = "room_facilities";
		$data['page']   = "roomgstdetailslist";   
		echo Modules::run('template/layout', $data); 
		return false;
	  }

	  //$this->form_validation->set_rules('facilititypeyname',display('add_facility_type'),'required|xss_clean');
	  $this->form_validation->set_rules('gst',display('gst'),'required|max_length[50]|xss_clean'); 

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

	   if(empty($this->input->post('gstid', TRUE))) {  
		$facility = $this->input->post('facilititypeyname',TRUE);
		$name = $this->input->post('gst',TRUE);
		$this->db->where('LOWER(gst)',strtolower($name));
		$this->db->FROM('roomgstdetails');
		$query = $this->db->get();
		$result = $query->row();

		if($result<=0){
		 $data['room_gsties']   = (Object) $postData = array(
		   'gstid'     	 => $this->input->post('gstid', TRUE),
		   'facilitytypeid'      => $this->input->post('facilititypeyname', TRUE),
		   'fromgst'=> $this->input->post('fromgst',TRUE),
		   'togst'  => $this->input->post('togst',TRUE),
		   'gst'    => $this->input->post('gst',TRUE),
		  );


		} else {
			$this->session->set_flashdata('exception',  display('facility_details'));
			redirect("room_facilities/room-gst-details-list"); 
		   }
		$this->permission->method('room_gsties','create')->redirect();

		if ($this->roomgstidetails_model->create($postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('room_facilities/room-gst-details-list');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("room_facilities/room-gst-details-list"); 
	
	   } else {
		$this->permission->method('room_gsties','update')->redirect();
		$id = $this->input->post('gstid', TRUE);
		$imageinfo=$this->db->select('*')->from('roomgstdetails')->where('gstid',$id)->get()->row();
		if(!empty($img)){
		   unlink($imageinfo->image);
		  }
		  else{
			  $img=$imageinfo->image;
			  } 
		$data['room_gsties']   = (Object) $postData = array(
		    'gstid'     	 => $this->input->post('gstid', TRUE),
		   'facilitytypeid'      => $this->input->post('facilititypeyname', TRUE),
		   'fromgst'=> $this->input->post('fromgst',TRUE),
		   'togst'  => $this->input->post('togst',TRUE),
		   'gst'    => $this->input->post('gst',TRUE),
		  );
	 
		if ($this->roomgstidetails_model->update($postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("room_facilities/room-gst-details-list");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('room_gsties_edit');
		$data['intinfo']   = $this->roomgstidetails_model->findById($id);
	   }
	   $data['facilitytype']   = $this->roomgstidetails_model->allfacilitytype();
	   $data['module'] = "room_facilities";
	   $data['page']   = "roomgstdetailslist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
	}
   public function updateintfrm($id){
	  
		$this->permission->method('room_gsties','update')->redirect();
		$data['title'] = display('room_gsties_edit');
		$data['intinfo']   = $this->roomgstidetails_model->findById($id);
		$data['facilitytype']   = $this->roomgstidetails_model->allfacilitytype();
        $data['module'] = "room_facilities";  
        $data['page']   = "roomgstdetailsedit";
		$this->load->view('room_facilities/roomgstdetailsedit', $data);   
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('room_gsties','delete')->redirect();
		
		if ($this->roomgstidetails_model->delete($id)) {
			$this->db->where("gstid",$id)->delete("roomfaility_ref_accomodation");
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('room_facilities/room-gst-details-list');
    }
 
}
