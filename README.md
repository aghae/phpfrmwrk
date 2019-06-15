__Fast Light Easy PHP framework__

- **Structure**:
    ```
    app
        - model
        - view
        - controller
    public                      // css,js & static files
        - index.php             // bootstrap
   inc                         // Libraries & third parties 
   tmp
   config.php                  // configuration file
   database.php                //database config
    ```


- **Start :**
    - unzip & cd to unzipped folder
    - cd to public folder & then
    - _Development:_
        - $ php -S localhost:8000

    - _Production:_ 
        - $ ./server.sh start localhost:8000 
        - $ ./server.sh stop
        - $ ./server.sh restart
        - $ ./server.sh status


- **Models & Libraries :** 
    - model filename trail with _model
    - model classname must be same as filename
    - models can called statically anywhere 
    - It can called namespacely if decaled on related filename liike this :
        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;\name\space\path\test_model::test_method(params,...)
         ```php
         Example:  model\user_model.php 
                class user_model {
                    function exists($user_id=1){
                        $result = db::get()->select('name from user where id=:id',['id'=>$user_id]);
                        return $result?true:false
                    }
                
                }
        ```
- **Controllers :**
    - Filename trail with _controller
    - Classname must be same as filename
    - It can be statically call a controller into another contoller 
        > for example into test2_controller.php:
            test_controller::method(params,...)

    - Each method in controller class is as a route 
        > for example
          url  : /method/[param1][/param2]
          
    - Dont use any namespace in controllers
    - __route__ :
        -  if you make a route in route.php . it override controller method
        -  route.php style:
            ```php
            $routes=[
             # "METHOD PATH"=>['controller@method',['regx_arg1','regx_arg2',...]]
                'home/overrided  '=> ['test@override'],
                'test/prmtst'=> ['test@paramtest',['\d+','\d*']],
                'POST test/post'=> ['test@post'],
            
            ];
            ```


- **Views**
    - views must be stored in app/view . you can change this path on config.php
    - inhertiance & block based 
    - use simple res::render(tpl,data)
    - tpl as html file with simple using variable passed like this:
        - In `test.html` for example we have :
            ```
                <html>
                <body>
                    <span>{$var}</span>
                </body>
                </html>
            ```
        - In `controller`  $var been passed like this:
            ```php
                res::render('test.html',['var'=>'value'])
            ```    
        - __Modifires__ 
            > $variable.modifier1().modifier2().modifier3()}

            List of modifiers:

            |Name|Description
            |-|-
            |upper()|Uppercase
            |lower()|   Lowercase
            |capitalize()|  Capitalize words (ucwords)
            |abs()| Absolute value
            |truncate(len)| Truncate and add "..." if string is larger than "len"
            |count()|   Alias to count()
            |length()|  alias to count()
            |date(format)|  Format date like date(format)
            |nl2br()|   Alias to nl2br
            |stripSlashes()|    Alias to stripSlashes()
            |sum(value)|    Sums value to the current variable
            |substract(value)|  Substracts value to the current variable
            |multiply(value)|   Multiply values
            |divide(value)| Divide values
            |addSlashes()|  Alias of addSlashes()
            |encodeTags()|  Encode the htmls tags inside the variable
            |decodeTags()|  Decode the tags inside the variable
            |stripTags()|   Alias of strip_tags()
            |urldecode()|   Alias of urldecode()
            |trim()|    Alias of trim()
            |sha1()|    Returns the sha1() of the variable
            |numberFormat(decimals) Alias of number_format()
            |lastIndex()|   Returns the last array's index of the variable
            |lastValue()|   Returns the array's last element
            |jsonEncode()|  Alias of json_encode()
            |replace(find,replace)| Alias of str_replace()
            |default(value)|    In case variable is empty, assign it value
            |ifEmpty(value [,else_value])|  If variable is empty assign it value, else if else_value is set, set it to else_value
            |if(value, then_value [,else_value [,comparisson_operator]] )   |Conditionally set the variable's value. All arguments can be variables
            |preventTagEncode()|    If ESCAPE_TAGS_IN_VARS = true, this prevents the variable's value to be encoded
            
        - __Include__ a template inside another template
            >{include footer.html}
             {include http://mypage.com/static.html} ```fetch externalpage```
             
        - __Control structures__
            -   If / else
                ```
                    {if $user.role eq "admin"}
                        <h1>Hello admin</h1>
                    {elseif $user.role.upper() eq "MEMBER" }
                        <h1>Hello member</h1>
                    {else}
                        <h1>Hello guest</h1>
                    {endif}
                ```
                
                You can use regular logic operators (==, !=, >, <, >=, <=, ||, &&) or you can use the following
                  |Operator | Equivalent |
                  |---|---|
                  |eq       |  ==      |
                  |neq      |  !=      |
                  |gt       |  >       |
                  |lt       |  <       |
                  |gte      |  >=      |
                  |lte      |  <=      |
                              
            - Loops
                > <ul>
                    {loop $i,$user in $users}
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <li>{i} - {$user.name.capitalize()}</h1>
                    {endloop}
                    </ul>
                    
         - __Template inheritance__
         ``` supports single template inheritance. The idea behind this is to keep things nice and simple. Multiple inheritance can lead to complicated views difficult to maintain```
          template inheritance is based on blocks. Suppose we have the following base template:

            base.html:
            ```html
            <html>
            <head>
            <title>Tonic</title>
            </head>
            <body>
            <section tn-block="header">
                <h1>Default welcome message!</h1>
            </section>
            <section>
                <div tn-block="content">
                    <p>This is the default content.</p>
                </div>
            </section>
            <section tn-block="footer">Tonic 2016</section>
            </body>
            ```
            inner.html:
            ```html
            { extends base.html }
            <section tn-block="header" class="myheader">
                <h1>Welcome to my inner page!</h1>
            </section>
            <p>This content WON´T be rendered at all!</p>
            <div tn-block="content">
                <p>This is the content of my inner view.
            </div>
            ```
            As a result we will have the following view:
            ```html
            <html>
            <head>
            <title>Tonic</title>
            </head>
            <body>
            <section class="myheader">
                <h1>Welcome to my inner page!</h1>
            </section>
            <section>
                <div>
                    <p>This is the content of my inner view.
                </div>
            </section>
            <section>Tonic 2016</section>
            </body>
            ```
                  

    
    



- **pdo Wrapper**
    - access via db::get([defined_name in database.php])
    - in the following use simple methods:
        select , insert, update, ....
    ```php
        
        $result = db::get()->select("name from tbl limit 10"); 
        /* 
        or using read_db variable group introduced in database.php
        if not set, it uses default_db group in database.config
        */
        
        /* select query from read_db group */
        $result = db::get(read_db)->select("name from tbl limit 10"); 
        res::dump($result);
        
        //use default_db group
        db::get()->insert('tbl',['name'=>'aghae'])  
        
        //use write_db group
        db::get(write_db)->insert('tbl',['id'=>'123','name'=>'aghae'])
        
        db::get()->update('tbl',['email'=>'info@tst.com'],['id'=>'123'])
        ....
        //for db library method goes to API refrences
    ```

- **CLI command or Cronjob:**
    goto public folder and use like this:
    >   _public>_ php index.php controller/method/arg1/arg2/...


- **API Refrences :**
    ```php
        All methods must be called statically like :
        req::render()
        res::json(['id' => 1232]);
        cok::set('mycok','value',['expire'=>300]);
        sess::id()
        ....
    ```
    - **req**
        - raw_post()
        - post($key='')
        - is_ajax()
        - ip()
    - **res**
        -  dump($data)
        -  write($formated_str,$params=[])
        -  json($data)
        -  render($tpl,$data,$layout=null)
    - **sess**
        - id()
        - set($name,$value)
        - get($name='')
        - unset($name)
    - **cok**
        - set($name,$value,$options=[])
        - get($name='')
        - unset($name,$options=[])
    - **db**
        - get($group = false) ```group name that introduced in database.php```
        - raw($sql)
        - select($sql, $named_params = array())
        - insert($table, $data)
        - update($table, $data, $where)
        - delete($table, $where, $limit = 1)
        - truncate($table)
            
    - **http**
        - curl($url, $curl_options=[])
    - **img**
        - resize($src,$dest,$width,$height=null,$to='file') ```$to: file or screen```
        - capcha($sess_name='capcha')   ``` you can get capcha text with=> sess::get('capcha') ```
    - **pagin**
        - make($total, $perPage, $current, $urlPattern) 
        &nbsp;&nbsp;
            ```php
            $urlPattern like this : '/test/pager/(:num)';
            $totalItems   = 1000;
            $itemsPerPage = 50;
            $currentPage  = $num;
            $urlPattern   = '/test/pager/(:num)';
    
            $paginator = pagin::make($totalItems, $itemsPerPage, $currentPage, $urlPattern);
            $paginator->setMaxPagesToShow(5);
            // res::json( $paginator->getPages());
            echo  $paginator->toHtml();
            ```
    - **send**
        - email($to, $subject,$message,$options=[])
            &nbsp;&nbsp;
            ```php
            for example for send via google smtp server
            //you can change smtp option in config.php or change some options like below
            $options=[
                'SMTP_HOST'     =>'smtp.gmail.com',
                'SMTP_USER'     =>'your@gmail.com',
                'SMTP_PASS'     =>'you gmail account pass',
                'SMTP_PORT'     => 587,
                'SMTP_SECURE'   =>'tls', #tls or ssl
                'MAIL_FROM'     =>'info@my.fake',
                'MAIL_FROM_NAME'=>,'mr nobody'
            ] ;

            $status=send::email('you@tst.com','hi','hello <b>World<b>',$options);
            if($status)
                res::write('succesfully sent.');
            ```
    - **crypt**
        - encrypt($string,$secret_key = CRYPT_KEY,$secret_iv = CRYPT_IV)
       - decrypt($string)
            ```php
                define('CRYPT_KEY'  , '3Qr$@lTk!!');
                define('CRYPT_IV'   , '!5ssmKghQii');
                $crytpted =  crypt::encrypt('hello world') ;
                $decrtpted = crypt::decrypt($crytpted) ;
                        
            ```
        
    - **cache**
        - not_buffered($name,$cache_time)
        - buffer($name)
            ```php
            if (cache::not_buffered('cachekey',60)){
             $result = db::get()->select("name from tbl limit 10");
                 res::dump($result);
             cache::buffer('cachekey');
            }
            ```
    - **util**:
        - slugify($string, $separator = '-', $css_mode = false)
        - get_current_url()
        - linkify($text) 
            ``` Turns all of the links in a string into HTML links                ```
        - random_string($length = 16, $human_friendly = true, $include_symbols = false, $no_duplicate_chars = false)
        - force_download($filename, $content = false)
        - get_file_ext($filename)
        - ...
            > for view full util function goto http://brandonwamboldt.github.io/utilphp/
                
Thanks to: 
- Tonic : Ligtweight templating engine
- utilphp :  is a collection of useful functions and snippets that you need or could use every day


**_Good luck ;)_**

