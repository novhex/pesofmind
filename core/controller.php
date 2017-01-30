<?php

namespace Core\Controller;
use \Database\DBConnection\DBConnection as DB;

class Controller{

	private static $vars 		= array();
	private static $pageVars 	= array();

	public function __construct(){
		new DB();
	}

	public static function renderPage($view,$vars=[]){

		if($vars != NULL) {

			foreach ($vars as $key => $value) 
			{
				self::$pageVars[$key] = $value;
			}
		}
			extract(self::$pageVars);
			ob_start();
			require_once(ROOT_DIR .'views/'. $view .'.php');
			echo ob_get_clean();
	
	}

}