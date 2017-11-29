<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Session;
use think\Loader;
class Login extends Controller
{
    public function login()
    {
    	if(request()->isAjax()){
            $data = input('post.');
            if(true !== $res = $this->validate($data,'Admin.login')){
                $this->result('',0,$res);
            }
            $this->checkCode($data['code']);
    		$adminModel = new AdminModel();
    		$res = $adminModel->login($data);
    		if($res == 1){
                $this->result('',0,'用户名不存在!');
    		}elseif($res == 2){
                $this->result('',0,'用户名密码错误!');
    		}else{
    			//登录成功
    			Session::set('admin_id',$res['id']);
    			Session::set('admin_name',$res['name']);
    			$this->result('',1,'登录成功!');
    		}
    		return;
    	}
        return $this->fetch();
    }

    //检测验证码
    public function checkCode($code='')
    {
        $captcha = new \think\captcha\Captcha();
        if(!$captcha->check($code)){
            $this->result('',0,'验证码错误!');
        }
    }
}
