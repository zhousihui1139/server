<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
class Conf extends Base
{
    public function showlist()
    {
        if(request()->isPost()){
            //更改排序
            $sorts = input('post.');
            foreach ($sorts as $id => $sort){
                db('conf')->update(['id'=>$id,'sort'=>$sort]);
            }
            $this->success('更改排序成功!',url('showlist'),'',1);
            return;
        }
        $confs = db('conf')->order('sort desc')->paginate(5);
        $this->assign('confs',$confs);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $ConfModel = new ConfModel();
            $data = input('post.');
            $data['values'] = str_replace('，',',',$data['values']);
            if($ConfModel->validate(true)->save($data)){
                $this->success('添加配置项成功',url('showlist'),'',1);
            }else{
                $this->error($ConfModel->getError());
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        if(request()->isPost()){
            $ConfModel = new ConfModel();
            $data = input('post.');
            if($ConfModel->validate(true)->save($data,$data['id']) !== false){
                $this->success('修改配置项成功',url('showlist'),'',1);
            }else{
                $this->error($ConfModel->getError());
            }
            return;
        }
        $conf = db('conf')->find(input('id'));
        $this->assign('conf',$conf);
        return $this->fetch();
    }

    public function del()
    {
        if(db('conf')->delete(input('id'))){
            $this->success('删除配置项成功',url('showlist'),'',1);
        }else{
            $this->error('删除配置项失败');
        }
    }

    /**
     * 展示所有配置项及值
     * @return [type] [description]
     */
    public function conf()
    {
        if(request()->isPost()){
            $confs = db('conf')->field('id,value')->select();
            $confsdb = [];
            foreach ($confs as $k => $v) {
                $confsdb[$v['id']] = $v['value'];
            }
            $confspo = input('post.');
            foreach($confsdb as $k=>$v){
                $v = isset($confspo[$k]) ? $confspo[$k] : '';
                $v = is_array($v) ? implode(',',$v) : $v;
                if(db('conf')->update(['id'=>$k,'value'=>$v]) === false){
                    $this->error('更改配置项失败');
                }
            }
            $this->success('更改配置项成功',url('conf'),'',1);
            return;
        }
        $confres = ConfModel::order('sort desc')->select();
        $this->assign('confres',$confres);
        return $this->fetch();
    }
}

