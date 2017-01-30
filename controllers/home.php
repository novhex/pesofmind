<?php

namespace controllers;

use \Core\Controller\Controller;
use \Database\DBConnection\DBConnection as DB;
use \Helpers\System_helpers as Helper;
use \Plugins\Paginator;
use \Plugins\GUMP;
use \PDO;

class Home extends Controller{

	public function __construct(){
		
		parent::__construct();

		if(!empty(Helper::get_session_userdata('usr_fullname'))){
			
			Helper::redirect(Helper::base_url().'user');	
		}

	}

	public function index(){
		
		$data['page_title'] = 'MVC PDO &ndash; An Open - Source Micro PHP MVC Framework';
		Controller::renderPage('components/header',$data);
		Controller::renderPage('components/navbar');
		Controller::renderPage('default');
		Controller::renderPage('components/footer');
	}


	public function auth(){

		$validator = GUMP::is_valid($_POST,array('email'=>'valid_email|required','password'=>'required'));

		if($validator === TRUE){

			$stmt = DB::$db->prepare("SELECT email from users where email = :email_add");
			$stmt->execute(array(':email_add'=>Helper::get_data('post','email')));

			if($stmt->rowCount()===1){

				$stmt = DB::$db->prepare("SELECT * from users where email = :email_add");
				$stmt->execute(array(':email_add'=>Helper::get_data('post','email')));

				$user_info= $stmt->fetch(PDO::FETCH_ASSOC);
				
				if(password_verify(Helper::get_data('post','password'),trim($user_info['password']))){

					Helper::set_session('user_id',$user_info['user_id']);
					Helper::set_session('usr_fullname',$user_info['firstname'].' '.$user_info['lastname']);
					Helper::set_session('usr_date_reg',$user_info['date_registered']);
					Helper::redirect(Helper::base_url().'user');

				}else{

					Helper::set_flashdata('errors','Invalid Username or Password');
					Helper::redirect(Helper::base_url().'sign-in');
				}

			}else{
					Helper::set_flashdata('errors','Invalid Username or Password');
					Helper::redirect(Helper::base_url().'sign-in');
			}

		}else{

				Helper::set_flashdata('errors',$validator);
				Helper::redirect(Helper::base_url().'sign-in');
		}

	}

	public function sign_in(){

		$data['page_title'] = 'PesofMind &ndash; Sign In';
		$data['errors'] = Helper::get_flashdata('errors');
		Controller::renderPage('components/header',$data);
		Controller::renderPage('components/navbar');
		Controller::renderPage('sign-in',$data);
		Controller::renderPage('components/footer',$data);
	}

	public function sign_up(){

		$data['page_title'] = 'PesofMind &ndash; Sign Up';
		$data['errors'] = Helper::get_flashdata('errors');
		Controller::renderPage('components/header',$data);
		Controller::renderPage('components/navbar');
		Controller::renderPage('sign-up',$data);
		Controller::renderPage('components/footer',$data);

	}


	public function submit_registration(){

		$validator = GUMP::is_valid($_POST ,array(
			'name'=>'required|min_len,2|max_len,35',
			'lastname'=>'required|min_len,2|max_len,35',
			'email'=>'required|valid_email',
			'password'=>'required|min_len,6',
			'passwordconfirmation'=>'equalsfield,password|required',
			));

		if($validator === TRUE){

				$data = array(
				':firstname'=>Helper::get_data('post','name'),
				':lastname'=>Helper::get_data('post','lastname'),
				':email'=>Helper::get_data('post','email'),
				':password'=>password_hash(Helper::get_data('post','passwordconfirmation'),PASSWORD_BCRYPT),
				':date_registered'=>date('Y-m-d h:i:s'),
				':role'=>'user',
				':is_email_verified'=>'yes'
				);
			
			
			$stmt = DB::$db->prepare("SELECT email from users where email = :email_address");
			$stmt->execute(array(':email_address'=>Helper::get_data('post','email')));


			if($stmt->rowCount()===1){

				Helper::set_flashdata('errors','Cannot Register.Email already registered.');
				Helper::redirect(Helper::base_url().'sign-up');

			}else{

				if(DB::insert('users',$data)==1){
					
				}	

			}




		}else{

			Helper::set_flashdata('errors',$validator);
			Helper::redirect(Helper::base_url().'sign-up');
		}
	}
	
}
