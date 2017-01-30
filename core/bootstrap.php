<?php

session_start();

require ROOT_DIR.'core/noahbuscher/macaw/Macaw.php';

use \NoahBuscher\Macaw\Macaw;

class Bootstrap {

	public function __construct(){
		
		self::loadControllers();
	}

	public static function loadControllers(){

		foreach(glob(ROOT_DIR.'controllers/*.php') as $controllers){

			require_once $controllers;
		}
	}

	public static function runApp(){
	

	require_once ROOT_DIR.'routes/routelist.php';

		$url		= '';
		$method		='';
		$callback	='';

		foreach($routes as $route_rules):

			$method = 	explode('|',$route_rules)[0];
			$url = 		explode('|', $route_rules)[1];
			$callback = explode('|', $route_rules)[2];

			if($method === "GET"){

				Macaw::get($url,$callback);


			}else if($method === "POST"){

				Macaw::post($url,$callback);
			}

		endforeach;

	Macaw::dispatch();

	}

}