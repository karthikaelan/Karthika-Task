<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	
	public function index()
	{
		$data = array();
		$data['emp_details'] = $this->Common->employee_details();
		$this->load->view('home',$data);
	}
	
	//----------------------------------- ADD EMPLOYEE ---------------------------------------------------//
	
	public function add_employee()
	{
		$arr = array();
		$arr['emp_name'] 	= 	$this->input->post('emp_name');
		$arr['emp_email'] 	= 	$this->input->post('emp_email');
		$arr['emp_phone'] 	= 	$this->input->post('emp_phone');
		$arr['emp_dob'] 	= 	$this->input->post('emp_dob');
		$add_employee 		= 	$this->Common->add_employee($arr);
		redirect( SITE_URL );	
	}
	
	//----------------------------------- UPDATE EMPLOYEE ---------------------------------------------------//
	
	
	public function edituser()
	{
		$urlid = $this->uri->segment(3);
		$res = $this->Common->edituser($urlid);
		echo $res;
	}
	
	public function updateuser()
	{
		$arr = array();
		$arr['uid']   		=	$this->input->post('user_id');
		$arr['emp_name']  	= 	$this->input->post('emp_name');
		$arr['emp_email']  	=	$this->input->post('emp_email');
		$arr['emp_phone'] 	= 	$this->input->post('emp_phone');
		$arr['emp_dob']		= 	$this->input->post('emp_dob');
		$this->Common->updateuser($arr);
		redirect(SITE_URL);
	}
	
	//----------------------------------- DELETE EMPLOYEE ---------------------------------------------------//
	
	
	public function deleteuser()
	{
		$rid = $this->input->post('rid');
		$this->Common->Deleteuser($rid);
	}
}