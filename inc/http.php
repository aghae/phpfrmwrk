<?php

class http{

	function init(){
		include __DIR__.'/lib/http/httpclient.php';
	}

	
	function get($url, $params=[])
	{
	    $curl = getinstance('Curl','lib/curl');
	    $curl->options['fresh_connect']=true;
	    $curl->options['followlocation']=true;
	    // $curl->options['timeout_ms']=1001;
	    return $curl->get($url,$params);
	}

	
}


http::init();
