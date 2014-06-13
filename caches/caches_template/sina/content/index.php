<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<?php include template("content","header_nav"); ?>


<!-- 收藏公开课 begin -->

<div class="wrap">
  <div class="blk_login">
    <p class="lf fred"><a class="saveBtn" href="javascript:void(0)" onclick="addFavorite(window.location.href,document.title)">收藏本网站</a></p>
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
</div>
<!-- 手动焦点图 begin -->

<div class="focus">
  <div class="focus_body">
    <div class="scroll"> <a href="javascript:void(0);" class="arr_left" id="FS_arr_left_01">左移动</a> <a href="javascript:void(0);" class="arr_right" id="FS_arr_right_01">右移动</a>
      <div class="scroll_cont" id="FS_Cont_01">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fb4a752566746a7c3ad1a560488f6198&action=position&posid=2&order=listorder+DESC&num=5&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'2','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'5',));}?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	 <?php $img = explode('.',$r[local_video])?>
	 <?php $src = $img[0]?>
           <div class="box"> 
				<a href="<?php echo $r['url'];?>" target="_blank">
					<img alt="<?php echo $r['title'];?>" src="<?php echo APP_PATH;?>uploadfile/thumb/<?php echo $src;?>.jpg" width="945" height="342"/>
				</a> 
			</div>
       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   	  
        
		
      </div>
      <div id="FS_numList_01" class="numList"></div>
      <div class="scroll_txt">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d7c705469bc0f9c319026188694c33cc&action=position&posid=2&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'2','order'=>'listorder DESC','limit'=>'5',));}?>
<?php $i = 1?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	 <?php $img = explode('.',$r[local_video])?>
	 <?php $src = $img[0]?>
          <div id="txt0<?php echo $i;?>" class="scroll_info" style="display:<?php if($i ==1) { ?>block<?php } else { ?>none<?php } ?>">
          <div class="txtbg"></div>
          <div class="txtcontent">
            <h2>
			<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $CATEGORYS[$r['catid']]['catname'];?>：<?php echo $r['title'];?></a></h2>
            <p class="des"><?php echo $r['description'];?> <a href="<?php echo $r['url'];?>" target="_blank">[详细]</a></p>
            <div class="btn"><a href="<?php echo $r['url'];?>" target="_blank">播放</a></div>
          </div>
        </div>
<?php $i++; ?>
       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   	  
       
       
      </div>
    </div>
    <script language="javascript" type="text/javascript">

			  <!--//--><![CDATA[//><!--

			  var focusScroll = new ScrollPic();

			  focusScroll.scrollContId   = "FS_Cont_01"; //内容容器ID

			  focusScroll.arrLeftId      = "FS_arr_left_01";//左箭头ID

			  focusScroll.arrRightId     = "FS_arr_right_01"; //右箭头ID

			  focusScroll.dotListId      = "FS_numList_01";//点列表ID

			  focusScroll.dotClassName   = "";//点className

			  focusScroll.dotOnClassName	= "selected";//当前点className

			  focusScroll.listType		= "number";//列表类型(number:数字，其它为空)

			  focusScroll.listEvent      = "onmouseover"; //切换事件

			  focusScroll.frameWidth     = 944;//显示框宽度

			  focusScroll.pageWidth      = 944; //翻页宽度

			  focusScroll.upright        = false; //垂直滚动

			  focusScroll.speed          = 10; //移动速度(单位毫秒，越小越快)

			  focusScroll.space          = 50; //每次移动像素(单位px，越大越快)

			  focusScroll.autoPlay       = true; //自动播放

			  focusScroll.autoPlayTime   = 5; //自动播放间隔时间(秒)

			  focusScroll.circularly     = true;

			  focusScroll.initialize(); //初始化

			  focusScroll.onpagechange = function(){

			   $(".scroll_info").hide();

			   $("#txt0"+(focusScroll.pageIndex+1)).show();

			  };

			  //--><!]]>

       </script> 
  </div>
</div>

<!-- 手动焦点图 end  -->

<div class="wrap">
  <div class="part02">
    <div class="cont clearfix">
      <div class="p_l"><div id="sub01" class="sub01">
          <div class="sub01_t"> <a href="http://open.sina.com.cn/courses/" target="_blank"><span class="selected" id="sub01_t1">最新课程推荐</span></a></div>
          <div id="sub01_c1" class="sub01_c">
            <ul class="list01">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cca864a42cebb8005bc8857eb66fd0b0&action=position&posid=1&order=listorder+DESC&num=9&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'9',));}?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<li><span style="float:right;"><?php echo date('m-d',$r[inputtime]);?></span><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $CATEGORYS[$r['catid']]['catname'];?>: <?php echo $r['title'];?></a></li>
       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>			
             
            
            </ul>
          </div>
        </div></div>
      <div class="p_m">
        <div id="sub01" class="sub01">
          <div class="sub01_t"> <a href="http://open.sina.com.cn/courses/" target="_blank"><span class="   selected" id="sub01_t1">最热课程推荐</span></a></div>
          <div id="sub01_c1" class="sub01_c">
            <ul class="list01">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=235a63e4d84de8569777b2f8fa49ed65&action=position&posid=18&order=listorder+DESC&num=9&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'18','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'9',));}?>
     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<li><span style="float:right;"><?php echo date('m-d',$r[inputtime]);?></span><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $CATEGORYS[$r['catid']]['catname'];?>: <?php echo $r['title'];?></a></li>
       <?php $n++;}unset($n); ?>  
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
            </ul>
          </div>
        </div>
      </div>
      <div class="p_r">
        <div id="sub02" class="sub02">
          <div class="sub02_t">
            <h2><a class="best" onclick="javascript:void(0)">最受欢迎的节目</a></h2>
            <span id="sub02_t1" class="selected">总</span> <span id="sub02_t2" class="">周</span> <span id="sub02_t3" class="">月</span> </div>
          <div id="sub02_c1" class="sub02_c">
  <ul class="list02">

<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e562d6169d16becdd6312e8e2f1a5458&action=hits&catid=51&num=9&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'51','order'=>'views DESC','limit'=>'9',));}?>
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
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c663bd5b9fdcb7cc995ef61fe1b4a611&action=hits&catid=51&num=9&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'51','order'=>'weekviews DESC','limit'=>'9',));}?>
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
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=917b5b124e1942991341d1b937a2dcdd&action=hits&catid=51&num=9&order=monthviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'51','order'=>'monthviews DESC','limit'=>'9',));}?>
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
          <script type="text/javascript" language="javascript">

<!--//--><![CDATA[//><!--

var SubShow_02 = new SubShowClass("sub02","onmouseover");

SubShow_02.addLabel("sub02_t1","sub02_c1");

SubShow_02.addLabel("sub02_t2","sub02_c2");

SubShow_02.addLabel("sub02_t3","sub02_c3");

//--><!]]> 

</script> 
        </div>
      </div>
    </div>
  </div>
  
  <!-- 一键分享 begin -->
  
  <div class="part03 clearfix"> 
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> <span class="bds_more">分享到：</span> <a class="bds_tsina"></a> <a class="bds_qzone"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <a class="bds_t163"></a> <a class="bds_kaixin001"></a> <a class="bds_bdhome"></a> <a class="bds_hi"></a> <a class="shareCount"></a> </div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END --> 
  </div>
  
  <!-- 一键分享 end -->
  

 
  </div>
  <div class="part07">
    <div class="part07 part08">
      <div class="tit04">
        <h2 class=""><span class="tt hzjg">合作机构</span></h2>
      </div>
      <div class="cont">
        <div class="blk06 clearfix">
          <div class="pics">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=80574ec69aa2a6c10ed30f7c49e0eda7&action=type_list&siteid=%24siteid&linktype=1&order=listorder+DESC&num=8&return=pic_link\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$pic_link = $link_tag->type_list(array('siteid'=>$siteid,'linktype'=>'1','order'=>'listorder DESC','limit'=>'8',));}?>
        <?php $n=1;if(is_array($pic_link)) foreach($pic_link AS $v) { ?>
		  <div class="pic"> 
		  <a target="_blank" href="<?php echo $v['url'];?>"> 
		  <img width="95" height="50" title="<?php echo $v['name'];?>" alt="<?php echo $v['name'];?>" src="<?php echo $v['logo'];?>"> 
		  <span><?php echo $v['name'];?></span> </a> </div>
		  
       
        <?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
           
          </div>
        </div>
      </div>
    </div>
    <div class="part_b2t"> <a href="#" target="_self" class="b2t" hidefocus="">back2Top</a> </div>
  </div>
<?php include template("content","footer"); ?>  
