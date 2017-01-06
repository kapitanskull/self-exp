<?php
class Expenses_m extends CI_Model
{
	function _construct()
	{
		parent::_construct();// Call the Model constructor
	}
		
	function add(){
		 $DBdata = array(
			'user_name' => trim($this->input->post('name')),
			'user_email' => trim($this->input->post('email')),
		);
		
		if($DBdata['user_name'] == ''){
			$this->set_message("mesej", "Please enter your name");
			return false;
		}
		
		if($DBdata['user_email'] == ''){
			$this->set_message("mesej", "Please enter your email");
			return false;
		}
		
		if($DBdata['user_email'] != ''){
			if (!filter_var($DBdata['user_email'], FILTER_VALIDATE_EMAIL)) {
				$this->set_message("mesej", "Invalid email format");
				return false;
			}
			
			$sql = "SELECT * FROM users WHERE user_email = " . $this->db->escape($DBdata['user_email']);			
		    $query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				$this->set_message("mesej", "This email already been registered");
				return false;
			}
		}
		
		if($this->input->post('password') == ''){
			$this->set_message("mesej", "Please enter your password");
			return false;
		}
		
		if($this->input->post('password') != '') {
	    	if(md5(trim($this->input->post('rpassword'))) != md5(trim($this->input->post('password')))) {
				$this->set_message("mesej", "Re-type Password does not match. Please try again.");
	    		return false;
	    	}
	    	$DBdata['user_password'] = md5(trim($this->input->post('password')));
    	}
		
		$rs = $this->db->insert('users', $DBdata);
		$insert_id = $this->db->insert_id();
		$this->set_message("mesej", "Successfully register");
		return $rs;
	}
	
	
	
	function set_message($status,$mesej){
		$this->session->set_flashdata($status,$mesej);
	}
}// end of class Model_users extend CI_Model

