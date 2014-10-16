<?php
//error_reporting(E_ALL | E_STRICT);
error_reporting(E_ERROR|E_PARSE|E_CORE_ERROR|E_COMPILE_ERROR);
//require('UploadHandler.php'); 
require('phpcms/plugin/aliyun-oss/OssUploadHandler.php');
$token=$_GET['token'];
$timestamp=$_GET['timestamp'];
if($token==md5($timestamp.'sakai-video')){
//    //$upload_dir='uploadfile/video/org/';
//    //$options=array('upload_dir'=>$upload_dir,'upload_url'=>$upload_dir);
//    //$upload_handler = new UploadHandler();
    $upload_handler = new  OssUploadHandler();
}
?>