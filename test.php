<?php
require 'config.php';


$cf = '.facebook.com	TRUE	/	TRUE	1553762696	c_user 762 ';

if (preg_match("/c_user \d\d/",$cf, $matches)){
    var_dump($matches);
};
$ajax_link = PAG_LINK;
echo $ajax_link;
$ajax_link=preg_replace('/(limit=)\d+&/', '${1}100&', $ajax_link);
$ajax_link=preg_replace('/(start=)\d+&/', '${1}1&', $ajax_link);
echo '\n ';
echo $ajax_link;
?>