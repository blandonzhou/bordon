// Custom example logic
function $$(id) {
	return document.getElementById(id);	
}
   // var upload_allowext = document.getElementById("upload_allowext").value;

  //  var upload_allowsize = document.getElementById("upload_allowsize").value;

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: $$('container'), // ... or DOM Element itself
	max_file_size : "2000m",
	chunk_size : '10240kb',
		 multipart_params: { dosubmit2: "upload" },
	url : 'index.php?&m=attachment&c=attachments&a=swfupload_bcs&dosubmit=1',
	flash_swf_url : '../js/Moxie.swf',
	unique_names:true,
	silverlight_xap_url : '../js/Moxie.xap',
	filters : [
		{title : "video files", extensions : "mp4,jpg,gif,png,zip,exe"}
		
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
			if (file.percent == 100) {
				$$(file.id).getElementsByTagName('b')[1].innerHTML = '<span style="padding-left:10px;"><font color="red">视频上传器中，请稍后</font><img src="statics/images/ucfu/bcs_upload.gif"></span>';
			}
		},

		//文件上传后执行的方法
 		FileUploaded: function(up, file, info) {

			if (info.status == 200) {
				var obj = info.response.split(':');
				
				//返回上传的链接并设置input
				//http://bcs.duapp.com/ucfu-video/bcs-e82b3b777313db3110db32e5f89a7308.mp4
				var v2 = obj[5];
				var reg=/}$/;
				var v2=v2.replace(reg,"");
				
				var v = obj[4] + ':' + v2;
				
				$$('bc_file').value = v;
				$$(file.id).getElementsByTagName('b')[1].innerHTML = '<span style="padding-left:10px;"><font color="green">视频上传完毕。</font></span>';
                $$("filelist").innerHTML='';

				// alert(resdata[1]);
			} else {
				alert('文件上传失败');
			}
		},

		Error: function(up, err) {
			$$('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}

	}
});

uploader.init();

