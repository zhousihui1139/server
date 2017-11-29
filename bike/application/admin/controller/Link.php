<?php
namespace app\admin\controller;
use app\admin\model\Link as LinkModel;
class Link extends Base
{
    public function showlist()
    {
        if(request()->isPost()){
            //更改排序
            $sorts = input('post.');
            foreach ($sorts as $id => $sort){
                db('link')->update(['id'=>$id,'sort'=>$sort]);
            }
            $this->success('更改排序成功!',url('showlist'),'',1);
            return;
        }
        $links = db('link')->order('sort desc')->paginate(5);
        $this->assign('links',$links);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $LinkModel = new LinkModel();
            if($LinkModel->validate('Link.add')->save(input('post.'))){
                $this->success('添加链接成功',url('showlist'),'',1);
            }else{
                $this->error($LinkModel->getError());
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        if(request()->isPost()){
            $LinkModel = new LinkModel();
            $data = input('post.');
            if($LinkModel->validate('Link.edit')->save($data,$data['id']) !== false){
                $this->success('修改链接成功',url('showlist'),'',1);
            }else{
                $this->error($LinkModel->getError());
            }
            return;
        }
        $link = db('link')->find(input('id'));
        $this->assign('link',$link);
        return $this->fetch();
    }

    public function del()
    {
        if(db('link')->delete(input('id'))){
            $this->success('删除链接成功',url('showlist'),'',1);
        }else{
            $this->error('删除连接失败');
        }
    }
}

