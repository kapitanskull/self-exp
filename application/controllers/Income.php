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
		echo "<form action='add' method='post'>
		FORM test add income <br>
		<input type='text' name='user_id' placeholder='user_id'>
		<input type='text' name='income_category' placeholder='income_category'>
		<input type='text' name='income_image' placeholder='income_image path'>
		<input type='text' name='income_date' placeholder='income_date'>
		<input type='text' name='income_amount' placeholder='income_amount'>
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
		id for listing income:<br>
	
		<input type='text' name='user_id' placeholder='id'>
		<input type='submit' value='Submit'>		
		</form>";
		
		echo "<br />";
			echo "<form action='total_income' method='post'>
		id for listing details total income:<br>
	
		<input type='text' name='user_id' placeholder='id'>
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
				$data = array(); 
				foreach($que->result_array() as $inc_row){
					echo json_encode($inc_row);
				}
			}
		}
	}
	
	public function add(){
		if($_POST){
			$rs = $this->income_m->income_add();
			$mesej = $this->session->flashdata('mesej');
			
			$arr_response = array(
				'response'=>$rs, // either true or false.
				'mesej' => $mesej // message that will be display for user .
			);
		
			echo json_encode($arr_response);
		}
	}
	
	public function total_income(){
		if($_POST){
			$today_income = 0;
			$week_income = 0;
			$today_income = 0;
			$weekly_income = 0;
			$month_income = 0;
			$year_income = 0;
			$todaytdate = date("Y-m-d");
			$prev_date = date("Y-m-d", strtotime("-1 week", strtotime($todaytdate)));
			$current_month = date("m" , strtotime($todaytdate));
			$current_year = date("Y" , strtotime($todaytdate));
			echo  "the date one week before today date = " . $prev_date . "<br />";
			echo  "today date = " . $todaytdate . "<br />";
			echo  "Current month = " . $current_month . "<br />";
			echo  "Current year = " . $current_year . "<br /><br />";
				
			$rs = $this->income_m->total_income();
			
			if($rs !== false){
				foreach($rs->result() as $row){
					$month = date("m", strtotime($row->income_date));
					$year = date("Y", strtotime($row->income_date));
					
					if( strtotime($row->income_date) == strtotime($todaytdate)){
						$today_income += $row->income_amount;
					}
					if((strtotime($row->income_date) >= strtotime($prev_date)) AND (strtotime($row->income_date) <= strtotime($todaytdate))){
						$weekly_income += $row->income_amount;
					}
					if($month == $current_month){
						$month_income += $row->income_amount;
					}
					if($year == $current_year){
						$year_income +=  $row->income_amount;
					}
				}
				
				echo  "Today income = RM " . number_format($today_income, 2) . "<br /> Weekly income = RM " . number_format($weekly_income, 2) . "<br /> Monthly income = RM " . number_format($month_income, 2) . "<br /> Year income = RM " . number_format($year_income, 2) . "<br/><br/>";
			}
			
			$arr_response = array(
				'today_income' => number_format($today_income, 2),
				'weekly_income'=> number_format($weekly_income, 2),
				'month_income'=> number_format($month_income, 2),
				'year_income'=> number_format($year_income, 2),
			);
			
			echo json_encode($arr_response);

		}
	}
	
}
//author by the kapitan.
