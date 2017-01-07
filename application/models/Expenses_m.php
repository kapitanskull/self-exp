<?php
class Expenses_m extends CI_Model
{
	function _construct()
	{
		parent::_construct();// Call the Model constructor
	}
		
	function listing(){
		$user_id = $this->input->post('user_id');
		$query = $this->db->query("SELECT * FROM expenses WHERE user_id=" . $this->db->escape($user_id));
		
		if($query->num_rows()> 0 ){
			return $query;
		}
		else{
			return false;
		}
	}	
	
	function expenses_add(){
		$todaytdate = date("Y-m-d");
		
		$DBdata = array(
			'user_id' => trim($this->input->post('user_id')),
			'expenses_category' => trim($this->input->post('expenses_category')),
			'expenses_image' => trim($this->input->post('expenses_image')),
			'expenses_amount' => trim($this->input->post('expenses_amount')),
			'expenses_date' => trim($this->input->post('expenses_date'))
		);
		
		if($DBdata['user_id'] == ''){
			$this->set_message("mesej", "Require user id");
			return false;
		}
		
		if($DBdata['expenses_category'] == ''){
			$this->set_message("mesej", "Please enter expenses category");
			return false;
		}
		
		if($DBdata['expenses_amount'] == ''){
			$this->set_message("mesej", "Please enter expenses amount");
			return false;
		}
		if(!is_numeric($DBdata['expenses_amount'])) {
			$this->set_message("mesej", "expenses amount contain number only");
			return false;
		}
		if($DBdata['expenses_amount']!= '' AND is_numeric($DBdata['expenses_amount'])){
			$DBdata['expenses_amount']  = number_format($DBdata['expenses_amount'],2);
		}
		
		if($DBdata['expenses_date'] == ''){
			$this->set_message("mesej", "Please enter expenses amount");
			return false;
		}
		
		$rs = $this->db->insert('expenses', $DBdata);
		$insert_id = $this->db->insert_id();
		$this->set_message("mesej", "Successfully register");
		return $rs;
		
	}
	
	function total_expenses(){
		$user_id = $this->input->post('user_id');
		if($user_id > 0){
			$sql = "SELECT * FROM expenses WHERE user_id = " .  $this->db->escape($user_id);
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

