<?php
header('Access-Control-Allow-Origin: *');
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);
pc_base::load_app_func('global');

class sakai  extends admin{
	private $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
                $this->checkAuth();
		$this->db = pc_base::load_model('content_model');
		$this->siteid=1;
                param::set_cookie('siteid',1);
		$this->categorys = getcache('category_content_'.$this->siteid,'commons'); 
	}
	
	public function add() {
            if(isset($_POST['code'])&&$_POST['code']=='utf-8')
                $_POST=$this->array_to_gbk($_POST);
		if(isset($_POST['video'])) {
			$catid = $_POST['video']['catid'] = intval($_POST['video']['catid']);
			if(trim($_POST['video']['title'])=='') exit('视频标题为必填信息！');
			$category = $this->categorys[$catid];
			if($category['type']==0) {
				$modelid = $this->categorys[$catid]['modelid'];
				$this->db->set_model($modelid);
				$_POST['video']['status'] = 99;
			
				//添加内容时候添加视频 start
					ini_set("max_execution_time",600000);
					//取得视频文件名字	
					$local_videos = explode(',' , $_POST['video']['local_video'] );
					$local_videos = array_filter($local_videos);
					sort($local_videos);
					$l = count($local_videos);

					for($i = 0;$i<$l;$i++){
						$local_video_path =iconv("gb2312","utf-8",$local_videos[$i]);
						//echo $local_video_path;
						$local_video = explode('.',$local_video_path);
						
						$local_video_name = $local_video[0];
						$ext = $local_video[1];
						$unq_name = uniqid();
							//载入ffmpeg
						copy($local_video_path , 'uploadfile/video/'.$unq_name.'.'.$ext);
						//copy($local_video_path , 'uploadfile/video/aaabbb.wmv.bak');
						
						  if(FFMPEG_EXT){
                                                                   
									$jpg=FFMPEG_EXT. ' -i  '.PHPCMS_PATH.'uploadfile/video/' . $unq_name . '.' . $ext.'  -f  image2  -ss 5 -vframes 1  '.PHPCMS_PATH.'uploadfile/thumb/'.$unq_name.'.jpg';
									exec($jpg);
									if($ext !== 'mp4') {
										//清晰度
										$r = intval($_POST['video']['quality']) * 15;
										$ffmpeg = 'ffmpeg.exe';//载入ffmpeg
										$cmd= FFMPEG_EXT. ' -i  '.PHPCMS_PATH.'uploadfile/video/' . $unq_name . '.' . $ext . ' -c:v libx264 -strict -2 -r ' . $r . ' '.PHPCMS_PATH.'uploadfile/video/' . $unq_name . '.mp4';
										 //die($cmd);
										 exec($cmd,$status);
										 pc_base::ftp_upload($unq_name.'.mp4');
										
										/* 销毁原视频 */
										@unlink('uploadfile/video/' . $unq_name . '.' . $ext);
									} 
								 $insert_name[$i] = $unq_name;
								 $insert[$i] = $unq_name . '.mp4';
								
						 }else{    
								showmessage("ffmpeg没有载入"); 
						 } 
								
					}
				if( !empty ($insert_name[0])){
				
					$_POST['video']['thumb'] = APP_PATH . 'uploadfile/thumb/'  . $insert_name[0]. '.jpg';
				
				}
				
				$_POST['video']['local_video'] = join(',' , $insert);
			
				$id=$this->db->add_content($_POST['video']);
//                                print_r(json_encode(urldecode(urlencode($_POST['video']))));
                                $modelname=$this->db->model[$modelid]['tablename'].'_model';
                                $return= pc_base::load_model($modelname)->get_one(array('id'=>$id));
                                $_POST['video']['id']=$return['id'];
                                $_POST['video']['url']=$return['url'];
                                $result=$_POST['video'];
                                foreach ($result as $k => $v) {
                                    $result[$k] = urlencode($v);
                                }
                                $result = urldecode(json_encode($result));
                                print_r($result);
			}
		}
	}

        
       public function checkAuth(){
            $token=$_REQUEST['token'];
            $timestamp=$_REQUEST['timestamp'];
           if(!$token==md5($timestamp.'sakai-video')){
               exit('You do not have permission to perform this operation!');
           }
       }
       
       public function array_to_gbk($arr){
           $r=array();
           foreach($arr as $k=>$v){
               if(is_array($v))
                   $r[$k]=$this->array_to_gbk($v);
               else $r[$k]=  iconv ('utf-8', 'gbk', $v);
           }
           return $r;
       }

}
?>
