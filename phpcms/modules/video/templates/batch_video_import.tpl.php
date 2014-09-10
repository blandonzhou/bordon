<?php 
	defined('IN_ADMIN') or exit('No permission resources.');
	include $this->admin_tpl('header', 'admin');
?>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?m=video&c=batch_import&a=batch_import" method="post" id="myform" enctype="multipart/form-data" >
<table width="100%" class="table_form">

	<tr id="local_method">
		<td width="120">上伟文件</td> 
	
		<td>
		<div id="container">
		
			<input  type='file' name='upload_file' value='upload'>
			
		</div>
		</td>
	</tr>
</table>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button" id="dosubmit">
</form>
</div>
</body>
</html>

