<?php
class Income_m extends CI_Model
{
	function _construct()
	{
		parent::_construct();// Call the Model constructor
	}
	
	function listing(){
		$user_id = $this->input->post('user_id');
		$query = $this->db->query("SELECT * FROM income WHERE user_id=" . $this->db->escape($user_id));
		
		if($query->num_rows()> 0 ){
			return $query;
		}
		else{
			return false;
		}
	}	
	
	function income_add(){
		$todaytdate = date("Y-m-d");
		
		$DBdata = array(
			'user_id' => trim($this->input->post('user_id')),
			'income_category' => trim($this->input->post('income_category')),
			'income_image' => trim($this->input->post('income_image')),
			'income_amount' => trim($this->input->post('income_amount')),
			'income_date' => trim($this->input->post('income_date'))
		);
		
		if($DBdata['user_id'] == ''){
			$this->set_message("mesej", "Require user id");
			return false;
		}
		
		if($DBdata['income_category'] == ''){
			$this->set_message("mesej", "Please enter income category");
			return false;
		}
		
		if($DBdata['income_amount'] == ''){
			$this->set_message("mesej", "Please enter income amount");
			return false;
		}
		if(!is_numeric($DBdata['income_amount'])) {
			$this->set_message("mesej", "Income amount contain number only");
			return false;
		}
		if($DBdata['income_amount']!= '' AND is_numeric($DBdata['income_amount'])){
			$DBdata['income_amount']  = number_format($DBdata['income_amount'],2);
		}
		
		if($DBdata['income_date'] == ''){
			$this->set_message("mesej", "Please enter income amount");
			return false;
		}
		
		$rs = $this->db->insert('income', $DBdata);
		$insert_id = $this->db->insert_id();
		$this->set_message("mesej", "Successfully register");
		return $rs;
		
	}
	
	function total_income(){
		$user_id = $this->input->post('user_id');
		if($user_id > 0){
			$sql = "SELECT * FROM income WHERE user_id = " .  $this->db->escape($user_id);
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0){
				return $query;
			}
			else{
				return false;
			}
		}
		else
			return false;
	}
	
	function set_message($status,$mesej){
		$this->session->set_flashdata($status,$mesej);
	}
}// end of class Model_users extend CI_Model

