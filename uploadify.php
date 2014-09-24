<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	// Validate the file type
	$fileTypes = array('dat','mpg','wlv','mpv','vob','mpg','asf','wmv','avi','divx','xvid','mov','mp4','mkv','swf','flv','f4v','mts','m2t','mt2s','wav','mp3','ape','ogg','flac','ra','3gp','ts','rm','rmvb'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
        $targetPath = 'uploadfile/video/org/';
        //$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
        $targetPath .= date('Y/m/', time());
        if(!file_exists($targetPath)){
            mkdir($targetPath,0,true);
        }
        $targetFile=$targetPath . uniqid("upload_") . '.' . $fileParts['extension'];
        
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		//echo '1';
                echo $targetFile;
	} else {
		echo 'Invalid file type.';
	}
}
?>

