<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('income_m');
	}
	
	public function index(){
		redirect('income/test1');
	}
	
	public function test1(){
		
		#this all for testing purpose.after this form will be delete
		echo "<form action='register' method='post'>
		FORM<br>
		<input type='text' name='name' placeholder='name'>
		<input type='text' name='email' placeholder='email'>
		<input type='text' name='password' placeholder='password'>
		<input type='text' name='rpassword' placeholder='rpassword'>
		<input type='submit' value='Submit'>		
		</form>";
		
		echo "<br />";
			echo "<form action='login' method='post'>
		id:<br>
		<input type='text' name='email' placeholder='email'>
		<input type='text' name='password' placeholder='password'>
		<input type='submit' value='Submit'>		
		</form>";
		
			echo "<br />";
			echo "<form action='listing' method='post'>
		id for listing:<br>
	
		<input type='text' name='id' placeholder='id'>
		<input type='submit' value='Submit'>		
		</form>";
		
	}
	
	public function listing(){
		$data = array();
		if($_POST){
			$que = $this->income_m->listing();
			
			if($que === false){
				$arr_response = array(
					'response'=>$que,
					'mesej'=>"No data has found"
				);
				echo json_encode($arr_response);
			}
			else{
				foreach($que->result_array() as $inc_row){
					echo json_encode($inc_row);
				}
				$re = json_decode($inc_row,true);
				echo $re;
			}
		}
	}
	
	public function add(){
		if($_POST){
			$rs = $this->income_m->income_add();
		}
	}
	
}
//author by the kapitan.
