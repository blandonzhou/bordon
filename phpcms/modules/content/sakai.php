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
						$local_video_path =$local_videos[$i];
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
        
        
        public function edit() {
			if(isset($_POST['video']['id'])) {
				$id  = intval($_POST['video']['id']);
				$catid = $_POST['video']['catid'] = intval($_POST['video']['catid']);
				if(trim($_POST['video']['title'])=='') exit('标题必须填写');
				$modelid = $this->categorys[$catid]['modelid'];
				$this->db->set_model($modelid);
				echo $this->db->edit_content($_POST['video'],$id);
			} 
	}
	/**
	 * 删除
	 */
	public function delete() {
		if(isset($_POST['video']['id'])) {
			$catid = intval($_POST['catid']);
			$modelid = $this->categorys[$catid]['modelid'];
			$sethtml = $this->categorys[$catid]['sethtml'];
			$siteid = $this->categorys[$catid]['siteid'];
			
			$html_root = pc_base::load_config('system','html_root');
			if($sethtml) $html_root = '';
			
			$setting = string2array($this->categorys[$catid]['setting']);
			$content_ishtml = $setting['content_ishtml']; 
			$this->db->set_model($modelid);
			$this->hits_db = pc_base::load_model('hits_model');
			$this->queue = pc_base::load_model('queue_model');
			if(empty($_POST['video']['id'])) exit('视频ID必须填写');
			//附件初始化
			$attachment = pc_base::load_model('attachment_model');
			$this->content_check_db = pc_base::load_model('content_check_model');
			$this->position_data_db = pc_base::load_model('position_data_model');
			$this->search_db = pc_base::load_model('search_model');
			//判断视频模块是否安装 
			if (module_exists('video') && file_exists(PC_PATH.'model'.DIRECTORY_SEPARATOR.'video_content_model.class.php')) {
				$video_content_db = pc_base::load_model('video_content_model');
				$video_install = 1;
			}
			$this->comment = pc_base::load_app_class('comment', 'comment');
			$search_model = getcache('search_model_'.$this->siteid,'search');
			$typeid = $search_model[$modelid]['typeid'];
			$this->url = pc_base::load_app_class('url', 'content');
                        
			$id=$_POST['video']['id'];
                        $r = $this->db->get_one(array('id'=>$id));
                        if($content_ishtml && !$r['islink']) {
                                $urls = $this->url->show($id, 0, $r['catid'], $r['inputtime']);
                                $fileurl = $urls[1];
                                if($this->siteid != 1) {
                                        $sitelist = getcache('sitelist','commons');
                                        $fileurl = $html_root.'/'.$sitelist[$this->siteid]['dirname'].$fileurl;
                                }
                                //删除静态文件，排除htm/html/shtml外的文件
                                $lasttext = strrchr($fileurl,'.');
                                $len = -strlen($lasttext);
                                $path = substr($fileurl,0,$len);
                                $path = ltrim($path,'/');
                                $filelist = glob(PHPCMS_PATH.$path.'*');
                                foreach ($filelist as $delfile) {
                                        $lasttext = strrchr($delfile,'.');
                                        if(!in_array($lasttext, array('.htm','.html','.shtml'))) continue;
                                        @unlink($delfile);
                                        //删除发布点队列数据
                                        $delfile = str_replace(PHPCMS_PATH, '/', $delfile);
                                        $this->queue->add_queue('del',$delfile,$this->siteid);
                                }
                        } else {
                                $fileurl = 0;
                        }
                        //删除内容
                        $this->db->delete_content($id,$fileurl,$catid);
                        //删除统计表数据
                        $this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
                        //删除附件
                        $attachment->api_delete('c-'.$catid.'-'.$id);
                        //删除审核表数据
                        $this->content_check_db->delete(array('checkid'=>'c-'.$id.'-'.$modelid));
                        //删除推荐位数据
                        $this->position_data_db->delete(array('id'=>$id,'catid'=>$catid,'module'=>'content'));
                        //删除全站搜索中数据
                        $this->search_db->delete_search($typeid,$id);
                        //删除视频库与内容对应关系数据
                        if ($video_install ==1) {
                                $video_content_db->delete(array('contentid'=>$id, 'modelid'=>$modelid));
                        }

                        //删除相关的评论,删除前应该判断是否还存在此模块
                        if(module_exists('comment')){
                                $commentid = id_encode('content_'.$catid, $id, $siteid);
                                $this->comment->del($commentid, $siteid, $id, $catid);
                        }
				
 	
			//更新栏目统计
			$this->db->cache_items();
			exit(1);
		} else 
                    exit('视频ID必须填写 ');
	}
        
        

        
       public function checkAuth(){
            $token=$_REQUEST['token'];
            $timestamp=$_REQUEST['timestamp'];
           if(!$token==md5($timestamp.'sakai-video')){
               exit('You do not have permission to perform this operation!');
           }
       }
}
?>

