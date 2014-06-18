// Custom example logic
function $$(id) {
	return document.getElementById(id);	
}

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: $$('container'), // ... or DOM Element itself
	max_file_size : '200mb',
	chunk_size : '10240kb',
	url : 'index.php?&m=attachment&c=attachments&a=swfupload_bcs&dosubmit=1',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	filters : [
		{title : "Image files", extensions : "mp4,jpg,gif,png"},
		{title : "Zip files", extensions : "zip"}
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
				$$('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			$$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			$$('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();
