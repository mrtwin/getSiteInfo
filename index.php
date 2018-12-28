<?php

require ('config.php');
require ('logon.php');
header('Content-Type: text/html; charset=UTF-8');

function printr($str){
    echo $str;
}
//авторизация
// function get_auth($url,$data = [],$auth_data = []){
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
//     // curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($auth_data));
//     curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
//     // curl_setopt($ch, CURLOPT_COOKIEFILE, DEF_COOKIE_FILE_PATH); //куки передаются в CURLOPT_HTTPHEADER
//     $res = curl_exec($ch);
//     // curl_exec($ch);
//     curl_close($ch); 
//     return $res;   
// }
function get_content($url,$data = []){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
    // curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
    curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH); //куки получены в файл при авторизации
    $res = curl_exec($ch);
    // curl_exec($ch);
    curl_close($ch); 
    return $res;   
}
//============ begin =======================

$url = 'https://www.facebook.com/groups/Velik/members/'; 
// $url_auth = 'https://www.facebook.com/login';
// $auth_data = [
//     'email' => LOGIN,
//     'pass' => PASS,
// ];
// $data_a = array(
//         'authority: www.facebook.com',
//         'method: POST',
//         'path: /login/device-based/regular/login/?login_attempt=1&lwv=100',
//         'scheme: https',
//         'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
//         // 'accept-encoding: gzip, deflate, br',
//         'Host: www.facebook.com',
//         'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
//         'cookie: ' . DEF_COOKIE,
//         'Upgrade-Insecure-Requests: 1',
//         'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
//  );
// function get_http_header($url){
$data = array(
    'authority: www.facebook.com',
    'method: GET',
    // 'path: /groups/Velik/members/',
    'scheme: https',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
    // 'accept-encoding: gzip, deflate, br',
    'Host: www.facebook.com',
    'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    // 'cookie: xxx',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102'
);
 //}
 

//0. чистим куки
// file_exists(COOKIE_FILE_PATH) ? unlink(COOKIE_FILE_PATH) : null;
// if (file_exists(COOKIE_FILE_PATH)){
//     // if (file_exists("id.txt")){
//     echo "Процесс остановлен! Не удалось очистить cookie.";
//     exit;
// }

// 1. авторизуемся
// $res = logon();
//// $res = get_auth($url_auth, $data_a, $auth_data);

// 2. проверим результат
if (!file_exists(COOKIE_FILE_PATH)){
    echo "Процесс остановлен! Cookie не найдены.";
    exit;
} 
else {
    $cf = file_get_contents(COOKIE_FILE_PATH);
    if (!preg_match("/c_user\s\d\d/",$cf)){
        echo "Процесс остановлен! В файле не найдены cookie сайта.";
        exit;
    }
}
//3. берем данные страницы
$res = get_content($url, $data);

//4. проверим результат
//убедимся что есть тег
//<h1 id="seo_h1_tag" class="_19s-"><a href="/groups/Velik/?ref=group_header">Велосипед</a></h1>

//5. подготовим ссылку пагинации
$ajax_link = PAG_LINK;
$ajax_link=preg_replace('/(limit=)\d+&/', '${1}100&', $ajax_link);//сколько участников группы брать
$ajax_link=preg_replace('/(start=)\d+&/', '${1}1&', $ajax_link);//с какого участника начинать

//6. берем участников группы
// $res = get_content($ajax_link, $data);


printr($res);

?>