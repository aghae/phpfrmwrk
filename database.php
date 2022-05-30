<?php
//NoSQL Database
require_once "inc/lib/sleekdb/Store.php";


// SQL Database
define('sqlite',[
		
	'type'=>'sqlite',
	'name'=>__DIR__.'/data/app.sqlite3'
	
]);

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


define('default_db'	,sqlite);
define('read_db'	,sqlite);
define('write_db'	,sqlite);

