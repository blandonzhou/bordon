<?php
/**
 *  info.func.php ������Ϣ������
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2011-03-15
 */
 
/**
 * �������Ի�����
 * Enter description here ...
 * @param unknown_type $timestamp
 */	
function timeinterval($timestamp) {
    $format=array('����ǰ','����ǰ','Сʱǰ');
    if(is_numeric($timestamp)){
         $i=SYS_TIME-$timestamp;
         switch($i){
            case 60>$i: $str=$i.$format[0];break;  
            case 3600>$i: $str=round ($i/60).$format[1];break;
            case 86400>$i: $str=round ($i/3600).$format[2];break;       
            case $i>86400: $str=date('m-d', $timestamp);break;
        }
     }
     return $str;           		
}

/**
 * ����ɸѡURL
 */
function structure_filters_url($fieldname,$array=array(),$type = 1,$modelid) {
	if(empty($array)) {
		$array = $_GET;
	} else {
		$array = array_merge($_GET,$array);
	}
	//TODO
	$fields = getcache('model_field_'.$modelid,'model');
	if(is_array($fields) && !empty($fields)) {
		ksort($fields);
		foreach ($fields as $_v=>$_k) {
			if($_k['filtertype'] || $_k['rangetype']) {
				if(strpos(URLRULE,'.html') === FALSE) $urlpars .= '&'.$_v.'={$'.$_v.'}';
				else $urlpars .= '-{$'.$_v.'}';
			}
		}
	}
	//��������α��̬������url�������apacheα��̬֧��9������ //ȥ��city
	if(strpos(URLRULE,'.html') === FALSE) $urlrule =APP_PATH.'index.php?m=content&c=index&a=lists&catid={$catid}'.$urlpars.'&page={$page}' ;
	else $urlrule =APP_PATH.'list-{$catid}-{$city}'.$urlpars.'-{$page}.html';
	//����get��ֵ����URL
	if (is_array($array)) foreach ($array as $_k=>$_v) {
		if($_k=='page') $_v=1;
		if($type == 1) if($_k==$fieldname) continue;
		$_findme[] = '/{\$'.$_k.'}/';
		$_replaceme[] = $_v;
	}
     //type ģʽ��ʱ�򣬹����ų����ֶ����Ƶ�����
	if($type==1) $filter = '(?!'.$fieldname.'.)';
	$_findme[] = '/{\$'.$filter.'([a-z0-9_]+)}/';
	$_replaceme[] = '';		
	$urlrule = preg_replace($_findme, $_replaceme, $urlrule);	
	return 	$urlrule;
}

/**
 * ����ɸѡʱ���sql���
 */
function structure_filters_sql($modelid,$cityid='') {
	$sql = $fieldname = $min = $max = '';
	$fieldvalue = array();
	$modelid = intval($modelid);
	$model =  getcache('model','commons');
	$fields = getcache('model_field_'.$modelid,'model');
	$fields_key = array_keys($fields);
	//TODO

	$sql = '`catid` = \''.$_GET[catid].'\'';
	if(intval($cityid)!=0)  $sql .= ' AND `city`=\''.$cityid.'\'';
	foreach ($_GET as $k=>$r) {
		if(in_array($k,$fields_key) && intval($r)!=0 && ($fields[$k]['filtertype'] || $fields[$k]['rangetype'])) {
			if($fields[$k]['formtype'] == 'linkage') {
				$datas = getcache($fields[$k]['linkageid'],'linkage');
				$infos = $datas['data'];
				if($infos[$r]['arrchildid']) {
					$sql .=  ' AND `'.$k.'` in('.$infos[$r]['arrchildid'].')';	
				}	
			} elseif($fields[$k]['rangetype']) {
				if(is_numeric($r)) {
					$sql .=" AND `$k` = '$r'";
				} else {
					$fieldvalue = explode('_',$r);
					$min = intval($fieldvalue[0]);
					$max = $fieldvalue[1] ? intval($fieldvalue[1]) : 999999;				
					$sql .=" AND `$k` >= '$min' AND  `$k` < '$max'";
				}
			} else {	
				$sql .=" AND `$k` = '$r'";
			}
		}
	}	
	return $sql;
}

/**
 * ���ɷ�����Ϣ�е�ɸѡ�˵�
 * @param $field   �ֶ�����
 * @param $modelid  ģ��ID
 */
function filters($field,$modelid,$diyarr = array()) {
	$fields = getcache('model_field_'.$modelid,'model');
	$options = empty($diyarr) ?  explode("\n",$fields[$field]['options']) : $diyarr;
	$field_value = intval($_GET[$field]);
	foreach($options as $_k) {
		$v = explode("|",$_k);
		$k = trim($v[1]);
		$option[$k]['name'] = $v[0];
		$option[$k]['value'] = $k;
		$option[$k]['url'] = structure_filters_url($field,array($field=>$k),2,$modelid);
		$option[$k]['menu'] = $field_value == $k ? '<em>'.$v[0].'</em>' : '<a href='.$option[$k]['url'].'>'.$v[0].'</a>' ;
	}
	$all['name'] = 'ȫ��';
	$all['url'] = structure_filters_url($field,array($field=>''),2,$modelid);
	$all['menu'] = $field_value == '' ? '<em>'.$all['name'].'</em>' : '<a href='.$all['url'].'>'.$all['name'].'</a>';

	array_unshift($option,$all);	
	return $option;
}

/**
 * ͨ��ָ��keyid��ʽ��ʾ���������˵�
 * @param  $keyid �˵���id
 * @param  $linkageid  �����˵�id
 * @param  $toppatentid �����˵�id
 * @param  $modelid ģ��id
 * @param  $fieldname  �ֶ�����
 * @param  $showall �Ƿ���ʾȫ��
 */
function show_linkage($keyid, $linkageid = 0, $toppatentid = '', $modelid = '', $fieldname='zone' ,$showall = 1) {
	$datas = $infos =array();
	$keyid = intval($keyid);
	$linkageid = intval($linkageid);
	$urlrule = structure_filters_url($fieldname,$array,1,$modelid);
	if($keyid == 0 || $linkageid == 0) return false;
	$datas = getcache($keyid,'linkage');
	$infos = $datas['data'];
	$linkageid_tmp = $infos[$linkageid]['child'] ? $linkageid : $infos[$linkageid]['parentid'];
	if($linkageid_tmp == $toppatentid) $linkageid_tmp = $linkageid;
	if(is_array($infos) && !empty($infos)) {
		foreach ($infos as $k => $v) {
			if($v['parentid'] != $linkageid_tmp) {
				unset($infos[$k]);
				continue;
			}
			$url = preg_replace('/{\$'.$fieldname.'}/', $v['linkageid'], $urlrule);
			$url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);		
			$infos[$k]['url'] = $url;
		}
	}
	if($toppatentid == $linkageid) $linkageid_tmp = '';
	if($showall && !empty($infos)) array_unshift($infos,array('name'=>'ȫ��','url'=>preg_replace('/{\$'.$fieldname.'}/', $linkageid_tmp, $urlrule),'linkageid'=>$linkageid_tmp));
	return $infos;
}
/**
 * ��ȡ�����˵��㼶
 * @param  $keyid     �����˵�����id
 * @param  $linkageid �˵�id
 * @param  $leveltype ��ȡ���� parentid ��ȡ����id child ��ȡʱ��������Ŀ arrchildid ��ȡ����Ŀ����
 */
function get_linkage_level($keyid,$linkageid,$leveltype = 'parentid') {
	$child_arr = $childs = array();
	$leveltypes = array('parentid','child','arrchildid','arrchildinfo');
	$datas = getcache($keyid,'linkage');
	$infos = $datas['data'];
	if (in_array($leveltype, $leveltypes)) {
		if($leveltype == 'arrchildinfo') {
			$child_arr = explode(',',$infos[$linkageid]['arrchildid']);
			foreach ($child_arr as $r) {
				$childs[] = $infos[$r];
			}
			return $childs;
		} else {
			return $infos[$linkageid][$leveltype];
		}
	}	
}


/**
 * ����box�����ֶλ�ȡ��ʾ����
 * @param $field �ֶ�����
 * @param $value �ֶ�ֵ
 * @param $modelid �ֶ�����ģ��id
 */
function box($field, $value, $modelid='') {
	$fields = getcache('model_field_'.$modelid,'model');
	extract(string2array($fields[$field]['setting']));
	$options = explode("\n",$fields[$field]['options']);
	foreach($options as $_k) {
		$v = explode("|",$_k);
		$k = trim($v[1]);
		$option[$k] = $v[0];
	}
	$string = '';
	switch($fields[$field]['boxtype']) {
			case 'radio':
				$string = $option[$value];
			break;

			case 'checkbox':
				$value_arr = explode(',',$value);
				foreach($value_arr as $_v) {
					if($_v) $string .= $option[$_v].' ��';
				}
			break;

			case 'select':
				$string = $option[$value];
			break;

			case 'multiple':
				$value_arr = explode(',',$value);
				foreach($value_arr as $_v) {
					if($_v) $string .= $option[$_v].' ��';
				}
			break;
		}
			return $string;
}
	
/**
 * ��ȡ��Ϣ���û������
 * @param $key ��Ϣģ�Ͳ�������
 * @param $filename �ֶ�ֵ �����ļ����ƣ�Ĭ��Ϊinfo_setting
 */
function getinfocache($key, $filename = 'info_setting') {
	$infos = getcache($filename,'commons');
	if(is_array($infos) && !empty($infos) && array_key_exists($key, $infos)) {
		if($key == 'info_modelid') {
			$model =  getcache('model','commons');
			$modelids = explode(',', $infos[$key]);
			if(is_array($modelids)) {
				foreach($modelids as $m) {
					$models[$m] = $model[$m];	
				}
			}
			return $models;
		}	
		return  $infos[$key];
	}	
}

/**
 * ��ȡ��Ϣ���ó�����Ϣ
 * @param $key ���б�ţ�ͨ��Ϊ����ƴ������
 * @param $info ��ȡ��������
 * @param $showall �Ƿ���ʾ����
 */
function getcity($key ='', $info = '', $filename = 'info_citys', $showall = '0') {
	$citys = $current_city = array();
	$citys = getcache($filename,'commons');
	$key = strtolower(trim($key));
	if(is_array($citys) && !empty($citys) && !$showall && $info) {
		if(array_key_exists($key, $citys)) {
		    return  $citys[$key][$info];
		} else {
			$current_city = current($citys);
			return $current_city[$info];
		}
		
	} else {
		return $citys;
	}
}

function getlocalinfo($ip) {
	pc_base::load_sys_func('iconv');
	$ip_area = pc_base::load_sys_class('ip_area');
	$localinfo = $ip_area->getcitybyapi($ip);
	$info['name'] = $localinfo['city']; 
	$info['pinyin'] = $localinfo['pinyin']; 
	return $info;

} 

function makeurlrule() {
	if(strpos(URLRULE,'.html') === FALSE) {
		return url_par('page={$'.'page}');
	}
	else {
		$url = preg_replace('/-[0-9]+.html$/','-{$page}.html',get_url());
		return $url;
	}
}

function makecaturl($url, $city, $multi_city = '1') {
	if($multi_city) {
		if(strpos($url,'.html') === FALSE) {
			return $url.'&city='.$city;
		} else {
			return preg_replace('/(-[0-9]+).html$/i', '-'.$city.'$0', $url);
		}
	} else {
		return $url;
	}
}
?>