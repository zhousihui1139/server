<?php
namespace app\admin\controller;
use think\Controller;
class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function check()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code']))
                $this->result('',0,'验证码输入错误');    
            //判断管理员是否存在
            $user = model('AdminUser')->get(['username'=>$data['username']]);
            if(!$user || $user->status != 1)
                $this->result('',0,'管理员不存在');
            //验证密码
            if($user->password != md5($data['password'].'_#singwa'))
                $this->result('',0,'密码错误');
            $this->result('',1,'登录成功');
        }else{
            $this->error('非法请求');
        }
        
    }
    
}
