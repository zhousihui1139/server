<?php
namespace app\admin\controller;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
class AuthRule extends Base
{
    private $cate;

    protected $beforeActionList = [
        'delSub'=>['only'=>'del'],
    ];

    public function showlist()
    {
        if(request()->isPost()){
            $data = input('post.');
            foreach ($data as $key => $val) {
                if(db('auth_rule')->update(['sort'=>$val,'id'=>$key]) ===false){
                    $this->error('更改排序失败');
                }
            }
            $this->success('更改排序成功',url('showlist'),'',1);
        }
        $AuthRule = new AuthRuleModel();
        $rules = $AuthRule->order('sort desc')->select();
        $rules = $AuthRule->getSub($rules);
        $this->assign('rules',$rules);
        return $this->fetch();
    }

    public function add()
    {
        $AuthRule = new AuthRuleModel();
        if(request()->isPost()){
            $data = input('post.');
            $level = db('auth_rule')->field('level')->find($data['pid']);
            $data['level'] = isset($level['level'])?$level['level']+1:0;
            $data['type'] = isset($data['type'])?1:0;
            if($AuthRule->save($data)){
                $this->success('添加权限成功',url('showlist'),'',1);
            }else{
                $this->error('添加权限失败');
            }
            return;
        }
        $rules = db('auth_rule')->where('status',1)->select();
        $rules = $AuthRule->getSub($rules);
        $this->assign('rules',$rules);
        return $this->fetch();
    }

    public function edit($id)
    {
        $AuthRule = new AuthRuleModel();
        if(request()->isPost()){
            $data = input('post.');
            $level = db('auth_rule')->field('level')->find($data['pid']);
            $data['level'] = isset($level['level'])?$level['level']+1:0;
            $data['type'] = isset($data['type'])?1:0;
            $data['status'] = isset($data['status'])?1:0;
            if($AuthRule->save($data,$data['id']) !== false){
                $this->success('修改权限成功',url('showlist'),'',1);
            }else{
                $this->error('修改权限失败');
            }
        }
        $rules = db('auth_rule')->where('status',1)->select();
        $rules = $AuthRule->getSub($rules);
        $this->assign('rules',$rules);
        $ruleinfo = db('auth_rule')->find($id);
        $this->assign('ruleinfo',$ruleinfo);
        return $this->fetch();
    }

    public function del($id)
    {
        if(AuthRuleModel::destroy($id)){
            $this->success('删除权限成功',url('showlist'),'',1);
        }else{
            $this->error('删除权限失败');
        }
    }

    public function delSub()
    {
        $id = input('id');
        $cate = new \app\admin\model\Cate();
        $subids = $cate->getSubIds(db('auth_rule')->select(),$id);
        if(!empty($subids)){
            //若有下级权限则全部删除
            if(!db('auth_rule')->delete($subids)){
                $this->error('删除子权限时出错!操作无效',url('showlist'));
            }
        }
    }
}

