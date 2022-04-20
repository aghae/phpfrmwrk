<?php

class res{

	function dump($data){
		util::var_dump($data);
	}

	function write($formated_str,$params=[]){
		foreach($params as $k=>$item){
			if(is_array($item))
				$params[$k]=util::var_dump($item,true);
		}
		vprintf($formated_str,$params);
	}

	function json($data){
		header("Content-type:application/json");
		if(is_array($data))
			echo json_encode($data);
		else 
			echo json_encode(json_decode($data));
	}

	function render($tpl,$data,$layout=null){
		$tpl= VIEW_PATH.'/'.$tpl;
		$tpl_obj = getinstance('Tonic','lib',[$tpl]);
		$tpl_obj::$cache_dir = CACHE_PATH.'/';
		$tpl_obj::$enable_content_cache = true;
		foreach($data  as $k=>$val)
			$tpl_obj->assign($k,$val);
		echo $tpl_obj->render();
	}


}

