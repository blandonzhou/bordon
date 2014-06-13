<?php
	header('Access-Control-Allow-Origin: *');
        if (isset($_POST['video'])) {
            $result = $_POST['video'];
            $result['file'] = 'http://202.120.83.180/phpcms/' . time() . 'mp4';
            $result['url'] = 'http://202.120.83.180/phpcms/sakai/video/' . $_POST['video']['title'];
            foreach ($result as $k => $v) {
                $result[$k] = urlencode($v);
            }
            $result = urldecode(json_encode($result));
            print_r($result);
        }
?>
