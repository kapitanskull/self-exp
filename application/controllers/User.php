<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_m');
	}
	
	public function index(){
		redirect('user/test1');
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
		
	}
	
	public function register(){
		if($_POST){
			$rs = $this->user_m->add();
			$mesej = $this->session->flashdata('mesej');
			
			$arr_response = array(
				'response'=>$rs, // either true or false.
				'mesej' => $mesej // message that will be display for user .
			);
		
			echo json_encode($arr_response);
		}
	}
	
	public function login(){
		if($_POST){
			$rs = $this->user_m->verify();
			$mesej = $this->session->flashdata('mesej');
		
			if($rs === false){
				$arr_response = array(
					'response'=>$rs,
					'mesej'=>$mesej
				);
			}
		
			#if user enter correct password and email all this details will be sent to user
			else{
				$arr_response = array(
					'response'=>true,
					'name'=>$rs->user_name, 
					'email'=> $rs->user_email,
					'id'=>$rs->id
				);
			}
		
			echo json_encode($arr_response);	
		}
	}
	
}
//author by the kapitan.
