<?php
$v=$_REQUEST['v'];
$v=  base64_decode($v);
$path='uploadfile/video/';
$file=$path.$v;
$content = fread(fopen($file, 'r'), filesize($file));
header("Content-type: video/*");
echo $content;
?>

