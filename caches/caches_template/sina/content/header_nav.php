<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>
<body>
    <div style='position:absolute;top:0;left:0;width:0;height:0;visibility:hidden'><img width=0 height=0 src='images/a.gif' border='0' alt='' /></div>

    <!-- 二级导航 begin -->

    <div class="secondaryHeader">
        <div class="sHBorder">
            <div class="sHLogo"><span><a href="http://www.moe.gov.cn/"><img src="<?php echo APP_PATH;?>statics/sina/images/standardl2nav_sina_new.gif" alt="教育部"></a></span></div>
            <div class="sHLinks"><script type="text/javascript">document.write('<iframe src="<?php echo APP_PATH;?>index.php?m=member&c=index&a=mini&forward=' + encodeURIComponent(location.href) + '&siteid=<?php echo get_siteid();?>" allowTransparency="true"  width="300" height="24" frameborder="0" scrolling="no"></iframe>')</script></div>
        </div>
    </div>

    <!-- 二级导航 end --> 

    <!-- logo begin -->

    <div class="wrap">
        <div class="logo"> <img src="<?php echo APP_PATH;?>statics/sina/images/logo.jpg"> </div>
    </div>

    <!-- logo  end --> 

    <!-- 首页导航 begin-->

    <div id="menu" class="menu">
        <div class="menu_nav">
            <ul class="menu_t" id="menu_t">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6084e3661eb0b1bdd354eec87acf79ce&action=category&catid=51&num=3&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'51','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'3',));}?>
                <?php $i = 2?>
                <li id="menu1"><a href="<?php echo siteurl($siteid);?>" class="mt t1" hidefocus>首页</a></li>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li id="menu<?php echo $i;?>"><a href="javascript:void(0)"  class="mt t2" hidefocus><?php echo $r['catname'];?></a></li>
                <?php $i++?>		
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
            </ul>
            <div class="search"> 
                <form target="_blank" name="frm" method="get" action="<?php echo APP_PATH;?>index.php" class="search" id="unify_search">
                    <span class="stext">
                        <input type="text" maxlength="128" size="32" onfocus="javascript:if (this.value == '请输入搜索词')
                                            this.value = ''" onblur="javascript:if (this.value == '')
                                                        this.value = '请输入搜索词'" value="请输入搜索词" name="q" class="sinput" id="q" title="课程名">
                    </span>

                    <input type="hidden" name="m" value="search"/>
                    <input type="hidden" name="c" value="index"/>
                    <input type="hidden" name="a" value="init"/>
                    <input type="hidden" name="typeid" value="0" id="typeid"/>
                    <input type="hidden" name="siteid" value="1" id="siteid"/>      
                    <input class="sbtn" name="submit" type="submit" value=''>
                </form>

            </div>
        </div>
        <div class="menu_c_bg">
            <div class="menu_c  clearfix" id="menu_c2" style="display:none;">
                <div class="className fchg1">
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9eda7de8c2f4a6ecf7306165014a73c1&action=category&catid=9&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'9','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>			
                    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=421cd2b0c0c6ce3e3e0c7a4551f5da43&action=lists&catid=%24r%5Bcatid%5D&order=updatetime+DESC&return=info\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$info = $content_tag->lists(array('catid'=>$r[catid],'order'=>'updatetime DESC','limit'=>'20',));}?>  
                    <?php $cont = count(array_filter($info))?>
                    <a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a> 	
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <?php $n++;}unset($n); ?>        
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
                </div>
            </div>
            <div class="menu_c  clearfix" id="menu_c3" style="display:none;">
                <div class="className fchg1"> 
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cfede6022dbc46ae6800853bc706757d&action=category&catid=10&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'10','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>			
                    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1922c916f62b7e52257d2bfe34272431&action=lists&catid=%24r%5Bcatid%5D&order=updatetime+DESC&return=info\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$info = $content_tag->lists(array('catid'=>$r[catid],'order'=>'updatetime DESC','limit'=>'20',));}?>  
                    <?php $cont = count(array_filter($info))?>
                    <a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a> 	
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
                </div>
            </div>
            <div class="menu_c  clearfix" id="menu_c4" style="display:none;">
                <div class="className fchg1"> 
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f576f723ff3a371da3437b580aa542aa&action=category&catid=11&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'11','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>			
                    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1922c916f62b7e52257d2bfe34272431&action=lists&catid=%24r%5Bcatid%5D&order=updatetime+DESC&return=info\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$info = $content_tag->lists(array('catid'=>$r[catid],'order'=>'updatetime DESC','limit'=>'20',));}?>  
                    <?php $cont = count(array_filter($info))?>
                    <a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a> 	
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <?php $n++;}unset($n); ?>          
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
                </div>
            </div>
            <div class="menu_c  clearfix" id="menu_c5" style="display:none;">
                <div class="className fchg1"> </div>
            </div>
            <div class="menu_c  clearfix" id="menu_c6" style="display:none;">
                <div class="className fchg1"> </div>
            </div>
            <div class="menu_c  clearfix" id="menu_c7" style="display:none;">
                <div class="className fchg1"> </div>
            </div>
        </div>
        <script>
            var menu = new PulldownMenu(menu);
            menu.addLabel("menu2", "menu_c2");
            menu.addLabel("menu3", "menu_c3");
            menu.addLabel("menu4", "menu_c4");
        </script> 
    </div>

    <!-- 首页导航 end --> 


    <!-- 收藏公开课 end  --> 


