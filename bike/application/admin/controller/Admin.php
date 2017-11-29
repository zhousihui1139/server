<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Cate as CateModel;
use app\admin\model\AuthRule as AuthRuleModel;
use think\Session;
use think\Db;
class Admin extends Base
{
    public function showlist()
    {
        //联表查询管理员所属组别以及对应权限ids
        $res = db('admin')->field("a.id,a.name,b.title,b.status,b.rules")
                ->alias('a')->join("(SELECT g.*,ga.uid from bk_auth_group as g INNER JOIN bk_auth_group_access as ga on g.id=ga.group_id) b","a.id=b.uid")
                ->paginate(10);
        // $query = "SELECT a.id,a.name,b.title,b.status,b.rules from bk_admin as a 
        // INNER JOIN (SELECT g.*,ga.uid from bk_auth_group as g INNER JOIN 
        // bk_auth_group_access as ga on g.id=ga.group_id)as b on a.id=b.uid";
        $resarr = $res->toArray();
        $adminres = $resarr['data'];
        $CateModel = new CateModel();
        foreach ($adminres as $key=>$val) {
            $adminres[$key]['rules'] = explode(',',$val['rules']);
            foreach ($adminres[$key]['rules'] as $k=>$v) {
                $titlearr = db('auth_rule')->find($v);
                $adminres[$key]['rules'][$k] = $titlearr;
            }
            $adminres[$key]['rules'] = $CateModel->sortarr($adminres[$key]['rules']);
        }
        $AuthRule = new AuthRuleModel();
        $this->assign('res',$res);
        $this->assign('adminres',$adminres);
        $this->assign('AuthRule',$AuthRule);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $admin = new AdminModel();
            $data = input('post.');
            $res = $this->validate($data,'Admin');
            if(!$res === true){
                $this->error($res);
            }
            $group_id = $data['group_id'];
            unset($data['group_id']);
            if($id = Db::name('admin')->insertGetId($data)){
                db('auth_group_access')->insert(['uid'=>$id,'group_id'=>$group_id]);
                $this->success('添加管理员成功!',url('showlist'),'',1);
            }
            return;
        }
        $groups = db('auth_group')->where('status',1)->select();
        foreach ($groups as $key=>$val) {
            $groups[$key]['rules'] = explode(',',$val['rules']);
            foreach ($groups[$key]['rules'] as $k=>$v) {
                $titlearr = db('auth_rule')->field('title')->find($v);
                $groups[$key]['rules'][$k] = $titlearr['title'];
            }
        }
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    public function edit($id)
    {
        //如果有post参数传入,说明已填写表单
        if(request()->isPost()){
            //获取表单数据
            $data = input('post.');
            $adminModel = new AdminModel();
            $name = $adminModel->field('name')->find($id);
            if(isset($data['password'])){
                //有密码传入则验证
                $res = $adminModel->validate(true)->save($data,['id'=>$id]);
            }else{
                //无密码传入则只验证name
                $res = $adminModel->validate('Admin.editname')->save($data,['id'=>$id]);
            }
            if($res !== false){
                if(session('admin_id') == $data['id']){
                    //如果有更改且是登录管理员更改自身信息则需要重新登录
                    $this->success('更改您的信息成功,请重新登录',url('login/login'),'',1);
                }
                $this->success('更改管理员信息成功',url('showlist'),'',1);
            }else{
                $this->error($adminModel->getError(),url('edit',array('id'=>$id)));
            }
        }
        $admin = db('admin')->field('a.id,a.name,g.group_id')->alias('a')
                ->join('bk_auth_group_access g','a.id=g.uid')->find($id);
        if(!$admin){
            $this->error('该管理员不存在');
        }
        $groups = db('auth_group')->select();
        foreach ($groups as $key=>$val) {
            $groups[$key]['rules'] = explode(',',$val['rules']);
            foreach ($groups[$key]['rules'] as $k=>$v) {
                $titlearr = db('auth_rule')->field('title')->find($v);
                $groups[$key]['rules'][$k] = $titlearr['title'];
            }
        }
        $this->assign('groups',$groups);
        $this->assign('admin',$admin);
        return $this->fetch();
    }

    public function del($id)
    {
        $return = AdminModel::destroy($id);
        if($return){
            if(!db('auth_group_access')->where('uid',$id)->delete()){
                $this->error('删除管理员时出错,操作取消');
            }
            $this->success('删除管理员成功',url('showlist'),'',1);
        }else{
            $this->error('删除管理员失败');
        }
    }

    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->success('退出成功',url('login/login'),'',1);
    }
}

