$(function() {
	$('#file_upload').uploadify({
		'formData'     : {
			'timestamp' : '',
			'token'     : ''
		},
		'swf'      : 'uploadify.swf',
		'uploader' : 'uploadify.php',
		'onUploadSuccess' : function(file, data, response) {
		var file=$('#local_video').val()+','+file.name;
		$('#local_video').val(file);
}
		
	});
});
