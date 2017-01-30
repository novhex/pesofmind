<?php

namespace Helpers;


class System_helpers{


public function __construct(){

	
}

public static function base_url(){

	$host = $_SERVER['HTTP_HOST'];

 	$urlparts = explode('/', $_SERVER['PHP_SELF']);

	if(strpos($host, 'localhost')===FALSE){

		if(self::is_ssl()){

			 return 'https://'.$_SERVER['HTTP_HOST'].'/';

		}else{

			return 'http://'.$_SERVER['HTTP_HOST'].'/';
		}
	}else{

		if(strpos($host,'localhost')===TRUE){

			return 'http://localhost/'.$urlparts[1].'/';	

		}else if(strpos($host, '127.0.0.1')){

			return 'http://127.0.0.1/'.$urlparts[1].'/';
		}
		
	}

}

public static function  cache_form_values($form_name){

	if (!empty($_POST)) {
        foreach($_POST as $key => $value) {

        		$_SESSION[$form_name][$key] = $value;	
            
        	}
    	}
	}




public static function  clear_form_cache($form_name){

		foreach(array_keys($_SESSION[$form_name]) as $keys){

				unset($_SESSION[$form_name][$keys]);
		}

	}




public static function  current_url(){

		if(isset($_SERVER['HTTPS'])){
		
			return 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	

		}else{

			return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
		}
	}




public static function  create_url_title($str, $separator = '-', $lowercase = FALSE){
		if ($separator === 'dash'){

			$separator = '-';
		}

		elseif ($separator === 'underscore'){
			$separator = '_';
		}

		$q_separator = preg_quote($separator, '#');

		$trans = array(
			'&.+?;'			=> '',
			'[^\w\d _-]'		=> '',
			'\s+'			=> $separator,
			'('.$q_separator.')+'	=> $separator
		);

		$str = strip_tags($str);
		foreach ($trans as $key => $val){

			$str = preg_replace('#'.$key.'#i'.'', $val, $str);
		}

		if ($lowercase === TRUE){
			$str = strtolower($str);
		}

		return trim(trim($str, $separator));
	}

public static function exectime(){

	return number_format((float)(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 4, '.', '');
}

public static function  get_data($method,$index){
		if(strtoupper($method)==='POST'){
			if(isset($_POST[$index])){
				return filter_var($_POST[$index],FILTER_SANITIZE_STRING);
			}
		}else if(strtoupper($method)==='GET'){
			if(isset($_GET[$index])){
				return filter_var($_GET[$index],FILTER_SANITIZE_STRING);
			}
		}
	}



public static function  get_url_segment($segment){

		$parts = explode("/", self::current_url());

		if(!empty($parts[$segment])){
			return $parts[$segment];	
		}
		
	}




public static function  get_file_data($file,$index=NULL){
		if(isset($_FILES[$file])){
			$file_attributes = array('name','type','tmp_name','error','size');
			if($index!==NULL){

			if(in_array($index, $file_attributes)){
				return $_FILES[$file][$index];
			}

			}else{
				return $_FILES[$file];
			}
		}
	}



public static function  get_flashdata($key){

		if(isset($_SESSION['coffee_flash_data'][$key])){

			 $flashdata = $_SESSION['coffee_flash_data'][$key];
			 unset($_SESSION['coffee_flash_data'][$key]);
			 return $flashdata;
		}
	}




public static function  get_session_userdata($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}
	}



public static function  hspec_chars($string,$ent=ENT_QUOTES,$encoding='UTF-8'){

		return htmlspecialchars($string,$ent,$encoding);
	}



	
public static function  html_ent($string,$flags='ENT_QUOTES|ENT_HTML5',$charset='UTF-8',$doub_enc=NULL){

		return htmlentities($string,$flags,$charset,$doub_enc);
	}




public static function  is_ajax(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
			return TRUE;
		}else{
			return FALSE;
		}
	}




public static function  is_ssl(){

		return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? TRUE : FALSE;
	}



public static function  prev_field_value($form_name,$field){

		if(isset($_SESSION[$form_name][$field])){

			return $_SESSION[$form_name][$field];
		}else{

			return '';
		}
	}



	public static function  random_string($type = 'alnum', $len = 8)
	{
		switch ($type)
		{
			case 'basic':
				return mt_rand();
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
				switch ($type)
				{
					case 'alpha':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'alnum':
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}
				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
			case 'unique': // todo: remove in 3.1+
			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'encrypt': // todo: remove in 3.1+
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}




public static function  redirect($location,$replace=TRUE,$response_code=302){

		header('location:'.$location,$replace,$response_code);

		exit;
	}


public static 	function req_method(){

	return $_SERVER['REQUEST_METHOD'];
}



public static function get_sessionId(){
	
	return session_id();
}


public static function regenerate_sessionId(){

        session_regenerate_id(TRUE);

        return session_id();
   }


public static function  set_session($key,$val){

		if($key!=='' && $val!==''){
			$_SESSION[$key] = $val;
		}
	}



public static function  set_flashdata($key,$data){
		if($key!=='' && $data!==''){
			$_SESSION['coffee_flash_data'][$key] = $data;
		}
	}




public static function  unset_userdata($key){
		if(isset($_SESSION[$key])){
			
			unset($_SESSION[$key]);
		}
	}


}