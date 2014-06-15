<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link rel="stylesheet" href="<?php echo APP_PATH;?>statics/sina/css/style_course.css" type="text/css" />
<script language="javascript" src="<?php echo APP_PATH;?>statics/sina/js/jquery-1.8.0.js" ></script>
<script language="javascript" src="<?php echo APP_PATH;?>statics/sina/js/common.js" ></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/sina/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/sina/js/hScrollPane.js"></script>
<script src="<?php echo APP_PATH;?>statics/sina/js/sinalib.min.js"></script>
<script src="<?php echo APP_PATH;?>statics/sina/js/weiboapp.min.js"></script>
<script language="JavaScript" src="<?php echo APP_PATH;?>api.php?op=count&id=<?php echo $id;?>&modelid=<?php echo $modelid;?>"></script>
<!--slide-->
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/sina/js/gallary/jquery.easing.js"></script> 
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/sina/js/gallary/lof-slider.js"></script> 
<link rel="stylesheet" href="<?php echo APP_PATH;?>statics/sina/js/gallary/lof-slider.css" media="all">
<link type="text/css" rel="stylesheet" href="<?php echo APP_PATH;?>statics/sina/js/gallary/capture.css">
<script type="text/javascript">
$(document).ready(function($){

	var buttons = {
		previous:$('#home-slider .button-previous'),
		next:$('#home-slider .button-next')
	};	

	$('#home-slider').lofJSidernews( {
		interval 		: 4000,
		direction		: 'opacitys',	
		easing			: 'easeInOutExpo',
		duration		: 1200,
		auto		 	: false,
		maxItemDisplay  : 5,
		navPosition     : 'horizontal', // horizontal
		navigatorHeight : 73,
		navigatorWidth  : 188,
		mainWidth		: 940,
		buttons: buttons
	});
	
	$(".sliders-wrapper li,.navigator-content").hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});

});
</script>

<!-- �°沥����js -->

<script src="<?php echo APP_PATH;?>statics/sina/js/sinaFlashLoad.js"></script>
<script type="text/javascript">

/*

ʵ��������������Ⱦ��div��������״Ԫ�ص�id; uid����,Ĭ�϶�ȡ���һ���û������һ��΢������Ⱦ��ʾ

*/

var UsersRender = function(){

  var init = function(dom,cfg){

    this.dom = this.getById(dom);

    this.xhrSender(cfg)

  };

  init.prototype = {

    getById : function(id){

      return document.getElementById(id);

    },

    clipString : function(str, a, b){

      var s = str.replace(/([^\x00-\xff])/g, "\x00$1");

      return (s.length < b) ? str: (s.substring(a, b-3).replace(/\x00/g, '') + '...');

    },



    xhrSender : function(c){

      var that = this;

      var uids = c.join(',');

      var userUrl = 'http://api.sina.com.cn/weibo/wb/user_timeline.json'

      var userData = 'feature=1&count=1&uid=' + uids;

      var onUserSuccess = function(data) {

        var data = data.result.data;

        var valuedDatas = [];

        var cl = c.length;

        for(var i=0;i<cl;i++){

          var s = c[i].toString();

          if(data[s]){

          valuedDatas.push({

            id : data[s][0].user.id,

            cmid : data[s][0].id,

            domain : data[s][0].user.domain,

            nickName : data[s][0].user.name,

            image : data[s][0].user.profile_image_url,

            verified : data[s][0].user.verified,

            latestWeibo : data[s][0].text,

            comment_count : data[s][0].comment_count,

            repost_count : data[s][0].repost_count,

            latestDate : data[s][0].created_at,

            mid : data[s][0].mid_base62

          });

          }

        }

        that.render(valuedDatas);

      };

      SINA.IO.getJSONP(userUrl, userData, onUserSuccess);

    },

    render : function(vd){

      var dom = this.dom;

      var nickName, uid, image, verified, latestWeibo, mid, cmid, domain, base_mid, comment_count, repost_count;

        var div, a0, a1, a2, p, img, n_name, v, text, c9;

        for(var i=0,vL=vd.length;i<vL;i++){

          uid = vd[i].id; //1011062684

          cmid = vd[i].cmid; // 3454067965509678

          base_mid = vd[i].mid; //ymGyon7jM

          domain = vd[i].domain == "" ? "u/" + uid : vd[i].domain;

          nickName = vd[i].nickName;

          image = vd[i].image;

          verified = vd[i].verified; // �Ƿ�ΪVIP�û�

          latestWeibo = vd[i].latestWeibo; //���һ��΢��

          repost_count = vd[i].repost_count; //ת����

          comment_count = vd[i].comment_count; //������

          div = dom.appendChild(document.createElement('DIV'));

          div.className = "blk_tw tw03";

          div.innerHTML = "<a href='http://weibo.com/"+domain+"' target='_blank' class='twpic'><img src='"+image+"' width='50' height='50' alt='"+nickName+"������΢��' /></a><div class='b_txt'><p><a href='http://weibo.com/"+domain+"' target='_blank' class='fblue'>"+nickName+":</a>"+this.clipString(latestWeibo, 0, 65)+"</p><p class='b_more'><a href='http://weibo.com/"+uid+"/"+base_mid+"' target='_blank'>ת��("+repost_count+")</a> <a href='http://weibo.com/"+uid+"/"+base_mid+"' target='_blank'>����("+comment_count+")</a></p></div>";

  }

      if(typeof(this.oncomplete) === 'function'){



      this.oncomplete();



    };



    }



  };



  return init;



}();

</script>
</head>
<?php if($bgsound!=''){?>

<audio id="bgsound" src="<?php echo $bgsound['0']['fileurl'];?>" >
<embed src="<?php echo $bgsound['0']['fileurl'];?>" autostart="true" loop="-1" controls="ControlPanel"
width="0" height="0" >
</audio>
<script>
function playmsc(){
document.getElementById('bgsound').play();
} 
playmsc();
</script>


<?php }?>


<?php include template("content","header_nav"); ?>
<div class="wrap">

<!-- �ղع����� begin -->

<div class="blk_login">
  <p class="lf fred"><a class="saveBtn" href="javascript:void(0)" onclick="addFavorite(window.location.href,document.title)">�ղ����˹�����</a></p>
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

<!-- �ղع����� end  --> 

<!-- main --> 
<?php if($video_url!=''){?>
<!--part01 start-->

<div class="part01 clearfix">
  <div class="p_l">
    <div class="blk01">
      <h2 class="fblue"> <?php echo $title;?> </h2>
      
      <!--<p>--> 
      
      <!--��Ƶ������-->
      
      <div class="vd_playBox vd_fullPlayBox" style="position:static;"> 
        
        <!--������vd_fullPlayBox-->
        
        <div class="playBox" style="z-index:1400;position:relative;">
          
		  	<div id="video" style="width:640;height:515px;"><div id="a1"></div></div>
						
<!--
����һ���ǲ��������ڵ��������ƣ����ֻ����flash������������ֻ��<div id="a1"></div>
-->
<script type="text/javascript" src="<?php echo JS_PATH;?>ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
	//����㲻��Ҫĳ�����ã�����ֱ��ɾ����ע��var flashvars�����һ��ֵ���治���ж���
	var flashvars={
		p:'1',//��ƵĬ��0����ͣ��1�ǲ���
		
		f:'<?php  echo 'redirec.php?v='.base64_encode($video_url);?>',//��Ƶ��ַ
		a:'',//����ʱ�Ĳ�����ֻ�е�s>0��ʱ����Ч
		s:'0',//���÷�ʽ��0=��ͨ������f=��Ƶ��ַ����1=��ַ��ʽ,2=xml��ʽ��3=swf��ʽ(s>0ʱf=��ַ�����a����ɶԵ�ַ����װ)
		c:'0',//�Ƿ��ȡ�ı�����,0���ǣ�1��
		x:'',//����xml���·����Ϊ�յĻ���ʹ��ckplayer.js������
		r:'',//ǰ�ù������ӵ�ַ����������߸�����û�е�����
		t:'0|1',//��Ƶ��ʼǰ����swf/ͼƬʱ��ʱ�䣬��������߸���
		y:'',//������ʹ����ַ��ʽ���ù���ַʱʹ�ã�ǰ����Ҫ����l��ֵΪ��
		z:'http://www.ckplayer.com/down/buffer.swf',//�����棬ֻ�ܷ�һ����swf��ʽ
		e:'5',//��Ƶ������Ķ�����0�ǵ���js������1��ѭ�����ţ�2����ͣ���Ų��Ҳ����ù�棬3�ǵ�����Ƶ�Ƽ��б�Ĳ����4�������Ƶ��������js���ܺ�1��࣬5����ͣ���Ų��ҵ�����ͣ���
		v:'80',//Ĭ��������0-100֮��
		
		h:'3',//����http��Ƶ��ʱ���ú����϶�������=0��ʹ�������϶���=1��ʹ�ð��ؼ�֡��=2�ǰ�ʱ��㣬=3���Զ��жϰ�ʲô(�����Ƶ��ʽ��.mp4�Ͱ��ؼ�֡��.flv�Ͱ��ؼ�ʱ��)��=4Ҳ���Զ��ж�(ֻҪ�����ַ�mp4�Ͱ�mp4����ֻҪ�����ַ�flv�Ͱ�flv��)
		q:'',//��Ƶ���϶�ʱ�ο�������Ĭ����start
		m:'0',//Ĭ���Ƿ���õ�����Ű�ť���ټ�����Ƶ��0���ǣ�1��,���ó�1ʱ��Ҫ��ǰ�ù��
		o:'',//��m=1ʱ������������Ƶ��ʱ�䣬��λ����
		w:'',//��m=1ʱ������������Ƶ�����ֽ���
		g:'',//��Ƶֱ��g�뿪ʼ����
		j:'',//��Ƶ��ǰj�����
		k:'',//��ʾ��ʱ�䣬�� 30|60��꾭��������30�룬60�����ʾnָ������Ӧ������
		n:'',//��ʾ�����֣���k���ʹ�ã��� ��ʾ��1|��ʾ��2
		wh:'4:3',//����6.2�����ӵĿ�߱ȣ������Լ�������Ƶ�Ŀ�߻��߱��磺wh:'4:3',��wh:'1080:720'
		ct:'2',//6.2�����ӵĲ�������Ҫ�����Щ��Ƶ�϶�ʱʱ����������������Ĭ����2���Զ�������1��ǿ��������0��ǿ�Ʋ�����
		//���ò����������в����б����
		//����Ϊ�Զ���Ĳ��������������ڲ�������õ�
		my_url:encodeURIComponent(window.location.href)//��ҳ���ַ
		//�����Զ��岥������������
		};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};//���ﶨ�岥���������������米��ɫ����flashvars�е�b��ͬ�����Ƿ�֧��ȫ�����Ƿ�֧�ֽ���
	var attributes={id:'ckplayer_a1',name:'ckplayer_a1',menu:'false'};
	//����һ���ǵ��ò������ˣ�������Ĳ������壺���������ļ���Ҫ��ʾ�ڵ�div���������ߣ���Ҫflash�İ汾�����û�û�иð汾����ʾ�����س�ʼ���������������ò����米��������attributes��������Ҫ�������ò�������id��
	CKobject.embedSWF('<?php echo JS_PATH;?>ckplayer/ckplayer.swf','a1','ckplayer_a1','640','515',flashvars,params);
	  /*CKobject.embedSWF(������·��,����id,������id/name,��������,��������,flashvars��ֵ,��������Ҳ��ʡ��);
	  ��ʱ����ɾ��ckplayer.js�е����һ�У������Ĳ���ҲҪ�ĳ�CKobject.getObjectById('ckplayer_a1')
	*/
	//����ckplayer��flash����������
	
	var video=['<?php  echo VIDEO_SERVER.$video_url;?>->video/mp4',
				'http://www.ckplayer.com/webm/0.webm->video/webm',
				
				'http://www.ckplayer.com/webm/0.ogv->video/ogg'];
	var support=['iPad','iPhone','ios','android+false','msie10+false'];
	CKobject.embedHTML5('video','ckplayer_a1',640,515,video,flashvars,support);


  </script>
		  
		  
		  
        </div>
      </div>
    
      <!--/��Ƶ������--> 
      
      <!-- </p> --> 
      
    </div>
  </div>
  <div class="p_r"> 
    
    <!--��ʦ����-->
    
    <h2 class="tit01"><span class="tit jsjs">��ʦ����</span></h2>
    <div class="" id="scrl03">
      <div class="arr_l" id="arr3_l" style="display:none;"></div>
      <div id="scr_cont3">
        <div class="blk02">
          <div class="pictxt clearfix">
            <div class="pic">
			<img src="<?php echo $tea;?>" width="72" height="72" alt="" /></div>
            <div class="txt fblue"> ��ʦ��<?php echo $tea_name;?><br/>
              ѧУ��<a href="<?php echo $CATEGORYS[$catid]['url'];?>" target="_blank"><?php echo $CATEGORYS[$catid]['catname'];?></a> </div>
          </div>
          <p class="intro" title=""><?php echo $tea_des;?>
		  </p>
        </div>
      </div>
      <div style="margin:10px"></div>
    </div>

    
    <!--�γ̽���-->
    
    <div class="line01"></div>
    <div class="blk03">
      <h2 class="tit01"><span class="tit kcjs">�γ̽���</span></h2>
      <p class="txt"><?php echo $description;?></p>
     <!--  <p class="option"><a onclick="countObj.action('gkk_kc885');return false;" href="http://open.sina.com.cn/?p=opencourse&s=course&a=recommend&id=885" target="_blank" class="up">��һ��</a> <span class="noteBg">���� <span id="num_1">0</span> <!-- 307803�����Ƽ�</span></p> -->
   
   </div>
  </div>
</div>

<!--part01 end-->

<div class="part02">
<?php if($count) { ?>
  <h2 class="tit01"><span class="noteBg">����<span class="fred"><?php echo $count;?></span>�� </span></h2>
  
    <div class="container2">
    <ul>
<?php $num=1?>			  
	<?php $n=1;if(is_array($video_url_arr)) foreach($video_url_arr AS $r) { ?>
	<?php $img = explode('.',$r)?>
	<?php $src = $img[0]?>
        <li> 
			<a href="javascript:;"  _id="<?php echo $r;?>" class="myvideo">
				 <img width="132" height="100" title="<?php echo $r['title'];?>" alt="<?php echo $r['title'];?>" src="<?php echo APP_PATH;?>uploadfile/thumb/<?php echo $src;?>.jpg" title="<?php echo $r['title'];?>">
				 <span>��<?php echo $num;?>��</span>
			</a> 
		</li>
<?php $num++?>
     <?php $n++;}unset($n); ?>
                 
	
   
     
    </ul>
  </div>
  
  
<?php } else { ?>
 <h2 class="tit01"><span class="noteBg">��ؿγ� </span></h2>

   <div class="container2">
    <ul>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b45c9ac7de2a65faec3adf1f7d8f3303&action=relation&relation=%24relation&id=%24id&catid=%24catid&keywords=%24rs%5Bkeywords%5D\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'relation')) {$data = $content_tag->relation(array('relation'=>$relation,'id'=>$id,'catid'=>$catid,'keywords'=>$rs[keywords],'limit'=>'20',));}?> 			  
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	 <?php $img = explode('.',$r[local_video])?>
	<?php $src = $img[0]?>
        <li> 
			<a href="<?php echo $r['url'];?>">
				 <img width="132" height="100" title="<?php echo $r['title'];?>" alt="<?php echo $r['title'];?>" src="<?php echo APP_PATH;?>uploadfile/thumb/<?php echo $src;?>.jpg" title="<?php echo $r['title'];?>">
				 <span title="<?php echo $r['title'];?>"><?php echo $r['title'];?></span>
			</a> 
		</li>
     <?php $n++;}unset($n); ?>
                 
 
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
   
     
    </ul>
  </div>
 
 
 <?php } ?>

  <script type="text/javascript">

            $(".container2").hScrollPane({

                mover:"ul",

                moverW:function(){return $(".container2 li").length*142;}(),

                showArrow:true,

                handleCssAlter:"draghandlealter",

               mousewheel:{moveLength:50}

            });

    </script> 
</div>
<?php }?>
<?php if($gallary!=null){?>
<!--slide-->
<div id="home-slider" class="lof-slidecontent">
  <div class="sliders-wrapper" style="width: 950px;">
    <ul class="sliders-wrap-inner" style="left: 0px; width: 6580px;">
	  <?php $n=1;if(is_array($gallary)) foreach($gallary AS $val) { ?>
	    <li class="" style="width: 950px;"> <a href="<?php echo $val['url'];?>" target="_blank"><img src="<?php echo $val['url'];?>" title="" alt="alt" data-pinit="registered"></a>
			<div class="slider-description">
			  <p><?php echo $val['alt'];?></p>
			</div>
        </li>	
	  <?php $n++;}unset($n); ?>
    </ul>
  </div>
  <div class="navigator-content">
    <div class="navigator-wrapper" style="width: 950px; height: 73px;">
      <ul class="navigator-wrap-inner" style="width: 1316px; left: 0px;">
	  <?php $n=1;if(is_array($gallary)) foreach($gallary AS $val) { ?>
        <li class="active" style="height: 73px; width: 188px;"><img src="<?php echo $val['url'];?>" alt="<?php echo $val['alt'];?>"></li>
	  <?php $n++;}unset($n); ?>	
      </ul>
    </div>
    <div class="button-next" onclick="playmsc();">></div>
    <div class="button-previous" onclick="playmsc();"><</div>
  </div>
</div>
<?php }?>

<!--part03 start-->

<div class="part03 clearfix"> 
  <!-- Baidu Button BEGIN -->
  <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> <span class="bds_more">������</span> <a class="bds_tsina"></a> <a class="bds_qzone"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <a class="bds_t163"></a> <a class="bds_kaixin001"></a> <a class="bds_bdhome"></a> <a class="bds_hi"></a> <a class="shareCount"></a> </div>
  <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script> 
  <script type="text/javascript" id="bdshell_js"></script> 
  <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
  <!-- Baidu Button END --> 
</div>

<!--part04 start-->

<div class="part04 clearfix" id="WBCommentFrame">
  <div class="tit06  clearfix">
    <h2><!--<a class="fchg2" target="_blank" href="url">1234</a>--></h2>
    
    <!-- �������ʾ����,��ôҳ�潫��λ 2012.06.05 -->
    
    <div class="rt fchg2"><a href="http://weibo.com" target="_blank" class="sinaWb">���˹ٷ�΢��</a><a onclick="plgz.guanzhu('1886003195','http://weibo.com');return false;" href="javascript:void(0);" class="payAtt">�ӹ�ע</a></div>
  </div>
 
 <div class="clearfix" style="width:900px;height:640px"> 
    
    <!-- ΢��ֱ����� http://open.weibo.com/livestreamset.php -->
    
<!--   <iframe width="950" height="650"  frameborder="0" scrolling="no" src="http://widget.weibo.com/livestream/listlive.php?language=zh_cn&width=950&height=675&uid=1837240617&skin=1&refer=1&appkey=&pic=0&titlebar=0&border=0&publish=1&atalk=1&recomm=0&at=0&atopic=<?php echo $title;?>&ptopic=<?php echo $title;?>&dpc=1"></iframe>
-->       <iframe src="<?php echo APP_PATH;?>index.php?m=comment&c=index&a=init&commentid=<?php echo id_encode("content_$catid",$id,$siteid);?>&iframe=1" width="950" height="650" id="comment_iframe" frameborder="0" scrolling="no"></iframe>  </div>
</div>

<!--part04 end-->

<div class="part_b2t clearfix" ><a href="#" target="_self" class="b2t" hidefocus>back2Top</a></div>

<!-- end main --> 

<!-- footer -->

<div style="padding: 15px; font-size: 12px; line-height: 20px; text-align: center;" class="footer"> 
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=f8b50e6ae627a6d2d43e41af04c5d39f&sql=SELECT+%2A+FROM+v9_page+where+catid%3D%2753%27&return=page_data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid='53' LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$page_data = $a;unset($a);?>

  <?php $n=1;if(is_array($page_data)) foreach($page_data AS $v) { ?>
  
											
										
		<?php echo $v['content'];?>
										
  
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
</body>
		<script type="text/javascript">
			$(function() {

				$('.myvideo').each(function() {

					$(this).bind('click', function() {
					
						$('#a1').html(' ');
							
						var x = $(this).attr('_id');
						x = x.trim();
						var url = "<?php  echo VIDEO_SERVER.$video_url;?>" + x;
							var flashvars={
								p:'1',//��ƵĬ��0����ͣ��1�ǲ���
								f:url,//��Ƶ��ַ
								c:0,
								b:1
							};
							
					
						var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};
						CKobject.embedSWF('<?php echo JS_PATH;?>ckplayer/ckplayer.swf','a1','ckplayer_a1','640','515',flashvars,params);
						/*
						CKobject.embedSWF(������·��,����id,������id/name,��������,��������,flashvars��ֵ,��������Ҳ��ʡ��);
						���������ǵ���html5�������õ���
						*/
						var video=[url+'->video/mp4','http://www.ckplayer.com/webm/0.webm->video/webm','http://www.ckplayer.com/webm/0.ogv->video/ogg'];
						var support=['iPad','iPhone','ios','android+false','msie10+false'];
						CKobject.embedHTML5('video','ckplayer_a1',640,515,video,flashvars,support);

					});
				})
			})
		</script>
</html>






















