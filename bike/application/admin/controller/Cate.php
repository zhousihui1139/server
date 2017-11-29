<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use think\Session;
class Cate extends Base
{
    private $cate;

    protected $beforeActionList = [
        'delSub'=>['only'=>'del'],
    ];

    public function _initialize()
    {
        parent::_initialize();
        //获取处理好的所有分类并写入模板
        $this->cate = new CateModel();
        $cates=$this->cate->getCate();
        $this->assign('cates',$cates);
    }

    public function showlist()
    {
        if(request()->isPost()){
            //更改排序
            $sorts = input('post.');
            foreach ($sorts as $id => $sort){
                $this->cate->update(['id'=>$id,'sort'=>$sort]);
            }
            $this->success('更改排序成功!',url('showlist'),'',1);
            return;
        }
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            //插入表单提交数据
            if($this->cate->validate(true)->save(input('post.'))){
                $this->success('添加栏目成功!',url('showlist'),'',1);
            }else{
                $this->error($this->cate->getError());
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        if(request()->isPost()){
            //获取编辑后的表单提交数据
            $data = input('post.');
            //获取当前栏目 的所有下级栏目id数组
            $subids = $this->cate->getSubIds(db('cate')->select(),$data['id']);
            $subids[] = $data['id'];
            if(in_array($data['pid'],$subids)){
                $this->error('上级栏目不能是自己或下级栏目');
            }
            //更新数据
            if($this->cate->validate(true)->save($data,$data['id'])  !== false ){
                $this->success('修改栏目成功!',url('showlist'),'',1);
            }else{
                $this->error($this->cate->getError());
            }
            return;
        }
        //获取要编辑的栏目信息
        $cateinfo = db('cate')->find(input('id'));
        $this->assign('cate',$cateinfo);
        return $this->fetch();
    }

    public function del()
    {
        //以CateModel类操作触发其中before_delete事件,删除该栏目下的文章
        if(db('cate')->delete(input('id'))){
            $this->success('删除栏目成功!',url('showlist'),'',1);
        }else{
            $this->error('删除栏目失败!',url('showlist'));
        }
    }

    //删除栏目前先删除其所有子级栏目
    public function delSub()
    {
        $id = input('id');
        //获取当前栏目 的所有下级栏目id数组
        $subids = $this->cate->getSubIds(db('cate')->select(),$id);
        //删除所有子栏目以及目标删除栏目下的文章
        $allids = $subids;
        $allids[] = $id;
        $article = new Article();
        foreach ($allids as $v) {
            $arts= db('article')->where(['cateid'=>$v])->select();
            foreach ($arts as $art) {
                if(!$article->del($art['id'],true)){
                    $this->error('删除文章失败,操作取消');
                }
            }
        }
        if(!empty($subids)){
            //若有下级栏目则删除所有下级栏目
            if(!db('cate')->delete($subids)){
                $this->error('删除子栏目时出错!操作无效',url('showlist'));
            }
        }
    }
}

