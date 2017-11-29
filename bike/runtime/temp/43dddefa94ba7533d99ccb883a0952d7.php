<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\WWW\project\tp5\bike\public/../application/admin\view\auth_group\edit.html";i:1510301968;s:75:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\header.html";i:1509701424;s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\left.html";i:1510312538;}*/ ?>
<!DOCTYPE html>
<html><head>
        <meta charset="utf-8">
    <title>管理员组</title>

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
                                        <li>
                        <a href="#">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo url('showlist'); ?>">用户组管理</a>
                    </li>
                                        <li class="active">修改用户组</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">修改用户组</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
<form class="form-horizontal" role="form" action="" method="post">
<input type="hidden" name="id" value="<?php echo $groupinfo['id']; ?>">
<div class="form-group">
    <label for="username" class="col-sm-2 control-label no-padding-right">用户组名称</label>
    <div class="col-sm-6">
        <input class="form-control"  placeholder="" name="title" required="" value="<?php echo $groupinfo['title']; ?>" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>
<div class="form-group">
    <label for="username" class="col-sm-2 control-label no-padding-right">启用状态</label>
    <div class="col-sm-6">
    <p class="help-block col-sm-4 red">
        <label>
            <input class="checkbox-slider colored-darkorange" name="status" <?php if($groupinfo['status']==1): ?>checked="true"<?php endif; ?> type="checkbox" onchange="if(this.checked==false){
                $('[value=is_del]')[0].style.display='block';
                $('[name=is_del]')[0].disabled=false;
            }else{
                $('[value=is_del]')[0].style.display='none';
                $('[name=is_del]')[0].disabled=true;
            }">
            <span class="text"></span>
        </label>
    </p>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>
<div class="form-group" value='is_del' style="display: none">
    <label for="username" class="col-sm-2 control-label no-padding-right">是否删除该分组下管理员</label>
    <div class="col-sm-6">
    <p class="help-block col-sm-4 yellow">
        <label>
            <input disabled="true" class="checkbox-slider colored-darkorange" value="1" name="is_del"  type="checkbox">
            <span class="text"></span>
        </label>
    </p>
    </div>
</div>
<div class="form-group">
    <label for="username" class="col-sm-2 control-label no-padding-right"></label>
    <div class="col-sm-6">
       <table class="table table-hover">
            <thead class="bordered-darkorange">
                <tr>
                    <th>
                        配置权限
                    </th>
                </tr>
            </thead>
            <tbody>
<?php if(is_array($rules) || $rules instanceof \think\Collection || $rules instanceof \think\Paginator): $i = 0; $__LIST__ = $rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr>
    <td>
    <label>
        <?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $vo['level']*3);?>
        <input name="rules[]" value="<?php echo $vo['id']; ?>" subids="<?php echo $vo->getSubIds($vo['id']); ?>" supids="<?php echo $vo->getSupIds($vo['id']); ?>"   class="inverted checkbox-parent <?php if($vo['level'] !== 0): ?> checkbox-child <?php endif; ?> " type="checkbox" <?php if(in_array($vo['id'],explode(',',$groupinfo['rules']))): ?>checked='true'<?php endif; ?>>
        <span <?php if($vo['level'] == 0): ?> style="font-weight:bold; font-size:14px;" <?php endif; ?> class="text"><?php echo $vo['title']; ?></span>
    </label>
    </td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
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
/* 权限配置 */
$(function () {
    //选中时  同时选中所有上级与后代选中框
    $('[type=checkbox]').change(function() {
        subids = $(this).attr('subids');
        if(subids){
            subids = subids.split(',');
            for(i=0;i<subids.length;i++){
                if(this.checked){
                    $('[value='+subids[i]+']')[0].checked = true;
                }else{
                    $('[value='+subids[i]+']')[0].checked = false;
                }
            }
        }
        supids = $(this).attr('supids');
        if(supids){
            supids = supids.split(',');
            for(i=0;i<supids.length;i++){
                if(this.checked){
                    $('[value='+supids[i]+']')[0].checked = true;
                }
            }
        }
    })
});
    </script>

</body></html>