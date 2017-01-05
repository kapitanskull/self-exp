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
		$user1 = $this->user_m->getUser();
		$i = 1;
		foreach($user1->result() as $rowuser){
			echo "Number :" . $i++ . "<br />"; 
			echo "id :". $rowuser->id . "<br />";
			echo "name :" . $rowuser->user_name . "<br />";
			echo "email :" . $rowuser->user_email . "<br /><br />";
		}
		echo "<form action='test2' method='post'>
id:<br>
		<input type='text' name='id'>
		<input type='submit' value='Submit'>		
		</form>";
		
		echo "<br />";
			echo "<form action='test3' method='post'>
id:<br>
		<input type='text' name='email'>
		<input type='text' name='password'>
		<input type='submit' value='Submit'>		
		</form>";
		
	}
	
	public function test2(){
		$user2 = $this->user_m->getUserjson();
		$user = array();
		
		echo $user2->id;
		echo $user2->user_name;
		echo $user2->user_email;
		
		$arryuser =  array('name' => $user2->user_name, 'email' => $user2->user_email);
		echo "<br />" . json_encode($arryuser) . "<br />";
		 $rs = json_encode($arryuser);
		$ds_user = json_decode($rs, true);
		echo $ds_user['name'];
		
	}
	
	public function test3(){
		$rs = $this->user_m->verify();
		
		$arr_response = array('response'=>$rs);
		echo "<br />" . json_encode($arr_response) . "<br />";
		// $rs = json_encode($arryuser);
		// $ds_user = json_decode($rs, true);
	}
}
