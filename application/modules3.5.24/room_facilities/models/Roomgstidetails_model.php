<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roomgstidetails_model extends CI_Model {
	
	private $table = 'roomgstdetails';
 
	public function create($data = array())
	{ 
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('gstid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($data = array())
	{
		return $this->db->where('gstid',$data["gstid"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	    $this->db->select('roomgstdetails.*,roomfacilitytype.facilitytypetitle');
        $this->db->from($this->table);
		$this->db->join('roomfacilitytype','roomfacilitytype.facilitytypeid=roomgstdetails.facilitytypeid','left');
        $this->db->order_by('roomgstdetails.gstid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('gstid',$id) 
			->get()
			->row();
	} 

 
public function countlist()
	{
		$this->db->select('roomgstdetails.*,roomfacilitytype.facilitytypetitle');
        $this->db->from($this->table);
		$this->db->join('roomfacilitytype','roomfacilitytype.facilitytypeid=roomgstdetails.facilitytypeid','left');
        $this->db->order_by('roomgstdetails.gstid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
 public function allfacilitytype()
	{
		$data = $this->db->select("*")
			->from('roomfacilitytype')
			->get()
			->result();

		$list[''] = 'Select Facility Type';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->facilitytypeid] = $value->facilitytypetitle;
			return $list;
		} else {
			return false; 
		}
	}

	public function gst_dropdown()
	{
		$data = $this->db->select("*")
			->from('roomgstdetails')
			->get()
			->result();

		$list[''] = 'Select Company';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->gstid] = $value->name;
			return $list;
		} else {
			return false; 
		}
	}

	public function check_already_from_limit_exist($fromgst = NULL){
		return $query = $this->db->query("SELECT * from roomgstdetails where '$fromgst' BETWEEN `fromgst` AND `togst`")->result();
	}
    
}
