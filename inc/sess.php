<?php

class sess{

	function id(){
		return session_id();
	}

	function set($name,$value){
		$value=crypt::encrypt($value);
		$_SESSION[$name]=$value;
	}

	function get($name=''){
		if($name){
			return crypt::decrypt($_SESSION[$name]);
		}
		else{
			$ret=[];
			foreach($_SESSION as $k=>$val){
				if(crypt::decrypt($val)!='')
					$ret[$k]=crypt::decrypt($val);
				else 
					$ret[$k]=$val;	
			}
			return $ret;
		}
	}

	function unset($name){
		unset($_SESSION[$name]);
	}
	
}

