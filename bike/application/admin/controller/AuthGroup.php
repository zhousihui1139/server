<?php
namespace app\admin\controller;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
class AuthGroup extends Base
{
    public function showlist()
    {
        $groups = db('auth_group')->select();
        $rulearr = [];
        foreach ($groups as $key => $val) {
            $auths = db('auth_rule')->field('title')->where('status',1)->select($val['rules']);
            $autharr = [];
            foreach ($auths as $k => $v) {
                $autharr[]=$v['title'];
            }
            $rulearr[$val['id']] = $autharr;
        }
        $this->assign('groups',$groups);
        $this->assign('rulearr',$rulearr);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(isset($data['rules'] )){
                $data['rules'] = implode(',',$data['rules']);
            }else{
                $this->error('选中权限不能为空');
            }
            $data['status'] = 1;
            $AuthGroup = new AuthGroupModel();
            if($AuthGroup->validate(true)->save($data)){
                $this->success('添加用户组成功',url('showlist'),'',1);
            }else{
                $this->error($AuthGroup->getError());
            }
            return;
        }
        $AuthRule = new AuthRuleModel();
        $rules = $AuthRule->getRules();
        $this->assign('rules',$rules);
        return $this->fetch();
    }

    public function edit($id)
    {
        if(request()->isPost()){
           $data = input('post.');
            if(isset($data['rules'] )){
                $data['rules'] = implode(',',$data['rules']);
            }else{
                $this->error('选中权限不能为空');
            }
            $data['status'] = isset($data['status'])?1:0;
            if(isset($data['is_del']) && $data['is_del']==1){
                $adminids = db('auth_group_access')->field('uid')->where('group_id',$data['id'])->select();
                if(!empty($adminids)){
                    foreach ($adminids as $key => $val) {
                        $adminids[$key] = $val['uid'];
                    }
                    foreach ($adminids as $v) {
                        if(db('auth_group_access')->where('uid',$v)->delete()){
                            db('admin')->where('id',$v)->delete();
                        }else{
                            $this->error('删除管理员时出错,操作取消');
                        }
                    }
                }
            }
            $AuthGroup = new AuthGroupModel();
            if($AuthGroup->allowField(true)->validate(true)->save($data,$data['id']) !== false){
                $this->success('修改用户组成功',url('showlist'),'',1);
            }else{
                $this->error($AuthGroup->getError());
            }
            return;
        }
        $AuthGroup = new AuthGroupModel();
        $groupinfo = $AuthGroup->find($id);
        $AuthRule = new AuthRuleModel();
        $rules = $AuthRule->getRules();
        $this->assign('groupinfo',$groupinfo);
        $this->assign('rules',$rules);
        return $this->fetch();
    }

    public function del($id)
    {
        if(AuthGroupModel::destroy($id)){
            $this->success('删除用户组成功',url('showlist'),'',1);
        }else{
            $this->error('删除用户组失败');
        }
    }

    
}

