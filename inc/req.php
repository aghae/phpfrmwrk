<?php

class req{

	function raw_post(){
		$raw_data=file_get_contents('php://input');
		return (array)json_decode($raw_data);
	}
	
	function post($key='')
	{
		$ret=$_POST;
		if($key!=''){
		   if(isset($ret[$key]))
		    return $ret[$key];
		}
		else
			return $ret;
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