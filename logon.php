<?php

//процесс авторизации и сохранения куки

function logon(){
    
    $url = URL_AUTH;
    $auth_data = [
        'email' => LOGIN,
        'pass' => PASS,
    ];

    $data = array(
        'authority: www.facebook.com',
        'method: POST',
        'path: /login/device-based/regular/login/?login_attempt=1&lwv=100',
        'scheme: https',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        // 'accept-encoding: gzip, deflate, br',
        'Host: www.facebook.com',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'cookie: ' . DEF_COOKIE,
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
 );

    //0. чистим куки
file_exists(COOKIE_FILE_PATH) ? unlink(COOKIE_FILE_PATH) : null;
if (file_exists(COOKIE_FILE_PATH)){
    echo "Процесс остановлен! Не удалось очистить cookie.";
    exit;
}
// 1. авторизуемся
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
// curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($auth_data));
curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
// curl_setopt($ch, CURLOPT_COOKIEFILE, DEF_COOKIE_FILE_PATH); //куки передаются в CURLOPT_HTTPHEADER
$res = curl_exec($ch);
// curl_exec($ch);
curl_close($ch); 

return $res;
}
?>