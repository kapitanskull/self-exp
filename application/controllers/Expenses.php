<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->load->model('expenses_m');
	}
	
	public function index(){
		redirect('expenses/test1');
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
	
}
//author by the kapitan.
