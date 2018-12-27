<?php

require 'config.php';

header('Content-Type: text/html; charset=UTF-8');
function printr($str){
    echo $str;
}
//авторизация
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

//============ begin =======================

$url_auth = 'https://www.facebook.com/login';
    $auth_data = [
        'email' => LOGIN,
        'pass' => PASS,
    ];
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
$res = get_auth($url_auth, $data_a, $auth_data);
print($res);

?>