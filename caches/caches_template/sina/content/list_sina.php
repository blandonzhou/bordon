<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link rel="stylesheet" href="<?php echo APP_PATH;?>statics/sina/css/style_school.css" type="text/css" />
<script language="javascript" src="<?php echo APP_PATH;?>statics/sina/js/jquery-1.8.0.js" ></script>
<script language="javascript" src="<?php echo APP_PATH;?>statics/sina/js/common.js" ></script>
</head>

<?php include template("content","header_nav"); ?>

<div class="wrap"> 
  
  <!-- 收藏公开课 begin -->
  
  <div class="blk_login">
    <p class="lf fred"><a class="saveBtn" href="javascript:void(0)" onclick="addFavorite(window.location.href,document.title)">收藏新浪公开课</a></p>
    <script type="text/javascript">

function addFavorite(sURL, sTitle){

    try{

        window.external.addFavorite(sURL, sTitle);

    }

    catch (e){

        try{

            window.sidebar.addPanel(sTitle, sURL, "");

        }

        catch (e){

            //

        }

    }          

}



</script> 
  </div>
  
  <!-- 收藏公开课 end  --> 
  
  <!-- main --> 
  
  <!--part school intro start-->
  
  <div class="part_school clearfix">
    <div class="p_l">
      <div class="cont">
        <div class="tit04"><?php echo $CATEGORYS[$catid]['catname'];?></div>
        <div class="blk07">
          <div class="pic"> 
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dd1b4d7fe6b6eade8544a90715119702&action=position&posid=19&order=listorder+DESC&num=1&catid=%24catid&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'19','order'=>'listorder DESC','catid'=>$catid,'moreinfo'=>'1','limit'=>'1',));}?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	 <?php $img = explode('.',$r[local_video])?>
	 <?php $src = $img[0]?>		  
		  <a href="<?php echo $r['url'];?>" target="_blank"> 
		  <img src="<?php echo $r['thumb'];?>" width="660" height="285"/> </a> </div>
          <div class="txt_bg"></div>
          <div class="txt">
		    <h3 class="update">最新更新</h3>

          <h4>
		  <a href="<?php echo $r['url'];?>" target="_blank">
              
              <?php echo $r['title'];?></a></h4>
            <p><?php echo $r['description'];?></p>
            <p> <a href="<?php echo $r['url'];?>" target="_blank" class="vidoPlay">播放</a></p>
       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>  
          
          
          </div>
        </div>
      </div>
    </div>
    <div class="p_r">
      <div class="blk08">
        <div class="tit05">
          <h2>
            <div class="tt tIntro">简介</div>
          </h2>
        </div>
        <div class="pictxt">
          <div class="pic"> <img src="statics/sina/images/d.gif" data-src="<?php echo thumb($CATEGORYS[$catid][image]);?>" width="72" height="72" alt="<?php echo $CATEGORYS[$catid]['catname'];?>" title="<?php echo $CATEGORYS[$catid]['catname'];?>"/> </div>
          <div class="bire"></div>
          <div class="txt">
            <p style="padding:5px 0px 5px 100px;"><?php echo $CATEGORYS[$catid]['catname'];?></p>
            <p style="padding:0px 0px 10px 100px;">NTU</p>
            <p title="">
				<?php echo $CATEGORYS[$catid]['description'];?>
			</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!--part school intro end--> 
  
  <!--part01 start-->
  
  <div class="part01 clearfix">
    <div class="p_l">
      <div class="cont_bg">
        <div class="cont">
          <div class="tit03  clearfix">
            <h2><span class="tt zxkc">最新课程</span></h2>
          <!--   <p class="rt"><span>显示方式：</span> <em class="show show1_cur">行列</em> <a href="http://open.sina.com.cn/school/id_106/page_1/mn_0/" class="show show2">行排</a> 
              
        四种状态：show1,show1_cur,show2,show2_cur
              
            </p> -->
          </div>
          <div class="blk01">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9121a79f123d145c0d7c750f39792116&action=lists&catid=%24catid&order=updatetime+DESC&return=info&moreinfo=1&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 20;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'updatetime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$info = $content_tag->lists(array('catid'=>$catid,'order'=>'updatetime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>   
<?php $l = count($info)?>

 <?php $n=1;if(is_array($info)) foreach($info AS $v) { ?> 
 <?php $img = explode('.',$v[local_video])?>
 <?php $src = $img[0]?>
 
 
            <div class="vido">
              <div class="pic">
			  <a href="<?php echo $v['url'];?>" target="_blank">
			  <img height="90" width="120" src="statics/sina/images/d.gif" data-src="<?php echo $v['thumb'];?>" ></a></div>
              <p class="tit fbluel"><a target="_blank" href="<?php echo $v['url'];?>">
			  
				<?php echo $v['title'];?>
			</a></p>
              <p class="intro">人气：<i>
			  
<?php
$hitsid = 'c-11-'.intval($v['id']);
$hit_model = pc_base::load_model('hits_model');
$hit = $hit_model->get_one(array('hitsid'=>$hitsid),'views');
echo $hit['views'];
?> 
			  
			  </i></p>
            </div>
	

		
 <?php $n++;}unset($n); ?>
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            
          </div>
          <div class="blk02">
            <p class="page" >
				<?php echo $sina_pages;?>
			</p>
          </div>
        </div>
      </div>
    </div>
    <div class="p_r">
      <div class="sub02" id="sub02">
        <div class="sub02_t">
          <h2><a class="best">最受欢迎的公开课</a></h2>
          <span id="sub02_t1">总</span> <span id="sub02_t2">周</span> <span id="sub02_t3">月</span> </div>
          <div id="sub02_c1" class="sub02_c">
  <ul class="list02">

<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6a308918e8258911a6c454bfc7c5e50b&action=hits&num=9&catid=%24catid&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'views DESC','limit'=>'9',));}?>
<?php $i =1?>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	
		 <li> <em><?php echo $i;?></em>
			 <a target="_blank" href="<?php echo $r['url'];?>">
			 <?php echo $CATEGORYS[$r['catid']]['catname'];?>:<?php echo $r['title'];?>
			 </a>
		 <span class="data"><?php echo $r['views'];?></span> </li>
<?php $i++?>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

            </ul>
          </div>
		  
                 <div style="display:none" id="sub02_c2" class="sub02_c">
            <ul class="list02">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0c1f918eb5143a708d01a93a134d54e4&action=hits&catid=%24catid&num=9&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'weekviews DESC','limit'=>'9',));}?>
<?php $i =1?>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	
		 <li> <em><?php echo $i;?></em>
			 <a target="_blank" href="<?php echo $r['url'];?>">
			 <?php echo $CATEGORYS[$r['catid']]['catname'];?>:<?php echo $r['title'];?>
			 </a>
		 <span class="data"><?php echo $r['views'];?></span> </li>
<?php $i++?>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
          </div>
		  
		  <div style="display:none" id="sub02_c3" class="sub02_c">
            <ul class="list02">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=bdbebba56c2427d23ca42964b08d68d5&action=hits&catid=%24catid&num=9&order=monthviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'monthviews DESC','limit'=>'9',));}?>
<?php $i =1?>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	
		 <li> <em><?php echo $i;?></em>
			 <a target="_blank" href="<?php echo $r['url'];?>">
			 <?php echo $CATEGORYS[$r['catid']]['catname'];?>:<?php echo $r['title'];?>
			 </a>
		 <span class="data"><?php echo $r['views'];?></span> </li>
<?php $i++?>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></li>
            </ul>
          </div>
      </div>
      <script type="text/javascript" language="javascript">

                <!--//--><![CDATA[//><!--

                var SubShow_02 = new SubShowClass("sub02","onmouseover");

                SubShow_02.addLabel("sub02_t1","sub02_c1");

                SubShow_02.addLabel("sub02_t2","sub02_c2");

                SubShow_02.addLabel("sub02_t3","sub02_c3");

                //--><!]]>

        </script>
      <div class="blk03">
        <div class="tit01">
          <h2>推荐课程</h2>
        </div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8431892dd58588cddc57c2c924d9e866&action=position&posid=1&order=listorder+DESC&num=9&catid=%24catid&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','catid'=>$catid,'moreinfo'=>'1','limit'=>'9',));}?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	  <?php $img = explode('.',$v[local_video])?>
		<?php $src = $img[0]?>
 
	  <div class="pictxt addAtt">
          <div  class="pic"> <img src="<?php echo $r['thumb'];?>" width="50" height="50" />  </div>
          <div class="txt">
            <h2 class="fblue"> <a href="<?php echo $r['url'];?>" target="_blank"><?php echo $CATEGORYS[$r['catid']]['catname'];?>: <?php echo $r['title'];?></a> </h2>
         
          </div>
        </div>

       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>			
        
      
       
      </div>
    
    </div>
  </div>
  
  <!--part01 end--> 
  

</div>
<div class="wrap"> 
  
  <!--part02 start-->
  
  <div class="part02">
    <div class="tit02">
      <h2 class="fbluel"><a target="_blank" href="url" onclick="javascript:void(0); return false;">讲师</a></h2>
    </div>
    <div class="blk05 clearfix" id="scr_cont1">
      <div class="pics fblue clearfix">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e782467d00c9f6b941ec95115f903619&action=lists&catid=%24catid&order=updatetime+DESC&return=info&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$info = $content_tag->lists(array('catid'=>$catid,'order'=>'updatetime DESC','limit'=>'12',));}?>   


 <?php $n=1;if(is_array($info)) foreach($info AS $v) { ?> 

  <div class="pic"> 
 
  <img width="72" height="72"  src="<?php echo $v['tea'];?>"> <span>
  <i class=""><?php echo $v['tea_name'];?></i></span> 
  </div>
 <?php $n++;}unset($n); ?>
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>  
	  
       
       
      </div>
    </div>
  </div>
  
  <!--part02 end-->
  
  <div class="part_b2t" ><a href="#" target="_self" class="b2t" hidefocus>back2Top</a></div>
  
  <!-- end main --> 
  
</div>
<script src="<?php echo APP_PATH;?>statics/sina/js/move.js"></script>
<!-- footer -->

<div style="padding: 15px; font-size: 12px; line-height: 20px; text-align: center;" class="footer">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=f8b50e6ae627a6d2d43e41af04c5d39f&sql=SELECT+%2A+FROM+v9_page+where+catid%3D%2753%27&return=page_data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid='53' LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$page_data = $a;unset($a);?>

  <?php $n=1;if(is_array($page_data)) foreach($page_data AS $v) { ?>
  
											
										
		<?php echo $v['content'];?>
										
  
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

</div>
</body>
</html>
