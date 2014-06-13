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
	//unique_names : false,
	 multipart_params: { dosubmit2: "upload" },
	//url : 'index.php?&m=attachment&c=attachments&a=swfupload_bcs&dosubmit=1',
	url : 'upload.php',
	flash_swf_url : '../js/Moxie.swf',
	//unique_names:true,
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
				$$('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><b></b></div>';
			});
		},
	
		UploadProgress: function(up, file) {
			$$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			
		},

		//�ļ��ϴ���ִ�еķ���
 		FileUploaded: function(up, file, info) {
		//dump(info);

			if (info.status == 200) {
				
				
			$$('filelist').style.display = 'none';
				var resdata = info.response.split(',');
				
				if (info.response.match('exists')){
					alert('�ļ������ڣ���ˢ�±�ҳ����ѡ��');
				}
				
				
				var a = eval('('+resdata+')');
			
				
				var _v = $$('local_video').value + ',';
			
				$$('local_video').value =  _v + a.filepath;
				
       
			} else {
				alert('�ļ��ϴ�ʧ��');
			}
		},

		Error: function(up, err) {
			$$('console').innerHTML += "<font color='red'>�ϴ�ʧ��</font> #" + err.code + ": " + err.message;
		}

	}
});

uploader.init();
