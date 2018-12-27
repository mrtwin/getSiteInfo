<?php

    header('Content-Type: text/html; charset=UTF-8');
    require('vendor/phpQuery.php');
    define("COOKIE_FILE_PATH", __DIR__ . '/cookie.txt');
    
    function printarr($arr){
        echo '<pre>' . print_r($arr,true) . '</pre>';
    }
    function printr($str){
        echo $str;
    }

    function get_auth($url,$data = [],$data_a = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
        // curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_a));
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        $res = curl_exec($ch);
        // curl_exec($ch);
        curl_close($ch); 
        return $res;   
    }

    function get_content($url,$data = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
        // curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102");
        // curl_setopt($ch, CURLOPT_FILE, $fp); //вывод в файл
        $res = curl_exec($ch);
        // curl_exec($ch);
        curl_close($ch); 
        return $res;   
    }
    
//=============demoshop.qfenix.ru====================
    // $url = 'http://demoshop.qfenix.ru/wp-admin/edit.php?post_type=page'; 
    // $fp = fopen("file.txt","w");
    // $data = array(
    //     'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
    //     // 'Accept-Encoding: gzip, deflate',
    //     'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    //     'Connection: keep-alive',
    //     'Cookie: wordpress_13f3907ad56bca487874cb02b1342dec=admin%7C1545991394%7Czd2OIIPPXVKy5FDG3ySkfTt1gYS50rNWKRZEVyE3pjj%7Cc8a80b5b495d45dba8124582edef16040a76b2386580a6c102565f6a3182b8ac; _ym_uid=1542114419524508789; _ym_d=1542114419; at-user-id=CER6W0CUe5I6KKdrOKkFPnNiS; wp-settings-3=libraryContent%3Dbrowse; wp-settings-time-3=1545221749; wordpress_test_cookie=WP+Cookie+check; PHPSESSID=222732a2508edfdbe9a8537b8bc51f0e; wordpress_logged_in_13f3907ad56bca487874cb02b1342dec=admin%7C1545991394%7Czd2OIIPPXVKy5FDG3ySkfTt1gYS50rNWKRZEVyE3pjj%7C84f0e56dd2a93bd42bef7f2939b9d038765ba9e3d6f24163cf4aa4487ffc196e; wp-settings-1=libraryContent%3Dbrowse%26hidetb%3D1%26imgsize%3Dthumbnail%26editor%3Dtinymce%26align%3Dcenter; wp-settings-time-1=1545818595; woocommerce_items_in_cart=1; woocommerce_cart_hash=c7242e17e5f3167d9455af305402d92f; wp_woocommerce_session_13f3907ad56bca487874cb02b1342dec=1%7C%7C1545991457%7C%7C1545987857%7C%7C3940ec815a87a9305a983a51267edf99',
    //     'Host: demoshop.qfenix.ru',
    //     'Referer: http://demoshop.qfenix.ru/wp-admin/',
    //     'Upgrade-Insecure-Requests: 1',
    //     'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
    // );

//==============FB============================
    $url_auth = 'https://www.facebook.com/login';
    $auth_data = [
        'email' => 'ннн',
        'pass' => 'ччч',
    ];
    $url = 'https://www.facebook.com/groups/Velik/members/'; 
    $data = array(
        'authority: www.facebook.com',
        'method: GET',
        'path: /groups/Velik/members/',
        'scheme: https',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        // 'accept-encoding: gzip, deflate, br',
        'Host: www.facebook.com',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        // 'cookie: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
    );
    $data_a = array(
        'authority: www.facebook.com',
        'method: POST',
        'path: /login/device-based/regular/login/?login_attempt=1&lwv=100',
        'scheme: https',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        // 'accept-encoding: gzip, deflate, br',
        'Host: www.facebook.com',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
    );
    // $res = get_auth($url_auth, $data_a, $auth_data);
    $res = get_content($url, $data);
    print($res);
 ?>