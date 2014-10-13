	function ossupload($field, $value, $fieldinfo) {
		extract($fieldinfo);
		$setting = string2array($setting);
		$string ='
				<script src="'.JS_PATH.'/vendor/jquery.ui.widget.js"></script>
				<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
				<script src="'.JS_PATH.'/jquery.iframe-transport.js"></script>
				<!-- The basic File Upload plugin -->
				<script src="'.JS_PATH.'/jquery.fileupload.js"></script>';

		$string .= <<<EOF
	
	<div id="container">
		<input type='text' name='info[$field]' id='$field' value='$value' class='input-text' style='width:60%'/>
		<input id="upload-$field" type="file" multiple="false" >
		<span id="progress-$field" style="float:left;display:block;"></span>
	</div>


	<script>
		$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = '$action';
	    $('#upload-$field').fileupload({
	        url: url,
	        dataType: 'json',
	        done: function (e, data) {
	                $('#$field').val(data.result.mp4);
	                $('#thumb').val(data.result.thumb);
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            if(progress == 100){
	            	$('#progress-$field').text(
		                '正在转码中，请稍等... '
	            	);
	            }
	            else{
		            $('#progress-$field').text(
		                '正在上传中，请稍等... '+progress + '%'
		            );
	            }

	        }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>


EOF;

	return $string;
	}

