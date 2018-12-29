<?php

    header('Content-Type: text/html; charset=UTF-8');
    require('vendor/phpQuery.php');

    function printarr($arr){
        echo '<pre>' . print_r($arr,true) . '</pre>';
    }
    function printr($str){
        echo $str;
    }
    function parser($url,$start,$end){
        if ($start<$end){
            $file = file_get_contents($url);
            $doc = phpQuery::newDocument($file);
            foreach($doc->find('.articles-container .post-excerpt') as $article){
                    $article = pq($article);
                    //из блока articles-container берем блок cat и оборачиваем его в div, добавим дату
                    $article->find('.cat')->wrap('div class="category">')->after('Дата: ' . date("Y-m-d"));
                    //в теге img берем атрибут src
                    $img = $article->find('.img-cont img')->attr('src');
                    //в блоке pd-cont берем его содержимое
                    $text = $article->find('.pd-cont')->html();

                    echo "<img src='img'>";
                    echo $text;
                }
            //====пагинация=====
            //найдем ссылку на следующую страницу
            $next = $doc->find('.pages-nav .current')->next()->attr("href");
            if(!empty($next)){
                $start++;
                //парсим следующую страницу
                parser($next,$start,$end);
            }
        }
        
    }
    
     $url = 'http://www.kolesa.ru/news'; 
     $start = 0;
     //сколько страниц парсить
     $end = 1;
     parser($url,$start,$end);

 ?>