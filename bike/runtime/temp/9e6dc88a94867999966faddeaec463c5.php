<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\WWW\project\tp5\bike\public/../application/index\view\article\article.html";i:1510575656;s:75:"E:\WWW\project\tp5\bike\public/../application/index\view\public\header.html";i:1510563030;s:75:"E:\WWW\project\tp5\bike\public/../application/index\view\public\footer.html";i:1510575116;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $article['title']; ?></title>
<meta name="description" content="<?php echo $article['desc']; ?>" />
<meta name="keywords" content="<?php echo $article['keywords']; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="__INDEX__/style/style.css" />       
<script src="__INDEX__/style/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="__INDEX__/style/jquery.js" type="text/javascript"></script>
    <!-- <script src="__INDEX__/style/jquery.error.js" type="text/javascript"></script> -->
    <script src="__INDEX__/style/jtemplates.js" type="text/javascript"></script>
    <!-- <script src="__INDEX__/style/jquery.form.js" type="text/javascript"></script> -->
    <script src="__INDEX__/style/lazy.js" type="text/javascript"></script>
    <script type="text/javascript" src="__INDEX__/style/wp-sns-share.js"></script>
    <script type="text/javascript" src="__INDEX__/style/voterajax.js"></script>
    <script type="text/javascript" src="__INDEX__/style/userregister.js"></script>
    <link rel="stylesheet" href="__INDEX__/style/pagenavi-css.css" type="text/css" media="all" />
    <link rel="stylesheet" href="__INDEX__/style/votestyles.css" type="text/css" />
    <link rel="stylesheet" href="__INDEX__/style/voteitup.css" type="text/css" />
    <link rel="stylesheet" href="__INDEX__/style/article.css" type="text/css" />

<script type="text/javascript">

function ILike(th, v) {
    if (v) {
        $(th).addClass("single_views_over");
    }
    else {
        $(th).removeClass("single_views_over");
    }
}

</script>
 
</head>
<body class="single2">
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
      <form  name="formsearch" action="/plus/search.php"><input type="hidden" name="kwtype" value="0" />                
<input name="q" type="text" style="background-color: #000000;padding-left: 10px; font-size: 12px;font-family: 'Microsoft Yahei'; color: #999999;height: 29px; width: 160px; border: solid 1px #666666; line-height: 28px;" id="go" value="在这里搜索..." onfocus="if(this.value=='在这里搜索...'){this.value='';}"  onblur="if(this.value==''){this.value='在这里搜索...';}" />
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

    <div id="wrapper">
        <div id="container">
            <div id="content">
                <div class="post" id="post-19563" style="border-right: solid 1px #000000; min-height: 1700px;
                    margin-top: 10px;">
                    <div class="path"><a href="<?php echo url('index/index'); ?>">主页</a>
                        <?php foreach($cates as $cate): ?>
                         ><a href="<?php echo url('artlist/index',array('cateid'=>$cate['id'])); ?>"><?php echo $cate['catename']; ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="single_entry single2_entry">
                        <div class="entry fewcomment">
                            <div class="title_container">
                                <h2 class="title single_title">
                                    <span><?php echo $article['title']; ?></span><span class="title_date"></span></h2>
                                <p class="single_info">时间：<?php echo date('Y-m-d H:m',$article['time']); ?>&nbsp;&nbsp;&nbsp;编辑：<?php echo $article['author']; ?></p>
                            </div>
                            <div class="div-content">
                               <?php echo $article['content']; ?>
                                
                                <center id="pagenav">
                                    </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebar">
                <div class="widget single" style="margin-bottom: 0px; margin-left: 0px; margin-top: 40px;
                    padding-bottom: 0px;" id="newdigg">
                    
<!-- 右侧 -->

         <div class="widget">

<div style="background: url('__INDEX__/images/hots_bg.png') no-repeat scroll 0 0 transparent;width:250px;height:52px;margin-bottom:15px;">
</div>
<ul id="ulHot">
<?php if(is_array($hotRes) || $hotRes instanceof \think\Collection || $hotRes instanceof \think\Paginator): $i = 0; $__LIST__ = $hotRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotArt): $mod = ($i % 2 );++$i;?>
<li style="border-bottom:dashed 1px #ccc;height:70px; margin-bottom:15px;">
<div style="float:left;width:85px;height:55px; overflow:hidden;"><a href="<?php echo url('article/index',array('artid'=>$hotArt['id'])); ?>" target="_blank"><img src="PUBLIC/uploads/<?php echo $hotArt['thumb']; ?>" width="83" title="<?php echo $hotArt['title']; ?>" /></a></div>
<div style="float:right;width:145px;height:52px; overflow:hidden;"><a href="<?php echo url('article/index',array('artid'=>$hotArt['id'])); ?>" target="_blank" title="<?php echo $hotArt['title']; ?>"><?php echo $hotArt['title']; ?></a></div>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>


</ul>
                </div>
            
            <div class="widget portrait">
    <div>
        <div class="textwidget">        
<!-- <script type="text/javascript">BAIDU_CLB_fillSlot("870073");</script>
<script type="text/javascript">BAIDU_CLB_fillSlot("870080");</script>
<script type="text/javascript">BAIDU_CLB_fillSlot("870081");</script> -->
        </div>
    </div>
</div>
                
                
            </div>
            <div class="clear">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="__INDEX__/style/z700bike_global.js"></script>
    <script type="text/javascript" src="__INDEX__/style/z700bike_single.js"></script>
  
    <!-- <script type='text/javascript' src='/blog4__INDEX__/style/jquery.colorbox-min.js?ver=1.3.17.2'></script> -->


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
