<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"E:\WWW\project\tp5\bike\public/../application/admin\view\admin\edit.html";i:1510295532;s:75:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\header.html";i:1509701424;s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\left.html";i:1510214462;}*/ ?>
<!DOCTYPE html>
<html><head>
        <meta charset="utf-8">
    <title>管理员管理</title>

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
    <div class="navbar">
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
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">管理员</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Admin/showlist'); ?>">
                        <span class="menu-text">管理员管理</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('AuthGroup/showlist'); ?>">
                        <span class="menu-text">用户组管理</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('AuthRule/showlist'); ?>">
                        <span class="menu-text">权限管理</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li> 

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-folder"></i>
                <span class="menu-text">栏目管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Cate/showlist'); ?>">
                        <span class="menu-text">栏目列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>                            
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file"></i>
                <span class="menu-text">文章管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Article/showlist'); ?>">
                        <span class="menu-text">文章列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>                            
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-link"></i>
                <span class="menu-text">链接管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Link/showlist'); ?>">
                        <span class="menu-text">链接列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>                            
        </li> 

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">系统</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Conf/conf'); ?>">
                        <span class="menu-text">配置值</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>  <ul class="submenu">
                <li>
                    <a href="<?php echo url('Conf/showlist'); ?>">
                        <span class="menu-text">配置项</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>                            
        </li>                        
    </ul>
    <!-- /Sidebar Menu -->
</div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                                        <li>
                        <a href="<?php echo url('admin/index/index'); ?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo url('showlist'); ?>">管理员管理</a>
                    </li>
                                        <li class="active">修改管理员</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">修改管理员</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post" data-example-id="input-group-with-checkbox-radio">
                        <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">

                        <div class="form-group" style="margin:40px auto;position: relative;width: 800px">
                          <div class="col-lg-6">
                            <div class="input-group" style="width:700px">
                              <span class="input-group-addon" style="width: 140px;">管理员名称</span>
                              <input type="text" class="form-control" name="name" required=""  value="<?php echo $admin['name']; ?>"  style="width:450px">
                            </div><!-- /input-group -->
                            
                          </div><!-- /.col-lg-6 -->
                          <p class="help-block col-sm-4 red" style="position: absolute;top:0px;right:-80px;">* 必填</p>
                        </div>

                        <div class="form-group" style="margin:40px auto;position: relative;width: 800px;">
                          <div class="col-lg-6">
                            <div class="input-group" style="width:700px">
                              <span class="input-group-addon" style="width: 140px;">
                                <label for="pwd_ckeck" style="position: absolute;top:10px;left:10px;font-size: 14px">是否重置密码</label>
                                <input type="checkbox" aria-label="Checkbox for following text input" id='pwd_ckeck' style="opacity:1;position: absolute;top:8px;left:110px;">
                              </span>
                              <input type="text" class="form-control" aria-label="Text input with checkbox" id="pwd_input" required="" name="password" disabled="true" placeholder="选中按钮后可输入新密码" style="width:450px">
                            </div><!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                        </div>

                        <?php if(session('admin_name')=='admin'): ?>
                        <div class="form-group" style="margin:40px auto;position: relative;width: 800px">
                            <div class="col-lg-6">
                            <div class="input-group" style="width:700px">
                                <span class="input-group-addon" style="width: 140px;">所属组别</span>
                                <select name="cateid">
                                    <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option <?php if($vo['id']=$admin['group_id']): endif; ?> value="<?php echo $vo['id']; ?>" title="<?php echo implode(',',$vo['rules']); ?>"><?php echo $vo['title']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div><!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                          <p class="help-block col-sm-4 red" style="position: absolute;top:0px;right:-80px;">* 必填</p>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-left: 400px;">
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
        $('[type=checkbox]').change(function () {
            if (this.checked) {
                $('#pwd_input').attr('disabled',false);
                $('#pwd_input').attr('style','width:450px;border:1px solid #9d9d9d;');
                $('#pwd_input').focus();
            }else{
                $('#pwd_input').attr('disabled',true);
                $('#pwd_input').attr('style','width:450px;');
            }
        });
        $('[type=text]').focus(function () {
            this.style='width:450px;border:2px solid #9d9d9d;font:14px bold';
        });
        $('[type=text]').blur(function () {
            this.style='width:450px;border:1px solid #9d9d9d;';
        });
    })
</script>

</body></html>