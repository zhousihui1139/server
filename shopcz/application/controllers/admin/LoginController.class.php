<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-23 14:18:30
 * @version $Id$
 */

class LoginController extends Controller {
    
    //载入登录视图
	public function login()
	{
		include CUR_VIEW_PATH.'login.html';
	}

	//验证用户登录
	public function sigin()
	{
		//1.收集用户名和密码
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		//用户名及密码 ' 转义
		$username = addslashes($username);
		$password = addslashes($password);

		//检查验证码
		$captcha = trim($_POST['captcha']);
		if($_SESSION['captcha'] != strtolower($captcha)){
			$this->jump('index.php?p=admin&c=login&a=login','验证码错误');
		}

		//2.验证和处理
		if($username === ''){
			$this->jump('index.php?p=admin&c=login&a=login','用户名不能为空');
		}
		if($password === ''){
			$this->jump('index.php?p=admin&c=login&a=login','密码不能为空');
		}
		//3.调用模型完成用户的检查并给出相应提示
		$admin = new AdminModel('admin');
		$user = $admin->userCheck($username,md5($password));
		if(!empty($user)){
			//登陆成功,先保存登录信息
			$_SESSION['admin'] = $username;
			$this->jump('index.php?p=admin&c=index&a=index','',0);
		}else{
			//失败
			$this->jump('index.php?p=admin&c=login&a=login','用户名或密码错误');
		}
	}

	//注销
	public function logout()
	{
		unset($_SESSION['admin']);
		session_destroy();
		$this->jump('index.php?p=admin&c=login&a=login','',0);
	}
	
	//生成验证码
	public function captcha()
	{
		//载入验证码类
		$this->library('Captcha');
		//实例化对象
		$captcha = new Captcha();	
		//生成验证码图片
		$captcha->generateCode();
		//将验证码保存到session中
		$_SESSION['captcha']=$captcha->getCode();
	}
}