<?php
error_reporting(E_ERROR);

include __DIR__.'/../routes.php';
include __DIR__.'/../database.php';
include __DIR__.'/../config.php';

// ini_set('session.auto_start'	,'1');
ini_set('session.save_handler'	,SESSION_HANDLER);
ini_set('session.save_path'		,SESSION_SAVE );
session_set_cookie_params(SESSION_EXPIRE,
						  COOKIE_PATH,
						  COOKIE_DOMAIN,
						  COOKIE_SECURE,
						  COOKIE_HTTPONLY);
session_start();

// session_start();  #don't uncomment it for best performance

########################################
# Autoload inc 
########################################
spl_autoload_register(function ($class_name) {
	$autoload_pathes=[INC_PATH,MODEL_PATH];
	#check if use namespace
	if (strpos($class_name,'\\') !==false)
		$class_name = ltrim(strrchr($class_name,'\\'),'\\');
	
	foreach ($autoload_pathes as $alp) {
		if(file_exists($alp.'/'.$class_name . '.php')){
			include $alp.'/'.$class_name . '.php';
			break;
		}
	}
	
});

########################################
# routing 
########################################
$uri=is_cli()?$argv[1]:$_SERVER['REQUEST_URI'];
$uri = trim( $uri, "/" );
$url = explode('/', $uri);
$ctrl =  'home';
if(!empty($url[0]))
	$ctrl = $url[0];
$method=$url[1]?:'index';
$method=str_replace('?'.$_SERVER['QUERY_STRING'], '', $method);
array_shift($url);
array_shift($url);
$args = $url;

#Check defined routes in routes.php
$req_method=$_SERVER['REQUEST_METHOD'];
foreach(array_keys($routes) as $route_key){
	list($route_method,$route_uri)=explode(' ',trim($route_key));
	if(!$route_uri){
		$route_uri = trim($route_key);
		$route_method=$req_method;
	}
	$route_method=strtoupper($route_method);
	if($route_uri==$ctrl.'/'.$method or
	   preg_match("/\b$req_method +$ctrl\/$method/",$route_key) )
	{
		if($route_method && $req_method!=$route_method)
			die('Method Not Allowed');
		$method_args = $routes[$route_key];
		list($ctrl,$method)=explode('@',$method_args[0]);
		if($method_args[1] && !preg_match('/^'.implode('\/*',$method_args[1]).'$/',implode('/', $args))){
			die('Invalid args');
		}
		break;
	}
}


#Autoload controller & method with parameters
if(file_exists(CTRL_PATH.'/'.$ctrl . '_controller.php')){
	spl_autoload_register(function ($class) {
		$class_name=$class;
		if (strpos($class,"\\") !==false){
			$class_name = ltrim(strrchr($class,"\\"),"\\");
		}
    	include CTRL_PATH.'/'.$class_name . '.php';
	});
	call_user_func_array([$ctrl.'_controller',$method], $args);
	// call_user_func_array(["\\ctrl\\{$ctrl}",$method], $args);
}else {
	require '../404.php';
}


#####################################################
#for instance object of class related inc path
#####################################################
// if(!function_exists('getinstance')){
	function getinstance($class,$path='',$class_params=[]){
		#check if use namespace
		$class_name=$class;
		if (strpos($class,"\\") !==false){
			$class_name = ltrim(strrchr($class,"\\"),"\\");
		}

		$path.=($path!='')?'/':'';
		include INC_PATH.'/'.$path.$class . '.php';
		
		$class_params=array_map(function($item){return "'{$item}'";},$class_params);
		$class_params_str=implode(',',$class_params);
		eval("\$obj=new \$class({$class_params_str});");
		// $obj=new $class();
		return $obj;
	}
// }

// if(!function_exists('is_cli')){
function is_cli()
{
    return (php_sapi_name() === 'cli');
}
// }
