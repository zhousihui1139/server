<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\WWW\project\tp5\bike\public/../application/index\view\search\search.html";i:1510623104;s:75:"E:\WWW\project\tp5\bike\public/../application/index\view\public\header.html";i:1510622452;s:75:"E:\WWW\project\tp5\bike\public/../application/index\view\public\footer.html";i:1510575116;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $confs['sitename']; ?> --- <?php echo $cateInfo['catename']; ?></title>
<meta name="description" content="<?php echo $cateInfo['desc']; ?>" />
<meta name="keywords" content="<?php echo $cateInfo['keywords']; ?>" />
    
    <link href="__INDEX__/style/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="__INDEX__/style/style.css" />
    <script src="__INDEX__/style/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="__INDEX__/style/jquery.error.js" type="text/javascript"></script>
    <script src="__INDEX__/style/jtemplates.js" type="text/javascript"></script>
    <script src="__INDEX__/style/jquery.form.js" type="text/javascript"></script>
    <script src="__INDEX__/style/lazy.js" type="text/javascript"></script>
    <script type="text/javascript" src="__INDEX__/style/wp-sns-share.js"></script>
    <script type="text/javascript" src="__INDEX__/style/voterajax.js"></script>
    <script type="text/javascript" src="__INDEX__/style/userregister.js"></script>


    <link rel="stylesheet" href="__INDEX__/style/votestyles.css" type="text/css" />
    <link rel="stylesheet" href="__INDEX__/style/voteitup.css" type="text/css" />
    <link rel="stylesheet" href="__INDEX__/style/list.css" type="text/css" />
</head>
<body id="list_style_2" class="list_style_2">
 <script>
 function subForm()
 {

 formsearch.submit();
 //form1为form的id
 }
 </script>
<script type="text/javascript">
    function showMask() {
        $("#mask").css("height", $(document).height());
        $("#mask").css("width", $(document).width());
        $("#mask").show();
    }  
</script>
<div id="mask" class="mask" onclick="CloseMask()"></div> 

<!-- 头部 -->
<div id="header_wrap">
    <div id="header">
        <div style="float: left; width: 310px;">
            <h1>
                <a href="/" title="Bike"></a>
                <div class="" id="logo-sub-class">
                </div>
            </h1>
        </div>
        <div id="navi">

<ul id="jsddm">
<li><a class="navi_home" href="<?php echo url('index/index'); ?>">首页</a></li>
<?php if(is_array($cateres) || $cateres instanceof \think\Collection || $cateres instanceof \think\Paginator): $i = 0; $__LIST__ = $cateres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
<li>
    <a  href="http://127.0.0.1/project/tp5/bike/public/index.php/index/<?php if($cate['type']==1): ?>artlist<?php elseif($cate['type']==2): ?>page<?php elseif($cate['type']==3): ?>imglist<?php endif; ?>/index/cateid/<?php echo $cate['id']; ?>"><?php echo $cate['catename']; ?></a>
    <?php if(isset($cate['child'])): ?>
    <ul>
        <?php if(is_array($cate['child']) || $cate['child'] instanceof \think\Collection || $cate['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cate['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <li><a href="http://127.0.0.1/project/tp5/bike/public/index.php/index/<?php if($v['type']==1): ?>artlist<?php elseif($v['type']==2): ?>page<?php elseif($v['type']==3): ?>imglist<?php endif; ?>/index/cateid/<?php echo $v['id']; ?>"><?php echo $v['catename']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php endif; ?>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

            <div style="clear: both;">
            </div>

            
        </div>
        <div style="float: right; width: 209px;">
            <div class="widget" style="height: 30px; padding-top: 20px;">
                <div style="float: left;">
      <form  name="formsearch" action="<?php echo url('search/index'); ?>" method="get">
<input name="keywords" type="text" style="background-color: #000000;padding-left: 10px; font-size: 12px;font-family: 'Microsoft Yahei'; color: #999999;height: 29px; width: 160px; border: solid 1px #666666; line-height: 28px;" id="go" placeholder="在这里搜索..." onfocus="if(this.placeholder="" =='在这里搜索...'){this.placeholder="" ='';}"  onblur="if(this.placeholder="" ==''){this.placeholder="" ='在这里搜索...';}" />
        </form>
                        </div>
                <div style="float: left;">
                    <img src="__INDEX__/images/search-new.png" id="imgSearch" style="cursor: pointer; margin: 0px;
                        padding: 0px;" onclick="subForm()"  /></div>
                <div style="clear: both;">
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
<!-- /头部 -->

<div id="wrapper"> 
    <div id="xh_container">
<?php if(!empty($keywords)): ?>        
        <div id="xh_content">

<div class="path">搜索结果 <?php if(!empty($keywords)): ?> > <span style="font-weight: bold"><?php echo $keywords; ?></span><?php endif; ?>
</div>

<div class="clear"></div>
<div class="xh_area_h_3" style="margin-top: 40px;">
    <?php if(isset($serRes)): if(is_array($serRes) || $serRes instanceof \think\Collection || $serRes instanceof \think\Paginator): $i = 0; $__LIST__ = $serRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?>
<div class="xh_post_h_3 ofh">
    <?php if($article['thumb'] != ''): ?>
    <div class="xh">
        <a target="_blank" href="<?php echo url('article/index',array('artid'=>$article['id'])); ?>" title="<?php echo $article['title']; ?>">
            <img src="PUBLIC/uploads/<?php echo $article['thumb']; ?>" alt="<?php echo $article['title']; ?>" height="240" width="400">
        </a>
    </div>
    <?php endif; ?>
    <div class="<?php if($article['thumb'] != ''): ?>r<?php endif; ?> ofh">
        <h2 class="xh_post_h_3_title ofh" style="height:60px;">
            <a target="_blank" href="<?php echo url('article/index',array('artid'=>$article['id'])); ?>" title="<?php echo $article['title']; ?>"><?php echo $article['title']; ?></a>
        </h2>
        <span class="time"><?php echo date('Y年m月d日',$article['time']); ?></span>
        <div class="xh_post_h_3_entry ofh" style="color:#555;height:80px; overflow:hidden;">
            <?php echo mb_substr($article['desc'],0,90); ?>...
        </div>
        <div class="<?php if($article['thumb'] != ''): ?>b<?php endif; ?>" style="buttom:-10px">
            <a href="<?php echo url('article/index',array('artid'=>$article['id'])); ?>" class="xh_readmore" rel="nofollow">read
                more</a> <span title="<?php echo $article['zan']; ?>人赞" class="xh_love"><span class="textcontainer"><span><?php echo $article['zan']; ?></span></span> </span> <span title="88人浏览" class="xh_views"> <?php echo $article['click']; ?></span>
        </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
                <div id="pagination"><div class="wp-pagenavi">
                    <?php echo $serRes->render(); ?>
                </div></div>
    <?php else: ?>
        <span style="font-weight: bold;margin-left: 20px">此关键字无搜索结果</span>
    <?php endif; else: ?>
<div id="xh_content">
无搜索关键字
</div>
<?php endif; ?>
            </div>
        </div>
        <div id="xh_sidebar">        
<!-- 右侧 -->

         <div class="widget">

<div style="background: url('__INDEX__/style/img/hots_bg.png') no-repeat scroll 0 0 transparent;width:250px;height:52px;margin-bottom:15px;">
</div>
<ul id="ulHot">

<?php if(is_array($hotRes) || $hotRes instanceof \think\Collection || $hotRes instanceof \think\Paginator): $i = 0; $__LIST__ = $hotRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotart): $mod = ($i % 2 );++$i;?>
<li style="border-bottom:dashed 1px #ccc;height:70px; margin-bottom:15px;">
<div style="float:left;width:85px;height:55px; overflow:hidden;"><a href=":url('article,index',array('artid'=>$hotart.id))" target="_blank"><img src="PUBLIC/uploads/<?php echo $hotart['thumb']; ?>" width="83" title="<?php echo $hotart['title']; ?>" /></a></div>
<div style="float:right;width:145px;height:52px; overflow:hidden;"><a href=":url('article,index',array('artid'=>$hotart.id))" target="_blank" title="<?php echo $hotart['title']; ?>"><?php echo $hotart['title']; ?></a></div>
<?php endforeach; endif; else: echo "" ;endif; ?>
</li>



</ul>
                </div>
            
            <div class="widget portrait">
    <div>
        <div class="textwidget">
            <a href="/tougao.html"><img src="__INDEX__/style/images/tg.jpg" alt="投稿"></a><br><br>          
<script type="text/javascript">BAIDU_CLB_fillSlot("870073");</script>
<script type="text/javascript">BAIDU_CLB_fillSlot("870080");</script>
<script type="text/javascript">BAIDU_CLB_fillSlot("870081");</script>
        </div>
    </div>
</div>

        </div>
        <div class="clear">
        </div>
    </div>
    <div class="boxBor"></div>

    <div class="boxBor" onclick="IBoxBor()" style="cursor:pointer;"></div>
    <script type="text/javascript">
        $(function () {
            var imgHoverSetTimeOut = null;
            $('.xh_265x265 img').hover(function () {
                var oPosition = $(this).offset();
                var oThis = $(this);
                $(".boxBor").css({
                    left: oPosition.left,
                    top: oPosition.top,
                    width: oThis.width(),
                    height: oThis.height()
                });
                $(".boxBor").show();
                var urlText = $(this).parent().attr("href");
                $("#hdBoxbor").val(urlText);
            }, function () {
                imgHoverSetTimeOut = setTimeout(function () { $(".boxBor").hide(); }, 500);
            });
            $(".boxBor").hover(
                function () {
                    clearTimeout(imgHoverSetTimeOut);
                }
                , function () {
                    $(".boxBor").hide();
                }
            );
        });
        function IBoxBor() {
            window.open($("#hdBoxbor").val());
        }
        function goanewurl() {
            window.open($("#hdUrlFocus").val());
        }
</script>

    </div>

<div id="footer_wrap">
    <div id="footer">
        <div class="footer_navi">
            <ul id="menu-%e5%b0%be%e9%83%a8%e5%af%bc%e8%88%aa" class="menu">
                <?php if(is_array($bottomRec) || $bottomRec instanceof \think\Collection || $bottomRec instanceof \think\Paginator): $i = 0; $__LIST__ = $bottomRec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                <li id="menu-item-156" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-156">
                    <a href="http://127.0.0.1/project/tp5/bike/public/index.php/index/<?php if($cate['type']==1): ?>artlist<?php elseif($cate['type']==2): ?>page<?php elseif($cate['type']==3): ?>imglist<?php endif; ?>/index/cateid/<?php echo $cate['id']; ?>"><?php echo $cate['catename']; ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="footer_info">
            <span class="legal">Copyright &#169; 2016-2020 qq群：484519446 版权所有&#160;&#160;&#160;<a href="#">琼ICP备******号</a>&#160;&#160;&#160;
        </div>
    </div>
</div>
<div style="display: none;" id="scroll">
</div>
<script type="text/javascript" src="__INDEX__/style/z700bike_global.js"></script>

</body>
</html>
