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

		echo 'testController : i override /home/overrided route ;)';
	}
	

   	function post(){
   		echo 'Congradulation, You showed me ;)';
   	}

	function nosql($action=''){  //using sleekdb

		$user = nosql::getstore('user');
		$news = nosql::getstore('news');
		// print_r($news->count());
		// return;insert
		switch($action){

			case 'adduser':
				// $user->deleteBy(["name",'=',"amir"]);
				$result = $user->updateOrInsert(["name"=>"admin","pass"=>"qweasd"]);
				break;

			case 'insert':
				
				$article = [
					"title" => "title ...",
					"about" => "about me",
					"author" => [
					  "avatar" => "mypic.jpg",
					  "name" => "aghae"
					],
					"user"=> 2
				   ];
				$result = $news->insert($article);
				break;

			default:
				$q=$news->createQueryBuilder();
				$result = $q
							// ->select(["user","title"])
							->orderBy(["_id"=>"desc"])
							->disableCache()  //0 means infinits
							// ->where([
							// 			['user','=',1],
							// 			'OR',
							// 			['user','=',2],
							// 		])
							->join(function($article) use($user){
								return  $article['user']?$user->findById($article['user']):[];
							 },'creator')
							 ->limit(10)
							// ->having(["user","=",2])
							// ->groupBy(["user"],"total",true)
							->getQuery()
							->fetch();
				
		}
		header('Content-Type: application/json; charset=utf-8');
		print_r(Json_encode($result));

	
	}

	   

   	function paramtest($par1,$par2){
		res::write('par1: %s , par2: %s',[$par1,$par2]);
	}

	function model($user_id=1){
		user_model::exists($user_id);
	}


   	function http(){
		echo  http::get('http://google.com');
   		//res::write($content);
   	}
   
	function pay(){
		 \saman\pay::request(120000,'');
	}

   	function mail(){
		try{
			$status=send::email('a.aghaee@gmail.com','salam','hello <b>World<b>');
			echo $status;
			if($status)
				res::write('succesfully sent.');
		}catch(Exception $e){
			res::write($e.getMessage());
		}
   	}

   	

   	function crypt(){
   		$crytpted =  crypt::encrypt('amir') ;
   		$decrtpted = crypt::decrypt($crytpted) ;
   		
   		res::write('crypted is %s <br>decrypted is %s',	[$crytpted,$decrtpted]);
   	}

   	function format(){
   		// echo sprintf('sdsdsd ');s
   		res::write('hello world. i am born on %s ',[1977]);
   	}

   	function pagin($num=1,$show=''){  //show:  '' o json

   		$totalItems   = 1000;
		$itemsPerPage = 50;
		$currentPage  = $num;
		$urlPattern   = '/test/pagin/(:num)';

		$paginator = pagin::make($totalItems, $itemsPerPage, $currentPage, $urlPattern);
		$paginator->setMaxPagesToShow(5);
		
		if($show=='json')
			res::json( $paginator->getPages());
		else{	
			echo '
				<style>
					.pagination{padding:2em;margin:20}
					.pagination li {width:35px;display:inline-block;padding-left:3em;}
				</style>
			';
			echo  $paginator->toHtml();
		}

   	}

   	function sess(){
   		// sess::unset('counter');
   		// session_start();
   		//echo \my\ns\sess::id();
   		// echo 'sessio id is : '.sess::id().'<br>';
   		 $counter = sess::get('counter');
   		 sess::set('counter',++$counter);
   		 echo $counter;
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

		 if (cache::not_buffered('cachekey',60)){
			$result = db::get(read_db)->select("name from user limit 10");
			// res::dump($result);
			header('Content-Type: application/json; charset=utf-8');
			print_r(json_encode($result));

			// cache::buffer('cachekey');
		 }

		//echo( "not in cache\nthis string not cached");

		// if (cache::not_buffered('2nd_cache',360)){
			//$result = db::get(read_db)->select("name from tbl limit 10");
			//res::dump($result);

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
		echo util::linkify('goto http://yahoo.com via util->linkify').'<br>';
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
		res::write('<br>Form GET is : %s',[req::get()]);
		res::write('<br>Raw POST is : %s',[req::raw_post()]);

	}


	



}

// test_controller::init();
