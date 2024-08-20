<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roomcompanidetails_model extends CI_Model {
	
	private $table = 'roomcompanydetails';
 
	public function create($data = array())
	{ 
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('companyid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($data = array())
	{
		return $this->db->where('companyid',$data["companyid"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	    $this->db->select('roomcompanydetails.*,roomfacilitytype.facilitytypetitle');
        $this->db->from($this->table);
		$this->db->join('roomfacilitytype','roomfacilitytype.facilitytypeid=roomcompanydetails.facilitytypeid','left');
        $this->db->order_by('roomcompanydetails.companyid', 'desc');
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
			->where('companyid',$id) 
			->get()
			->row();
	} 

 
public function countlist()
	{
		$this->db->select('roomcompanydetails.*,roomfacilitytype.facilitytypetitle');
        $this->db->from($this->table);
		$this->db->join('roomfacilitytype','roomfacilitytype.facilitytypeid=roomcompanydetails.facilitytypeid','left');
        $this->db->order_by('roomcompanydetails.companyid', 'desc');
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

	public function company_dropdown()
	{
		$data = $this->db->select("*")
			->from('roomcompanydetails')
			->get()
			->result();

		$list[''] = 'Select Company';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->companyid] = $value->name;
			return $list;
		} else {
			return false; 
		}
	}
    
}
