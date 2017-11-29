<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"E:\WWW\project\tp5\bike\public/../application/admin\view\cate\edit.html";i:1510553610;s:75:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\header.html";i:1510383902;s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\left.html";i:1510312538;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>栏目管理</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <link href="__ADMIN__/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/typicons.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
    <script src="__ADMIN__/ueditor/ueditor.config.js"></script>
    <script src="__ADMIN__/ueditor/ueditor.all.min.js"></script>
    <script src="__ADMIN__/ueditor/lang/zh-cn/zh-cn.js"></script>
    
</head>
<body>
    <!-- 头部 -->
    <div class="navbar"  id='top'>
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            <img src="__ADMIN__/images/logo.png" alt="">
                        </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="__ADMIN__/images/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><?php echo \think\Request::instance()->session('admin_name'); ?></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/logout'); ?>">
                                        退出登录
                                    </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/edit',array('id'=>\think\Request::instance()->session('admin_id'))); ?>">
                                            修改密码
                                        </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                        <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                        <!-- Settings -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>
 
    <!-- /头部 -->
    
    <div class="main-container container-fluid">
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input class="searchinput" type="text">
        <i class="searchicon fa fa-search"></i>
        <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <?php if(is_array($rules_left) || $rules_left instanceof \think\Collection || $rules_left instanceof \think\Paginator): if( count($rules_left)==0 ) : echo "" ;else: foreach($rules_left as $key=>$v1): ?>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-<?php echo $v1['name']; ?>"></i>
                <span class="menu-text"><?php echo $v1['title']; ?></span>
                <i class="menu-expand"></i>
            </a>
            <?php if(isset($v1['child'])): if(is_array($v1['child']) || $v1['child'] instanceof \think\Collection || $v1['child'] instanceof \think\Paginator): if( count($v1['child'])==0 ) : echo "" ;else: foreach($v1['child'] as $key=>$v2): ?>
            <ul class="submenu">
                <li>
                    <a href='<?php echo url($v2['name']); ?>'>
                        <span class="menu-text"><?php echo $v2['title']; ?></span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>                
    </ul>
    <!-- /Sidebar Menu -->
</div> 
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li><a href="#">系统</a></li>
                        <li><a href="<?php echo url('showlist'); ?>">栏目管理</a></li>
                        <li class="active">编辑栏目</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">编辑栏目</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
<form class="form-horizontal" role="form" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $cate['id']; ?>">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">上级栏目</label>
        <div class="col-sm-6">
            <select name="pid">
                <option value="0">---顶级栏目---</option>
                <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $cate['pid']): ?>selected<?php endif; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$vo['level']); ?><?php echo $vo['catename']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">栏目名称</label>
        <div class="col-sm-6">
            <input class="form-control" required="true" placeholder="" value="<?php echo $cate['catename']; ?>" name="catename" type="text">
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">关键词</label>
        <div class="col-sm-6">
            <input class="form-control"  placeholder="" value="<?php echo $cate['keywords']; ?>" name="keywords" type="text">
        </div>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">描述</label>
        <div class="col-sm-6">
            <textarea name="desc" class="form-control"><?php echo $cate['desc']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="group_id" class="col-sm-2 control-label no-padding-right">栏目类型</label>
        <div class="col-sm-6">
            <div class="radio" style="float:left; margin-right:10px;">
                <label>
                    <input <?php if($cate['type'] == 1): ?>checked="checked"<?php endif; ?> name="type" value="1"  type="radio">
                    <span class="text">文章列表</span>
                </label>
            </div>
            <div class="radio" style="float:left; margin-right:10px;">
                <label>
                    <input <?php if($cate['type'] == 2): ?>checked="checked"<?php endif; ?> name="type" class="inverted" value="2" type="radio">
                    <span class="text">单页</span>
                </label>
            </div>
            <div class="radio" style="float:left; margin-right:10px;">
                <label>
                    <input <?php if($cate['type'] == 3): ?>checked="checked"<?php endif; ?> name="type" class="inverted" value="3" type="radio">
                    <span class="text">图片列表</span>
                </label>
            </div>
        </div>
    </div>  

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">推荐到首页</label>
        <div class="col-sm-6">
            <label  class="radio" style="float:left; margin-right:10px;" style="margin-right:15px;">
                <input <?php if($cate['rec_index'] == 1): ?>checked="checked"<?php endif; ?>  name="rec_index" value="1" type="radio">
                <span class="text">是</span>
            </label>
            <label class="radio" style="float:left; margin-right:10px;" style="margin-right:15px;">
                <input <?php if($cate['rec_index'] == 0): ?>checked="checked"<?php endif; ?>  class="inverted" name="rec_index" value="0" type="radio">
                <span class="text">否</span>
            </label>
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">推荐到底部</label>
        <div class="col-sm-6">
            <label class="radio" style="float:left; margin-right:10px;" style="margin-right:15px;">
                <input name="rec_bottom" <?php if($cate['rec_bottom'] == 1): ?>checked="checked"<?php endif; ?> value="1" type="radio">
                <span class="text">是</span>
            </label>
            <label class="radio" style="float:left; margin-right:10px;" style="margin-right:15px;">
                <input <?php if($cate['rec_bottom'] == 0): ?>checked="checked"<?php endif; ?> class="inverted" name="rec_bottom" value="0" type="radio">
                <span class="text">否</span>
            </label>
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">内容</label>
        <div class="col-sm-6">
            <textarea id="content" name="content"><?php echo $cate['content']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">保存信息</button>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>  
    </div>

        <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery_002.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <script src="__ADMIN__/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>
    <script type="text/javascript">
        UE.getEditor('content',{initalFrameWidth:1000,initalFrameHeight:400});
    </script>
    


</body></html>