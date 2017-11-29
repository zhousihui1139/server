<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"E:\WWW\project\tp5\bike\public/../application/admin\view\admin\showlist.html";i:1510365442;s:75:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\header.html";i:1510383902;s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\public\left.html";i:1510312538;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>管理员</title>

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
                        <li>
                            <a href="<?php echo url('index/index'); ?>">系统</a>
                        </li>
                        <li class="active">管理员管理</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<button type="button" tooltip="添加管理员" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo url('add'); ?>'"> <i class="fa fa-plus"></i> Add
</button>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">用户名称</th>
                                <th class="text-center" width="20%">所属用户组</th>
                                <th class="text-center" >操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($adminres) || $adminres instanceof \think\Collection || $adminres instanceof \think\Paginator): $i = 0; $__LIST__ = $adminres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><?php echo $v['id']; ?></td>
                                <td align="center"><?php echo $v['name']; ?></td>
                                <?php if($v['status']==1): ?>
                                <td align="center" style="position: relative;" name='rules_show' onmouseover="$(this).children()[0].style.display='block';" onmouseout="$(this).children()[0].style.display='none';">
<div style="display: none;position: absolute;top:-50px;left:150px;background-color: #fff;" >
    <table class="table table-hover">
        <thead class="bordered-darkorange">
            <tr><th>拥有权限</th></tr>
        </thead>
        <tbody>
            <!-- <ul class="list-group" style="width: 200px"> -->
                <?php foreach($v['rules'] as $rule): ?>
        <tr value="<?php echo $rule['id']; ?>_<?php echo $key; ?>" name='tr' title="点击收起子级权限" style="display: block;">
            <td style="padding: 0;margin: 0">
                <button type="button " name="<?php echo $key; ?>" flag='1' class="list-group-item rule_button" subids="<?php echo $AuthRule->getSubIds($rule['id']); ?>" style="text-align: left;width: 200px;"  onmouseover="this.style.backgroundColor='#F0F0F0'" onmouseout="this.style.backgroundColor='#FFF'">
                <span class="badge"></span>
                    <?php echo str_repeat('&nbsp;',$rule['level']*10); ?><?php echo $rule['title']; ?>
                </button>
            </td>
        </tr>
                <?php endforeach; ?>
            <!-- </ul> -->
        </tbody>
    </table>
</div><?php echo $v['title']; ?>
</td>
<?php else: ?>
<td align="center" style="color: red">无效分组</td>
<?php endif; ?>
                                <td align="center">
                                    <a href="<?php echo url('edit',array('id'=>$v['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <a href="#" onClick="warning('确实要删除吗', '<?php echo url('del',array('id'=>$v['id'])); ?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div style="padding-top:10px;text-align: center;z-index: 100">
                    <?php echo $res->render(); ?>
                </div>
                <div>
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
    $('.rule_button').click(function() {
        subids = $(this).attr('subids');
        key = $(this).attr('name');
        if(subids){
            subids = subids.split(',');
            if($(this).attr('flag') == 1){
                for(i=0;i<subids.length;i++){
                    if($('[value='+subids[i]+'_'+key+']')[0]){
                        $('[value='+subids[i]+'_'+key+']')[0].style.display = 'none';
                    }
                }
                $(this).attr('flag',0);
                $(this).children().html(subids.length);
            }else{
                for(i=0;i<subids.length;i++){
                     if($('[value='+subids[i]+'_'+key+']')[0]){
                        $('[value='+subids[i]+'_'+key+']')[0].style.display = 'block';
                    }
                }
                $(this).attr('flag',1);
                $(this).children().html('');
            }
        }

    })
    </script>

</body></html>