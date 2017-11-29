<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"E:\WWW\project\tp5\bike\public/../application/admin\view\conf\edit.html";i:1510192190;s:75:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\header.html";i:1510383902;s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\left.html";i:1510312538;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>配置管理</title>

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
                        <li><a href="<?php echo url('showlist'); ?>">配置项管理</a></li>
                        <li class="active">修改配置项</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">修改配置项</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
<form class="form-horizontal" role="form" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $conf['id']; ?>">
    <input type="hidden" name="value" value="<?php echo $conf['value']; ?>">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">中文名称</label>
        <div class="col-sm-6">
            <input class="form-control" required="true"  placeholder="" name="cnname" type="text" value="<?php echo $conf['cnname']; ?>">
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">英文名称</label>
        <div class="col-sm-6">
            <input class="form-control" required="true"  placeholder="" name="enname" type="text" value="<?php echo $conf['enname']; ?>">
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-2 control-label no-padding-right">配置类型</label>
        <div class="col-sm-6">
            <select name="type" disabled="true" title="编辑时不可更改此项">
                <option value="1" <?php if($conf['type']==1): ?>selected='true'<?php endif; ?>>单行文本</option>
                <option value="2" <?php if($conf['type']==2): ?>selected='true'<?php endif; ?>>多行文本</option>
                <option value="3" <?php if($conf['type']==3): ?>selected='true'<?php endif; ?>>单选按钮</option>
                <option value="4" <?php if($conf['type']==4): ?>selected='true'<?php endif; ?>>复选按钮</option>
                <option value="5" <?php if($conf['type']==5): ?>selected='true'<?php endif; ?>>下拉菜单</option>
            </select>
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
    </div>

    <div class="form-group values" style="display: none">
        <label for="username" class="col-sm-2 control-label no-padding-right"></label>
        <div class="col-sm-6">
            可选值&nbsp;&nbsp;(<span style="color:red">可选值之间以回车分隔</span>)
            <textarea class="form-control" placeholder="" name="values"><?php echo $conf['values']; ?></textarea>
        </div>
        <p class="help-block col-sm-4 red">* 必填</p>
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
        $(function() {
            if($("[name=type]").val()>=3){
                $('.values').attr('style','display:block');
            }
            $("[name=type]").change(function(){
                if($(this).val() >= 3){
                    $('.values').attr('style','display:block');
                }else{
                    $('.values').attr('style','display:none');
                }
            })
        })
    </script>
    


</body></html>