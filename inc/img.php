<?php

class img{

	function resize($src,$dest,$width,$height=null,$to='file'){ #file or screen
		$image = getinstance('SimpleImage','lib');
		$image->fromFile($src)
			  ->resize($width,$height);
		if($to=='file')
			$image->toFile($dest);
		else
			$image->toScreen();
	}


	function capcha($sess_name='capcha'){
		$cap = getinstance('SimpleCaptcha','lib/captcha');
		$cap->session_var = $sess_name;
		// $captcha->wordsFile = null; 
		return $cap->CreateImage();
	}
	
}