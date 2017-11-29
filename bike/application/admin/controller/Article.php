<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use think\Session;
class Article extends Base
{
    private $art;

    protected $beforeActionList = [

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
        //联表查询文章信息
        $arts = db('article')->field('a.*,b.catename')
                ->alias('a')->join('bk_cate b','a.cateid=b.id')
                ->order('a.id desc')->paginate(5);
        //将返回结果集写入模板
        $this->assign('arts',$arts);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            $Article = new ArticleModel();
            $data['time'] = time();
            if($Article->validate(true)->save($data)){
                $this->success('添加文章成功',url('showlist'),'',1);
            }else{
                $this->error($Article->getError());
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        if(request()->isPost()){
            $Article = new ArticleModel();
            $data = input('post.');
            $id = $data['id'];
            if($Article->validate(true)->save($data,$id) !== false){
                $this->success('修改文章成功',url('showlist'),'',1);
            }else{
                $this->error($Article->getError());
            }
            return;
        }
        $art = db('article')->find(input('id'));
        $this->assign('art',$art);
        return $this->fetch();
    }

    public function del($id,$isDelCate=false)
    {
        $res = ArticleModel::destroy($id);
        if($isDelCate){
            return $res;
        }else{
            if($res){
                $this->success('删除文章成功',url('showlist'),'',1);
            }else{
                $this->error('删除文章失败');
            }
        }
    }
}

