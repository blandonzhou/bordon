	function bcsfile($field, $value, $fieldinfo) {
		$list_str = $str = '';
		extract(string2array($fieldinfo['setting']));
         $bcs_info=string2array($fieldinfo['setting']);

		if($value){
			$value_arr = explode('|',$value);
			$value = $value_arr['0'];
			$sel_server = $value_arr['1'] ? explode(',',$value_arr['1']) : '';
			$edit = 1;
		} else {
			$edit = 0;
		}
		$server_list = getcache('downservers','commons');
		
		if(is_array($server_list)) {
			foreach($server_list as $_k=>$_v) {
				if (in_array($_v['siteid'],array(0,$fieldinfo['siteid']))) {
					$checked = $edit ? ((is_array($sel_server) && in_array($_k,$sel_server)) ? ' checked' : '') : ' checked';
					$list_str .= "<lable id='bcsfile{$_k}' class='ib lh24' style='width:25%'><input type='checkbox' value='{$_k}' name='{$field}_servers[]' {$checked}>  {$_v['sitename']}</lable>";
				}
			}
		}
	if(!defined('IMAGES_INIT')) {
			$str = '
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript" src="'.JS_PATH.'swfupload/swf2ckeditor.js"></script>
					<script type="text/javascript" src="'.JS_PATH.'uploadify/jquery.uploadify.min.js"></script>
         
			';
			define('IMAGES_INIT', 1);
		}	
		$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");	
		$string .= $str."";
        
		$string .= <<<EOF
	
	<div id="container">
		<input type='text' name='info[$field]' id='$field' value='$value' class='input-text' style='width:60%'/>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<input id="upload_allowsize" type="hidden" value="{$bcs_info['upload_allowsize']}">
		<input id="upload_allowext"  type="hidden" value="{$bcs_info['upload_allowext']}">
	</div>
<pre id="console"></pre>

EOF;
		$my = '<script type="text/javascript" src="'.JS_PATH.'dump.js"></script>

			   <script type="text/javascript">
               $(function() {
					$("#file_upload").uploadify({
						"formData"     : {
							"timestamp" : "'.time().'",
							"token"     : "'.md5('unique_salt' . time()).'"
						},
                                                "sizeLimit" : "99999999999 ",
						"buttonText" : "Ñ¡ÔñÎÄ¼þ",
						"swf"      : "'.JS_PATH.'uploadify/uploadify.swf",
				
						"uploader" : "'.APP_PATH.'uploadify.php",
						"onUploadSuccess" : function(file, data, response) {
						var file=$("#local_video").val()+",uploadfile/video/org/"+file.name;
						$("#local_video").val(file);
				}
						
					});
				});

               </script>
        ';
		return $string . $my;

		return $string;
	}
