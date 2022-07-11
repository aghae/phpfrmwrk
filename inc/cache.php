<?php

class cache{

	static $cache_path=CACHE_PATH;

	function not_buffered($name,$cache_time){
		$cache_file=self::$cache_path.'/'.$name;
		if(!file_exists($cache_file)|| ( time()-$cache_time > filemtime($cache_file)) ){
			ob_start();
			// ob_start('ob_gzhandler');
			return 1;
		}
		else{
			readfile($cache_file);
			return 0;
		}
	}

	function buffer($name){
		file_put_contents(self::$cache_path.'/'.$name, ob_get_contents());
		ob_end_flush();
	}

}