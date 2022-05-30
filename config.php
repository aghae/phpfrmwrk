<?php

// error_reporting(E_ERROR);

header('X-Powered-By: nobody');
ini_set('expose_php',false);

define('CTRL_PATH'		,__DIR__.'/app/ctrl');
define('MODEL_PATH'		,__DIR__.'/app/model');
define('VIEW_PATH'		,__DIR__.'/app/view');
define('CACHE_PATH'		,__DIR__.'/tmp/cache');
define('INC_PATH'		,__DIR__.'/inc');
define('NOSQL_PATH'		,__DIR__.'/data');



//encryption securities
define('CRYPT_KEY'	, '3Qr$@lTk!!');
define('CRYPT_IV'	, '!5ssmKghQii');



define('SESSION_HANDLER','files'); 	# files or memcached or redis
/*
	if SESSION_HANDLER set to  files 	set SESSION_SAVE path to store directory like this : __DIR__.'/tmp/session 
	if SESSION_HANDLER is memcached 	set SESSION_SAVE host:port like this :  localhost:11211 
	if SESSION_HANDLER is redis 		set SESSION_SAVE host:port like this :  tcp://127.0.0.1:6379  
	hint :
		for working redis & memcached  php-redis & php-memcached must be installed 
*/

define('SESSION_SAVE'	, __DIR__.'/tmp/session');  
// define('SESSION_SAVE'	,'localhost:11211' );  
// define('SESSION_SAVE'	,'tcp://127.0.0.1:6379' );  

define('SESSION_EXPIRE'	,3600);  #in seconds if 0 it expires on browser close


define('COOKIE_PATH'	,'/');
define('COOKIE_DOMAIN'	,'localhost');
define('COOKIE_EXPIRE'	,3600);
define('COOKIE_SECURE'	,false);
define('COOKIE_HTTPONLY',false);

#email
define('SMTP_HOST'		,'smtp.gmail.com');
define('SMTP_USER'		,'youremail@emaildomain');
define('SMTP_PASS'		,'youremailpasword');
define('SMTP_PORT'		, 587);
define('SMTP_SECURE'	,'tls'); #tls or ssl
define('MAIL_FROM'		,'info@my.co');
define('MAIL_FROM_NAME'	,'mr. nobody');


