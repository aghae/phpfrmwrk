<?php

class req{

	// htmlspecialchars($_GET["name"])
	function get($key='')
	{
		$ret=$_GET ;
		foreach($ret as $k=>$val) $ret[$k]=htmlspecialchars($val);
		return $key?isset($ret[$key])?$ret[$key]:null:$ret;
	}

	function post($key='')
	{
		$ret=$_POST ;
		foreach($ret as $k=>$val) $ret[$k]=htmlspecialchars($val);
		return $key?isset($ret[$key])?$ret[$key]:null:$ret;
	}

	function raw_post(){
		$raw_data=file_get_contents('php://input');
		return (array)json_decode($raw_data);
	}

	function is_ajax(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {     
		    return 1;
		}
	}

	function ip(){
		return $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);
	}

}