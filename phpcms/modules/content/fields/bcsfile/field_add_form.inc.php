<?php 
$server_list = getcache('downservers','commons');
foreach($server_list as $_r) if (in_array($_r['siteid'],array(0,$this->siteid))) $str .='<span class="ib" style="width:25%">'.$_r['sitename'].'</span>';
?>
<fieldset>
<legend>����������б�</legend>
<?php echo iconv(CHARSET,'utf-8',$str)?>
</fieldset>
<table cellpadding="2" cellspacing="1" width="98%">
	<tr>
	<td>�������ط�ʽ</td>
	<td>
      	<input name="setting[downloadlink]" value="0" type="radio">
        ���ӵ���ʵ�����ַ 
        <input name="setting[downloadlink]" value="1" checked="checked" type="radio">
        ���ӵ���תҳ��
      
	</td></tr>	
	<tr>
	<td>�ļ����ط�ʽ</td>
	<td>
      	<input name="setting[downloadtype]" value="0" type="radio">
        �����ļ���ַ 
        <input name="setting[downloadtype]" value="1" checked="checked" type="radio">
        ͨ��PHP��ȡ      
	</td></tr>
	<tr> 
      <td>�����ϴ�����Ƶ����</td>
      <td><input type="text" name="setting[upload_allowext]" value="rar|zip" size="40" class="input-text"><font color="red">�ϴ��ļ��������ö���(,)�ֿ�</font></td>
    </tr>
		<tr> 
      <td>�����ϴ�����Ƶ��С</td>
      <td><input type="text" name="setting[upload_allowsize]" value="<?php echo $setting['upload_allowsize'];?>" size="40" class="input-text">M</td>
    </tr>
	<tr> 
      <td>�Ƿ�����ϴ���ѡ��</td>
      <td><input type="radio" name="setting[isselectfile]" value="1"> �� <input type="radio" name="setting[isselectimage]" value="0" checked> ��</td>
    </tr>
	<tr> 
      <td>����ͬʱ�ϴ��ĸ���</td>
      <td><input type="text" name="setting[upload_number]" value="10" size=3></td>
    </tr>	
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function add_mirrorsite(obj)
	{
		var name = $(obj).siblings("#addname").val();
		var url = $(obj).siblings("#addurl").val();
		var servers = $("#servers").text()+name+" | "+url+"\r\n";
		$("#servers").text(servers);
	}
//-->
</SCRIPT>
