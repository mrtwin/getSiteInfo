<?php

    header('Content-Type: text/html; charset=UTF-8');
    require('vendor/phpQuery.php');

    function printarr($arr){
        echo '<pre>' . print_r($arr,true) . '</pre>';
    }
    function printr($str){
        echo $str;
    }

    function get_content($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_HEADER, true); //вывод заголовков ответа - полезно для отладки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //возвращает результат в переменную
        // curl_setopt($ch, CURLOPT_FILE, $fp); //вывод в файл
        $res = curl_exec($ch);
        curl_close($ch); 
        return $res;   
    }

    function parser($url,$start,$end){
        if ($start<$end){
            // $file = file_get_contents($url);
            $file = get_content($url);
            $doc = phpQuery::newDocument($file);
            foreach($doc->find('.articles-container .grid-row a') as $article){
                    $article = pq($article);
                    //из блока articles-container берем блок cat и оборачиваем его в div, добавим дату
                    $article->find('.cat')->wrap('div class="category">')->after('Дата: ' . date("Y-m-d"));
                    //в теге img берем атрибут src
                    $img = $article->find('.img-cont img')->attr('src');
                    //в блоке pd-cont берем его содержимое
                    $text = $article->find('.pe-title')->html();

                    echo "<img src='img'>";
                    echo $article;
                    echo $text;
                }
            //====пагинация=====
            //найдем ссылку на следующую страницу
            $next = $doc->find('.pages-nav .current')->next()->attr("href");
            if(!empty($next)){
                $start++;
                parser($next,$start,$end);
            }
        }
        
    }
    // function get_content($url,$referer,$accessToken,$data = []){
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_HEADER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.102");
    //     curl_setopt($ch, CURLOPT_REFERER, $referer);
    //     // curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $accessToken);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //     // curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    //     // curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $res = curl_exec($ch);
    //     curl_close($ch);
    //     return $res;
    // }

     $url = 'http://www.kolesa.ru/news'; 
     $start = 0;
     //сколько страниц парсить
     $end = 1;
    $fp = fopen("file.txt","w");
    parser($url,$start,$end);
 ?>