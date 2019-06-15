<?php

class cok{

	function set($name,$value,$options=[]){
		$value=crypt::encrypt($value);
		$path 		= $options['path']?:COOKIE_PATH;
		$domain 	= $options['domain']?:COOKIE_DOMAIN;
		$expire 	= $options['expire']?:COOKIE_EXPIRE;
		$secure 	= $options['secure']?:COOKIE_SECURE;
		$httponly 	= $options['httponly']?:COOKIE_HTTPONLY;
		setcookie($name,$value,time()+$expire,$path,$domain,$secure,$httponly);
	}

	function get($name=''){
		if($name){
			return crypt::decrypt($_COOKIE[$name]);
		}
		else{
			$ret=[];
			foreach($_COOKIE as $k=>$val){
				if(crypt::decrypt($val)!='')
					$ret[$k]=crypt::decrypt($val);
				else 
					$ret[$k]=$val;	
			}
			return $ret;
		}
	}

	function unset($name,$options=[]){
		$path 		= $options['path']?:COOKIE_PATH;
		$domain 	= $options['domain']?:COOKIE_DOMAIN;
		$expire 	= $options['expire']?:COOKIE_EXPIRE;
		$secure 	= $options['secure']?:COOKIE_SECURE;
		$httponly 	= $options['httponly']?:COOKIE_HTTPONLY;
		setcookie($name,'',time()-1,$path,$domain,$secure,$httponly);
	}

}


