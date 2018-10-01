<?php
class Common extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}
	
	//----------------------------------- ADD EMPLOYEE ---------------------------------------------------//
	
	public function add_employee($arr)
	{
		$insertemp = array( "emp_name"   	=> $arr['emp_name'],
							"emp_email"	   	=> $arr['emp_email'],
							"emp_phone"  	=> $arr['emp_phone'],
							"emp_dob"    	=> $arr['emp_dob'],
							"emp_status"  	=> 1,
							"updated_date" 	=> date('Y-m-d,H:m:s'),
							"created_date" 	=> date('Y-m-d,H:m:s'),
							);
		$this->db->insert('employee_master',$insertemp);
	}
	
	//----------------------------------- UPDATE EMPLOYEE ---------------------------------------------------//
	
	
	public function employee_details()
	{
		$this->db->select('*');
		$this->db->from('employee_master');
		$this->db->where('emp_status =1 ');
		$qry 	= $this->db->get();
		$result = $qry->result_array();
		return $result;
	}
	
	public function edituser($aid)
	{
		$this->db->select('*');
		$this->db->from('employee_master');
		$this->db->where('emp_id',$aid);
		$qry = $this->db->get();
		$resp = $qry->result_array();
		$res = '';	
		$res.= '<input type="hidden" name="user_id" value="'.$resp[0]['emp_id'].'"/>
				<div class="row">
				<div class="col-md-7">
				   <div class="form-group">
					  <label>Employee Name</label>
					  <input type="text" name="emp_name" value="'.$resp[0]['emp_name'].'" class="form-control" />
				   </div>
				   <div class="form-group">
					  <label>Employee Email</label>
					  <input type="text" name="emp_email" pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" value="'.$resp[0]['emp_email'].'" class="form-control" />
				   </div>
				   <div class="form-group">
					  <label>Employee Phone</label>
					  <input type="text" name="emp_phone" minlength="10" maxlength="10"  pattern="[0-9]{10}" value="'.$resp[0]['emp_phone'].'" class="form-control" />
				   </div>
				   <div class="form-group">
					  <label>Employee DOB</label>
					  <input type="text" name="emp_dob" id="user_dob" value="'.$resp[0]['emp_dob'].'" class="form-control" />
				   </div>
				   </div>
				</div>';					
		return $res;
	}
	
	public function updateuser($arr)
	{
		$updatearr = array( "emp_name"      => $arr['emp_name'],
							"emp_email"  	=> $arr['emp_email'],
							"emp_phone"  	=> $arr['emp_phone'],
							"emp_dob"    	=> $arr['emp_dob'],
							"updated_date"	=> date('Y-m-d,H:m:s')
							);
		$this->db->where('emp_id',$arr['uid']);
		$this->db->update('employee_master',$updatearr);
	}
	
	//----------------------------------- DELETE EMPLOYEE ---------------------------------------------------//
	
	public function Deleteuser($hid)
	{
		$this->db->where('emp_id',$hid);
		$this->db->delete('employee_master');
	}
}