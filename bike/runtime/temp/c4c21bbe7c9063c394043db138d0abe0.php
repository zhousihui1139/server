<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"E:\WWW\project\tp5\bike\public/../application/admin\view\login\login.html";i:1510228726;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>童老师ThinkPHP交流群：484519446</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">

</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">SIGN IN</div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="name" name="name" type="text">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="password" name="password" type="password">
                </div>
                <div class="loginbox-textbox">
                    <input style="float: left;width:100px;margin-top: 5px;" class="form-control" placeholder="输入验证码" name="code" type="text">
                    <img style="float: left;width:120px;cursor: pointer;" title="点击更换验证码" name="captcha"  src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>'" alt="captcha"/>
                </div>
                <div class="loginbox-submit">
                    <input class="btn btn-primary btn-block" style="margin: 20px 0;" value="Login" type="button">
                </div>
                <div class="alert alert-danger" role="alert" style="position: absolute;width:200px;top:250px;left:50px;display: none;text-align: center">用户名错误</div>
            </div>
        </form>
    </div>
    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <script src="__ADMIN__/style/jquery_002.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>

    <script type="text/javascript">
        $(function () {
            $('[type=button]').click(function () {
                $.ajax({
                    'url':"<?php echo url("","",true,false);?>",
                    'data':$('form').serialize(),
                    'type':"post",
                    success:function (request) {
                        if(request.code == 0){
                            $('.alert').fadeIn(1000);
                            $('.alert').text(request.msg);
                            setTimeout(function () {
                                $('.alert').fadeOut(2000);
                            },3000);
                        }else if(request.code == 1){
                            $('.alert').fadeIn(500);
                            $('.alert').attr('class','alert alert-success');
                            $('.alert').text(request.msg+(' 3秒后跳转'));
                            setTimeout(function () {
                                window.location.href="<?php echo url('index/index'); ?>";
                            },3000);
                        }else{
                            $('.alert').fadeIn(1000);
                            $('.alert').text("未知错误!!!");
                        }
                    }
                })
            });
        })
    </script>

</body><!--Body Ends--></html>