<?php

define('mysql',[
	'host'=>'localhost',
	'port'=> 3306,
	'type'=>'mysql',
	'name'=>'shop',
	'user'=>'root',
	'pass'=>'123',
	'char'=>'utf8'
]);

define('pgsql',[
	'host'=>'localhost',
	'port'=> 5432,
	'type'=>'pgsql',
	'name'=>'biz',
	'user'=>'postgres',
	'pass'=>'postgres',
	'char'=>'utf8'
]);

define('default_db'	,mysql);
define('read_db'	,mysql);
define('write_db'	,mysql);

