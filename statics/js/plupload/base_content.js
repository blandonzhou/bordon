// Custom example logic
function $$(id) {
	return document.getElementById(id);	
}
   // var upload_allowext = document.getElementById("upload_allowext").value;

   // var upload_allowsize = document.getElementById("upload_allowsize").value;

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: $$('container'), // ... or DOM Element itself
	max_file_size : '20000m',
	chunk_size : '10240kb',
	unique_names : true,
	 multipart_params: { dosubmit2: "upload" },
	//url : 'index.php?&m=attachment&c=attachments&a=swfupload_bcs&dosubmit=1',
	url : 'upload.php',
	flash_swf_url : '../js/Moxie.swf',
	unique_names:true,
	silverlight_xap_url : '../js/Moxie.xap',
	filters : [
		{title : "video files", extensions : "flv,mp4,wmv,avi,jpg,gif,png,zip,exe"}
		
	],
	init: {
		
		PostInit: function() {
			$$('filelist').innerHTML = '';

			$$('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				$$('filelist').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><b></b></div>';
			});
		},
	
		UploadProgress: function(up, file) {
			$$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			
		},

		//文件上传后执行的方法
 		FileUploaded: function(up, file, info) {
		

			if (info.status == 200) {
				
				
			$$('filelist').style.display = 'none';
				var resdata = info.response.split(',');
				
				
				
				
				var a = eval('('+resdata+')');
			
				
				
			
				$$('local_video').value =  a.filepath;
				
       
			} else {
				alert('文件上传失败');
			}
		},

		Error: function(up, err) {
			$$('console').innerHTML += "<font color='red'>上传失败</font> #" + err.code + ": " + err.message;
		}

	}
});

uploader.init();

