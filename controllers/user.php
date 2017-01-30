<?php

namespace controllers;

use \Core\Controller\Controller;
use \Database\DBConnection\DBConnection as DB;
use \Helpers\System_helpers as Helper;
use \Plugins\Paginator;
use \Plugins\GUMP;
use \PDO;

class User extends Controller{

	private static $user_component_dir = 'user/components';

	public function __construct(){

		parent::__construct();


		if(!empty(Helper::get_session_userdata('usr_fullname'))){

			
		}else{

			Helper::set_flashdata('errors','You must sign in to view this page.');
			Helper::redirect(Helper::base_url().'sign-in');
		}

	}

	public function index(){

		$data['page_title'] = 'User Dashboard &ndash; PesofMind';
		Controller::renderPage(self::$user_component_dir.'/header',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-top',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-left',$data);
		Controller::renderPage('user/main-dashboard');
		Controller::renderPage(self::$user_component_dir.'/footer',$data);
		
	}

	public function add_expense(){

		$data['page_title'] = 'User Dashboard &ndash; Add New Expense';
		$data['errors'] = Helper::get_flashdata('errors');
		$data['success_msg']=Helper::get_flashdata('success_msg');
		$stmt = DB::$db->prepare("SELECT * from expense_category where added_by = :adby ");
	  	$stmt->execute(array(':adby'=>Helper::get_session_userdata('user_id')));
	  	$data['expcateg'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
		Controller::renderPage(self::$user_component_dir.'/header',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-top',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-left',$data);
		Controller::renderPage('user/new-expense',$data);
		Controller::renderPage(self::$user_component_dir.'/footer',$data);	
	}

	public function expense_categories(){


		$data['page_title'] = 'User Dashboard &ndash; Expense Categories';
		$data['errors'] = Helper::get_flashdata('errors');
		Paginator::set_config(10,'page');
	 	Paginator::set_total(DB::countRecords('expense_category'));
		$data['contents']=DB::$db->query("SELECT * from expense_category WHERE added_by = '".Helper::get_session_userdata('user_id')."' ".Paginator::get_limit());
	 	$data['page_links'] = Paginator::page_links();
		$data['success_msg']=Helper::get_flashdata('success_msg');
		Controller::renderPage(self::$user_component_dir.'/header',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-top',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-left',$data);
		Controller::renderPage('user/expense-categories',$data);
		Controller::renderPage(self::$user_component_dir.'/footer',$data);		


	}

	public function new_expense_category(){
	
		$data['page_title'] = 'User Dashboard &ndash; New Expense Category';
		$data['errors'] = Helper::get_flashdata('errors');
		$data['success_msg']=Helper::get_flashdata('success_msg');
		Controller::renderPage(self::$user_component_dir.'/header',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-top',$data);
		Controller::renderPage(self::$user_component_dir.'/navbar-left',$data);
		Controller::renderPage('user/new-expensecategory',$data);
		Controller::renderPage(self::$user_component_dir.'/footer',$data);		

	}

	public function log_out(){

		Helper::unset_userdata('user_id');
		Helper::unset_userdata('usr_fullname');
		Helper::unset_userdata('usr_date_reg');
		Helper::redirect(Helper::base_url().'sign-in');
	}

	public function submit_expense_category(){

		$validator = GUMP::is_valid($_POST,
			array('expensename'=>'required|min_len,5|max_len,50',
				'expensedesc'=>'required|min_len,5|max_len,160'
				)
			);




		if($validator === TRUE){

		$data = array(
			':expense_name'=>Helper::get_data('post','expensename'),
			':expense_desc'=>Helper::get_data('post','expensedesc'),
			':expense_name_uid'=>md5(uniqid(rand(),TRUE)),
			':added_by'=>Helper::get_session_userdata('user_id'),
			':date_added'=>date('Y-m-d h:i:s')
			);



		if(DB::insert('expense_category',$data)==1){
				
			Helper::set_flashdata('success_msg','Expense category added');
			Helper::redirect(Helper::base_url().'new-expense-category');				

		}


		}else{

			Helper::set_flashdata('errors',$validator);
			Helper::redirect(Helper::base_url().'new-expense-category');
		}
	}

	public function submit_expense(){

		$validator = GUMP::is_valid($_POST,
			array(
				'datespent'=>'required',
				'expensename'=>'required',
				'amountspent'=>'required|float',
				'expensecateg'=>'required'
				)
			);

		if($validator === TRUE){

			$data = array(
				':expenses_name'=>Helper::get_data('post','expensename'),
				':expenses_categ'=>Helper::get_data('post','expensecateg'),
				':expenses_date_added'=>date('Y-m-d h:i:s'),
				':expenses_amount'=>Helper::get_data('post','amountspent'),
				':expenses_datespent'=>Helper::get_data('post','datespent'),
				':expenses_owner'=>Helper::get_session_userdata('user_id')
				);

		if(DB::insert('expenses',$data)==1){
				
			Helper::set_flashdata('success_msg','New expense added');
			Helper::redirect(Helper::base_url().'add-expense');				

		}


		}else{

			Helper::set_flashdata('errors',$validator);
			Helper::redirect(Helper::base_url().'add-expense');
		}


	}
}