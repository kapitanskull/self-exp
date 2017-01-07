<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('expenses_m');
	}
	
	public function index(){
		redirect('expenses/test1');
	}
	
	public function test1(){
		
		#this all for testing purpose.after this form will be delete
		echo "<form action='add' method='post'>
		FORM test add expenses <br>
		<input type='text' name='user_id' placeholder='user_id'>
		<input type='text' name='expenses_category' placeholder='expenses_category'>
		<input type='text' name='expenses_image' placeholder='expenses_image path'>
		<input type='text' name='expenses_date' placeholder='expenses_date'>
		<input type='text' name='expenses_amount' placeholder='expenses_amount'>
		<input type='submit' value='Submit'>		
		</form>";
		
		echo "<br />";
			echo "<br />";
			echo "<form action='listing' method='post'>
		id for listing expenses:<br>
	
		<input type='text' name='user_id' placeholder='id'>
		<input type='submit' value='Submit'>		
		</form>";
		
		echo "<br />";
			echo "<form action='total_expenses' method='post'>
		id for listing details total expenses:<br>
	
		<input type='text' name='user_id' placeholder='id'>
		<input type='submit' value='Submit'>		
		</form>";
		
	}
	
	public function listing(){
		$data = array();
		if($_POST){
			$que = $this->expenses_m->listing();
			
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
			$rs = $this->expenses_m->expenses_add();
			$mesej = $this->session->flashdata('mesej');
			
			$arr_response = array(
				'response'=>$rs, // either true or false.
				'mesej' => $mesej // message that will be display for user .
			);
		
			echo json_encode($arr_response);
		}
	}
	
	public function total_expenses(){
		if($_POST){
			$today_expenses = 0;
			$week_expenses = 0;
			$today_expenses = 0;
			$weekly_expenses = 0;
			$month_expenses = 0;
			$year_expenses = 0;
			$todaytdate = date("Y-m-d");
			$prev_date = date("Y-m-d", strtotime("-1 week", strtotime($todaytdate)));
			$current_month = date("m" , strtotime($todaytdate));
			$current_year = date("Y" , strtotime($todaytdate));
			echo  "the date one week before today date = " . $prev_date . "<br />";
			echo  "today date = " . $todaytdate . "<br />";
			echo  "Current month = " . $current_month . "<br />";
			echo  "Current year = " . $current_year . "<br /><br />";
				
			$rs = $this->expenses_m->total_expenses();
			
			if($rs !== false AND $rs->result() > 0){
				foreach($rs->result() as $row){
					$month = date("m", strtotime($row->expenses_date));
					$year = date("Y", strtotime($row->expenses_date));
					
					if( strtotime($row->expenses_date) == strtotime($todaytdate)){
						$today_expenses += $row->expenses_amount;
					}
					if((strtotime($row->expenses_date) >= strtotime($prev_date)) AND (strtotime($row->expenses_date) <= strtotime($todaytdate))){
						$weekly_expenses += $row->expenses_amount;
					}
					if($month == $current_month){
						$month_expenses += $row->expenses_amount;
					}
					if($year == $current_year){
						$year_expenses +=  $row->expenses_amount;
					}
				}
				
				echo  "Today income = RM " . number_format($today_expenses, 2) . "<br /> Weekly income = RM " . number_format($weekly_expenses, 2) . "<br /> Monthly income = RM " . number_format($month_expenses, 2) . "<br /> Year income = RM " . number_format($year_expenses, 2) . "<br/><br/>";
			}
			
			$arr_response = array(
				'today_income' => number_format($today_expenses, 2),
				'weekly_income'=> number_format($weekly_expenses, 2),
				'month_income'=> number_format($month_expenses, 2),
				'year_income'=> number_format($year_expenses, 2),
			);
			
			echo json_encode($arr_response);

		}
	}
	
}
//author by the kapitan.
