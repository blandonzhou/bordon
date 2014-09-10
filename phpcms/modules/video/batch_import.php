<?php 
defined('IN_PHPCMS') or exit('No permission resources.');

/**
 * 
 * ------------------------------------------
 * index
 * ------------------------------------------
 * @package 	PHPCMS V9.1.16
 * @author		K
 * @copyright	
 * 
 */
 
pc_base::load_app_class('admin', 'admin', 0);
pc_base::load_sys_class('form', 0, 0);
pc_base::load_app_func('global', 'video');

 
 class  batch_import extends admin{
 
	public function __construct() {
	
		parent::__construct();
	
		$this->db = pc_base::load_model('content_model');
	
		
	}
	
	public  function  init (){
	
		include $this->admin_tpl('batch_video_import');
		
	}
	

	public function batch_import() {

		$time	= date('Ymd_His');
		// 新保存文件名称
		$file_name = $_FILES['upload_file']['name'];
                
		// 日志目录，如果目录不存在，则创建
		$upload_dir = 'uploadfile/import/'.date('Ym');//按wh_id与年月分开存放 
		if (!file_exists($upload_dir)){
		    mkdir($upload_dir, 0777, true);
		}
		
		// 上传文件名
		$upload_file = $upload_dir .'/'.$file_name;
		if(!move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_file)){
			showmessage($upload_file.' is not writeable !');
		}

        $videos = $this->reader_excel($upload_file);
        $this->db->set_model(11);
        $this->db->query('START TRANSACTION');

        
            $match=array(
            '中小学教师微视频大奖赛'=>1,
            '师范生微视频大奖赛'=>2
            );
            $prize=array(
                '一等奖'=>1,
                '二等奖'=>2,
                '三等奖'=>3
            );
            $xueduan=array(
                '小学'=>1,
                '初中'=>2,
                '高中'=>3
            );
            $xueke=array(
                '地理'=>1,
                '思品'=>2,
                '化学'=>3,
                '体育'=>4,
                '科技'=>5,
                '物理'=>6,
                '科学'=>7,
                '心理与健康'=>8,
                '历史'=>9,
                '信息技术'=>10,
                '美术'=>11,
                '音乐'=>12,
                '生物'=>13,
                '英语'=>14,
                '书法'=>15,
                '语文'=>16,
                '数学'=>17,
                '政治'=>18
            );
            $nianji=array(
                '一年级'=>1,
                '二年级'=>2,
                '三年级'=>3,
                '四年级'=>4,
                '五年级'=>5,
                '六年级'=>6,
                '七年级'=>7,
                '八年级'=>8,
                '九年级'=>9,
                '高一'=>10,
                '高二'=>11,
                '高三' =>12
            );
            $flag=1;
            foreach ($videos as $video) {
                $catids=  explode(',', trim($video[13]));
                foreach($catids as $catid)
                {
                    $model['title']=str_replace('\'', '\\\'', $video[0]);
                    $model['catid']=$catid;
                    $model['tea_name']=$video[1];
                    @$model['match']=$match[$video[3]];
                    $model['year']=$video[4];
                    @$model['prize']=$prize[$video[5]];
                    @$model['xueduan']=$xueduan[$video[6]];
                    @$model['xueke']=$xueduan[$video[7]];
                    @$model['nianji']=$nianji[$video[8]];
                    $model['thumb']='uploadfile/thumb/'.$video[12];
                    $model['status']=99;
                    if(!$this->db->add_content($model))
                        $flag=0;
                }   
            }

            if(!$flag){
                $this->db->query('ROLLBACK');
                showmessage('导入失败!');
            }

            else{
                $this->db->query('COMMIT');
                showmessage(L('operation_success'));
            }
    }

    /**
     * 读取excel
     * @param unknown_type $excelPath：excel路径
     * @param unknown_type $allColumn：读取的列数
     * @param unknown_type $sheet：读取的工作表
     */
    public function reader_excel($excelPath, $allColumn = 0, $sheet = 0) {
        $excel_arr = array();
        
        //默认用excel2007读取excel,若格式 不对，则用之前的版本进行读取
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($excelPath)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($excelPath)) {
                //返回空的数组
                return $excel_arr;  
            }
        }
        
        //载入excel文件
        $PHPExcel  = new PHPExcel();
        $PHPExcel  = $PHPReader->load($excelPath);
        
        //获取工作表总数
        $sheetCount = $PHPExcel->getSheetCount();
        
        //判断是否超过工作表总数，取最小值
        $sheet = $sheet < $sheetCount ? $sheet : $sheetCount;
        
        //默认读取excel文件中的第一个工作表
        $currentSheet = $PHPExcel->getSheet($sheet);
        
        if(empty($allColumn)) {
            //取得最大列号，这里输出的是大写的英文字母，ord()函数将字符转为十进制，65代表A
            $allColumn = ord($currentSheet->getHighestColumn()) - 65 + 1;
        }
        
        //取得一共多少行
        $allRow = $currentSheet->getHighestRow();
        
        //从第二行开始输出，因为excel表中第一行为列名
        for($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
            for($currentColumn = 0; $currentColumn <= $allColumn - 1; $currentColumn++) {
                $val = $currentSheet->getCellByColumnAndRow($currentColumn, $currentRow)->getValue();
                $excel_arr[$currentRow - 2][$currentColumn] = $val;
            }
        }
        
        //返回二维数组
        return $excel_arr;
    }

 }

