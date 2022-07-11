<?php

class user_model {
	
	function exists($user_id=1){
		$result = db::get()->select('name from user where id=:id',['id'=>$user_id]);
		res::dump($result);
		if($result)
			echo "user exists.";
		else 
			echo "no exists";
	}

}