<?php
function sms_status($status = 0,$return_array = 0) {
	$array = array(
			'0'=>'���ͳɹ�',
			'1'=>'�ֻ�����Ƿ�',
			'2'=>'�û������ں������б�',
			'3'=>'�����û������������',
			'4'=>'��Ʒ���벻����',
			'5'=>'IP�Ƿ�',
			'6 '=>'Դ�������',
			'7'=>'�������ش���',
			'8'=>'��Ϣ���ȳ���60',
			'9'=>'���Ͷ������ݲ���Ϊ��',
			'10'=>'�û���������ͣ��ҵ��',
			'11'=>'wap���ӵ�ַ�������Ƿ�',
			'12'=>'5�����ڸ�ͬһ�����뷢�Ͷ��ų���10��',
			'13'=>'����ģ��IDΪ��',
			'14'=>'��ֹ���͸���Ϣ',
			'-1'=>'ÿ���ӷ������ֻ��ŵĶ��������ܳ���3��',
			'-2'=>'�ֻ��������',
			'-11'=>'�ʺ���֤ʧ��',
			'-10'=>'SNDA�ӿ�û�з��ؽ��',
		);
	return $return_array ? $array : $array[$status];
}

function checkmobile($mobilephone) {
		$mobilephone = trim($mobilephone);
		if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[01236789]{1}[0-9]{8}$|18[01236789]{1}[0-9]{8}$/",$mobilephone)){  
 			return  $mobilephone;
		} else {    
			return false;
		}
		
}

function get_smsnotice($type = '') {
	$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
	$urls = base64_decode('aHR0cDovL3Ntcy5waHBpcC5jb20vYXBpLnBocD9vcD1zbXNub3RpY2UmdXJsPQ==').$url."&type=".$type;
	$content = pc_file_get_contents($urls,5);
	if($content) {
		$content = json_decode($content,true);
		if($content['status']==1) {
			return strtolower(CHARSET)=='gbk' ?iconv('utf-8','gbk',$content['msg']) : $content['msg'];
		}
	}
	$urls = base64_decode('aHR0cDovL3Ntcy5waHBjbXMuY24vYXBpLnBocD9vcD1zbXNub3RpY2UmdXJsPQ==').$url."&type=".$type;
	$content = pc_file_get_contents($urls,3);
	if($content) {
		$content = json_decode($content,true);
		if($content['status']==1) {
			return strtolower(CHARSET)=='gbk' ?iconv('utf-8','gbk',$content['msg']) : $content['msg'];
		}
	}
	return '<font color="red">����ͨ�������޷����ʣ������޷�ʹ�ö���ͨ����</font>';
}