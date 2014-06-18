<?php
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$token=$_GET['token'];
$timestamp=$_GET['timestamp'];
if($token==md5($timestamp.'sakai-video')){
$upload_dir='uploadfile/video/org/';
$options=array('upload_dir'=>$upload_dir,'upload_url'=>$upload_dir);
$upload_handler = new UploadHandler($options);
}
?>

