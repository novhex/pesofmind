<?php

namespace Database\DBConnection;

use \PDO;

class DBConnection {

	public static  $db;
	public static $host="127.0.0.1";
	public static $dbname="pesofmindz";
	public static $username="root";
	public static $password="";
	public static $pdo_opt = array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	public function __construct(){

		self::$db = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8mb4", self::$username,self::$password,self::$pdo_opt);
	}



	public static function countRecords($table){

		return self::$db->query("SELECT * FROM ".$table)->rowCount();
	}

	public static function insert($table,$data){

		$x=0;
		$l = count($data);	
		$i = 0;
		$len = count($data);

		$query = "INSERT INTO ";
		$query.= $table." (";

		
			foreach ($data as $item =>$k) {

			$item = str_replace(":", "", $item);

			if ($i != $len - 1) {

					$query.=$item.' , ';
			        
			  }else{

			  		$query.=$item.') VALUES (';
			  }
			   
			    $i++;

			}


			foreach ($data as $item =>$k) {


			if ($x != $l - 1) {

					$query.=$item.' , ';
			        
			  }else{

			  		$query.=$item.')';
			  }
			   
			    $x++;

			}
	
			$stmt = self::$db->prepare($query);
			$stmt->execute($data);
			$affected_rows = $stmt->rowCount();
			return $affected_rows;

	}

}
