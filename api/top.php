<?php
defined('IN_PHPCMS') or exit('No permission resources.'); 
/**
 * ��������Ƽ�λ
 */
$pos_data ='';
$pos_data = pc_base::load_model('position_data_model');
$sql = '`expiration` < \''.SYS_TIME.'\' AND `expiration` > 0';
$pos_data->delete($sql);
?>
