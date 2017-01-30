<?php
/*
 * PHP Pagination Class
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 1.0
 * @modified by: novhex - http://github.com/novhex
 * @date October 20, 2012
 */


namespace Plugins;


class Paginator{
        /**
	 * set the number of items per page.
	 *
	 * @var numeric
	*/
	private static $_perPage;
	/**
	 * set get parameter for fetching the page number
	 *
	 * @var string
	*/
	private static $_instance;
	/**
	 * sets the page number.
	 *
	 * @var numeric
	*/
	private static $_page;
	/**
	 * set the limit for the data source
	 *
	 * @var string
	*/
	private static $_limit;
	/**
	 * set the total number of records/items.
	 *
	 * @var numeric
	*/
	private static $_totalRows = 0;
	/**
	 *  __construct
	 *  
	 *  pass values when class is istantiated 
	 *  
	 * @param numeric  $_perPage  sets the number of iteems per page
	 * @param numeric  $_instance sets the instance for the GET parameter
	 */
	public function __construct(){
	
	}

	/**
	 *  set_config
	 *  
	 *  set configuration for pagination
	 *  
	 * @param numeric  $_perPage  sets the number of iteems per page
	 * @param numeric  $_instance sets the instance for the GET parameter
	 */

	public static  function set_config($perPage=10,$instance='p'){

		self::$_instance = $instance;		
		self::$_perPage = $perPage;
		self::set_instance();	
	}
	/**
	 * get_start
	 *
	 * creates the starting point for limiting the dataset
	 * @return numeric
	*/
	public static function get_start(){
		return (self::$_page * self::$_perPage) - self::$_perPage;
	}
	/**
	 * set_instance
	 * 
	 * sets the instance parameter, if numeric value is 0 then set to 1
	 *
	 * @var numeric
	*/
	private static function set_instance(){

		self::$_page = (int) (!isset($_GET[self::$_instance]) ? 1 : $_GET[self::$_instance]); 
		self::$_page = (self::$_page == 0 || self::$_page <= -1 ? 1 : self::$_page);

	}
	/**
	 * set_total
	 *
	 * collect a numberic value and assigns it to the totalRows
	 *
	 * @var numeric
	*/
	public static function set_total($_totalRows){
		self::$_totalRows = $_totalRows;
	}
	/**
	 * get_limit
	 *
	 * returns the limit for the data source, calling the get_start method and passing in the number of items perp page
	 * 
	 * @return string
	*/
	public static  function get_limit(){
        	return "LIMIT ".self::get_start().",".self::$_perPage;
        }
        /**
         * page_links
         *
         * create the html links for navigating through the dataset
         * 
         * @var sting $path optionally set the path for the link
         * @var sting $ext optionally pass in extra parameters to the GET
         * @return string returns the html menu
        */
	public  static function page_links($path='?',$ext=null)
	{
	    $adjacents = "2";
	    $prev = self::$_page - 1;
	    $next = self::$_page + 1;
	    $lastpage = ceil(self::$_totalRows/self::$_perPage);
	    $lpm1 = $lastpage - 1;
	    $pagination = "";
		if($lastpage > 1)
		{   
		    $pagination .= "<ul class='pagination'>";
		if (self::$_page > 1)
		    $pagination.= "<li><a href='".$path.self::$_instance."=$prev"."$ext'>&laquo; Previous</a></li>";
		else
		    $pagination.= "<span class='disabled' style='display:none;'>Previous</span>";   
		if ($lastpage < 7 + ($adjacents * 2))
		{   
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
		if ($counter == self::$_page)
		    $pagination.= "<li class='active' ><span class='current active'>$counter</span></li>";
		else
		    $pagination.= "<li><a href='".$path.self::$_instance."=$counter"."$ext'>$counter</a></li>";                   
		}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
		if(self::$_page < 1 + ($adjacents * 2))       
		{
		for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
		{
		if ($counter == self::$_page)
		    $pagination.= "<li><span class='current'>$counter</span></li>";
		else
		    $pagination.= "<li><a href='".$path.self::$_instance."=$counter"."$ext'>$counter</a></li>";                   
		}
		    $pagination.= "...";
		    $pagination.= "<li><a href='".$path.self::$_instance."=$lpm1"."$ext'>$lpm1</a></li>";
		    $pagination.= "<li><a href='".$path.self::$_instance."=$lastpage"."$ext'>$lastpage</a></li>";       
		}
		elseif($lastpage - ($adjacents * 2) > self::$_page && self::$_page > ($adjacents * 2))
		{
		    $pagination.= "<li><a href='".$path.self::$_instance."=1"."$ext'>1</a></li>";
		    $pagination.= "<li><a href='".$path.self::$_instance."=2"."$ext'>2</a></li>";
		    $pagination.= "...";
		for ($counter = self::$_page - $adjacents; $counter <= self::$_page + $adjacents; $counter++)
		{
		if ($counter == self::$_page)
		    $pagination.= "<span class='current'>$counter</span>";
		else
		    $pagination.= "<li><a href='".$path.self::$_instance."=$counter"."$ext'>$counter</a></li>";                   
		}
		    $pagination.= "..";
		    $pagination.= "<li><a href='".$path.self::$_instance."=$lpm1"."$ext'>$lpm1</a></li>";
		    $pagination.= "<li><a href='".$path.self::$_instance."=$lastpage"."$ext'>$lastpage</a></li>";       
		}
		else
		{
		    $pagination.= "<li><a href='".$path.self::$_instance."=1"."$ext'>1</a></li>";
		    $pagination.= "<li><a href='".$path.self::$_instance."=2"."$ext'>2</a></li>";
		    $pagination.= "..";
		for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
		{
		if ($counter == self::$_page)
		    $pagination.= "<span class='current'>$counter</span>";
		else
		    $pagination.= "<li><a href='".$path.self::$_instance."=$counter"."$ext'>$counter</a></li>";                   
		}
		}
		}
		if (self::$_page < $counter - 1)
		    $pagination.= "<li><a href='".$path.self::$_instance."=$next"."$ext'>Next &raquo;</a></li>";
		else
		    $pagination.= "<li><span class='disabled' style='display:none;'>Next</span></li>";
		    $pagination.= "</ul>\n";       
		}
	return $pagination;
	}
}