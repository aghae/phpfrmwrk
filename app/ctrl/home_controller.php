<?php


class home_controller {
	
	function index(){
		echo 'This is home view and in the following : <br> ';

		//call view method from test_controller
		test_controller::view();

	}

	
	function overrided(){

		echo 'this will overrided by route => test/overrided';

	}

}