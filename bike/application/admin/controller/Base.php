<?php
namespace app\admin\controller;
use app\admin\model\AuthRule as AuthRuleModel;
use think\Controller;
use think\Request;
use think\Session;
class Base extends Controller{

	public function _initialize()
	{
		$this->authCheck();
        $this->getRules();
	}

    public function getRules()
    {
        //获取当前用户具有的所有权限
        if(Session::get('admin_id') !== 1){
            $res = db('admin')->field("a.id,a.name,b.title,b.status,b.rules")
                ->alias('a')->join("(SELECT g.*,ga.uid from bk_auth_group as g INNER JOIN bk_auth_group_access as ga on g.id=ga.group_id) b","a.id=b.uid")->find(Session::get('admin_id'));
                
            $rules = db('auth_rule')->order('sort desc')->select($res['rules']);
        }else{
            $rules = db('auth_rule')->order('sort desc')->select();
        }
        
        $AuthRule = new AuthRuleModel();
        $rules = $AuthRule->tree($rules);
        $this->assign('rules_left',$rules);
    }

    public function authCheck()
    {
        if(!Session::get('admin_id') || !Session::get('admin_name')){
            $this->error('您尚未登录系统',url('login/login'));
        }

        $auth=new Auth();
        $request=Request::instance();
        $con=$request->controller();
        $action=$request->action();
        $name=$con.'/'.$action;
        $notCheck=array('Index/index','Admin/lst','Admin/logout');
        if(Session::get('admin_id')!=1){
            if(!in_array($name, $notCheck)){
                if(!$auth->check($name,Session::get('admin_id'))){
                $this->error('没有权限',url('index/index')); 
                }
            }
        }
    }
}