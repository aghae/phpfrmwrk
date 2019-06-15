<?php


$routes=[
	#'method cutom/path/..' =>['controller@method',['regx_arg1','regx_arg2',...]]

	'home/overrided  '=> ['test@override'],
	'test/paramtest'=> ['test@paramtest',['\d+','\d*']],
	'POST test/post'=> ['test@post'],

];