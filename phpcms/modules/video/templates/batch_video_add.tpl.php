<?php 
	defined('IN_ADMIN') or exit('No permission resources.');
	include $this->admin_tpl('header', 'admin');
	
	
	
	
?>
<script type="text/javascript" src="<?php echo JS_PATH;?>video/swfobject.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>video/swfobject2.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>



<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />

<div class="pad-10">
<div class="common-form">
<form name="myform" action="?m=video&c=batch_upload&a=batch_add" method="post" id="myform" enctype="multipart/form-data" ><input type="hidden" name="userupload" value="1">
<input type="hidden" value="" name="batch_insert" />
<table width="100%" class="table_form">

<script type="text/javascript" src="<?php echo JS_PATH;?>plupload/plupload.full.min.js"></script>
	<tr id="local_method">
		<td width="120">ɨ���ļ�</td> 
	
		<td>
		<div id="container">
		
			<input id='pickfiles' type='button' class='button' value='��ʼɨ��'>
			
		</div>
		</td>
	</tr>
	

	<tr>
			<td width="120"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"> ȫѡ </td>
            <td> </td>
           
     </tr>
	
	



	<tr>
	
	
		<td width="120">������</td> 
		<td>
			<input type="radio" name="r" value="1"/>��ͨ
			<input type="radio" name="r" value="2"/>����
			
	
		</td>
	</tr>
	<tr>
		<td width="120"><?php echo L('video_description')?></td> 
		<td><textarea id="description" name="description" rows="5" cols="50"></textarea></td>
	</tr>
	
	<tr>
		
		<td>
		<a href="javascript:;" onclick="omnipotent('selectid','?m=content&c=content&a=add_othors&siteid=1','ͬʱ������������Ŀ',1);return false;" style="color:red">[��������Ŀ]</a>
	
		</td>
		<td>
		<ul class='list-dot-othors' id='add_othors_text'></ul>
		</td>
	
	</tr>

	
</table>
<div class="bk15"></div>
<input type="hidden" name="vid" id="vid" value="0">
<input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button" id="dosubmit">
</form>
</div>
</body>
</html>
<script type="text/javascript">

$(document).ready(function() {

//�Ƴ�ID

	
	function selectall(name) {

	if ($("#check_box").attr("checked")=='checked') {
		$("input[name='"+name+"']").each(function() {
  			$(this).attr("checked","checked");
			
		});
	} else {
		$("input[name='"+name+"']").each(function() {
  			$(this).removeAttr("checked");
		});
	}
}


	$("#pickfiles").bind('click',function(){
		
		 $.ajax({  
			
			url: "index.php?m=video&c=batch_upload&a=get_filename&pc_hash=<?php echo $_SESSION['pc_hash']?>",

			beforeSend: 
			
					function(){  
						
						$('#pickfiles').val('ɨ����...');
						
		
					}, 
					
			success: 
			
				function(data){   
						
						$('#local_method').after(data);
						
						$('#pickfiles').val('��ɣ�');
						
						$('#pickfiles').unbind('click');
						
						
			
				}  
		});
	
	});
	

});

</script>