<?php

class test_controller {

	
	function index(){
   		 echo 'hello world!';
   	}
   

   	function view(){

		res::render('test.html',['name'=>'this is test controller view  method that render test.html',
								 'mdate'=>date_create()]);
	}


   	function override($v='sdsd'){

		echo 'i override /home/overrided route ;)';
	}
	

   	function post(){
   		echo 'Congradulation, You showed me ;)';
   	}

   	function paramtest($par1,$par2){

		res::write('par1: %s , par2: %s',[$par1,$par2]);
	}

	function model($par1,$par2){

		user_model::exists();
	}


   	function http(){

   		echo http::curl('http://google.com');
   		
   	}
   
   	function mail(){
   		$status=send::email('info@test.com','salam','hello <b>World<b>');
   		if($status)
   			res::write('succesfully sent.');
   	}

   	

   	function crypt(){
   		$crytpted =  crypt::encrypt('amir') ;
   		$decrtpted = crypt::decrypt($crytpted) ;
   		
   		res::write('crypted is %s <br>decrypted is %s',	[$crytpted,$decrtpted]);
   	}

   	function format($num){
   		// echo sprintf('sdsdsd ');s
   		res::write('hello world. i am born on %s ',[1977]);
   	}

   	function pagin($num){

   		$totalItems   = 1000;
		$itemsPerPage = 50;
		$currentPage  = $num;
		$urlPattern   = '/test/pagin/(:num)';

		$paginator = pagin::make($totalItems, $itemsPerPage, $currentPage, $urlPattern);
		$paginator->setMaxPagesToShow(5);
		res::json( $paginator->getPages());

		echo '
			<style>
				.pagination{padding:20;margin:20}
				.pagination li {width:35px;display:inline-block}
			</style>
		';
		echo  $paginator->toHtml();

   	}

   	function sess(){
   		// sess::unset('counter');
   		// session_start();
   		echo \my\ns\sess::id();
   		// echo 'sessio id is : '.sess::id().'<br>';
   		// $counter = sess::get('counter');
   		// sess::set('counter',++$counter);
   		// echo '<br>'.$counter;
   	}


   	function capcha(){
   		echo img::capcha();
   	}

   	function imgresize(){
   		echo 'flower.jpg resizing ..';
   		img::resize(__DIR__.'/../../tmp/flower.jpg',__DIR__.'/../../tmp/flower_resized.jpg',200);	
   		echo '<br>flower.jpg resized into tmp/flower_resized.jpg .';
   	}

   	
	function db(){

		// if (cache::not_buffered('cachekey',60)){
			$result = db::get(read_db)->select("name from tbl limit 10");
			res::dump($result);

			// cache::buffer('cachekey');
		// }

		echo( "not in cache\nthis string not cached");

		// if (cache::not_buffered('2nd_cache',360)){
			$result = db::get(read_db)->select("name from tbl limit 10");
			res::dump($result);

			// cache::buffer('2nd_cache');
		// }

	}

	function cok(){
		$counter = cok::get('counter');
		cok::set('counter',++$counter);

		res::write('Default $_COOKIE :%s',[$_COOKIE]);
		res::write('Decryped $_COOKIE with cok:: :%s',[cok::get()]);
	}

	function cok_set(){
		cok::set('mycok','has Encrypted',['expire'=>300]);
		// cok::set('tstcookie',1223232);
	}

	function cok_unset(){
		cok::unset('tstcookie');
		echo 'cookie unset.';
	}

	function json(){

		res::json(['id' => 1232]);
		// res::json('{"id" : 1232}');
	}

	function util(){
		// load('util');
		echo util::slugify('hello world').'<br>';
		// echo util::random_string(5).'<br>';
		echo util::secure_random_string(6).'<br>';
		echo util::size_format(util::directory_size('./'),2).'<br>';
		echo util::linkify('goto http://yahoo.com via uti->linkify').'<br>';
		echo util::human_time_diff(time() - 7400).'<br>';
		echo util::match_string("test/*", "test/my/test").'<br>';
		echo util::safe_truncate('The quick brown fox jumps over the lazy dog', 24).'<br>';
		echo util::zero_pad(341, 8).'<br>';
		echo util::SECONDS_IN_A_WEEK .'<br>';

		echo sprintf('There are %d monkeys in the %s', 10, 'Zoo');

		// echo util::force_download(__DIR__.'/hello.php').'<br>';

	}	

	function req(){
		// print_r($_SERVER);

		echo 'req is ajax?';
		if(req::is_ajax())
			echo 'Yes';
		else 	
			echo 'No';

		res::write('<br>IP is : %s',[req::ip()]);
		res::write('<br>Form POST is : %s',[req::post()]);
		res::write('<br>Raw POST is : %s',[req::raw_post()]);

	}


	



}

// test_controller::init();