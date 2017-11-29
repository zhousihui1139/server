<?php
namespace app\index\controller;
use app\index\model\Article;
use think\Controller;
class Search extends Base
{
    public function index()
    {
        $keywords = input('keywords');

            $serRes = db('article')->order('time desc')->where('title','like','%'.$keywords.'%')->paginate(2,false,['query'=>['keywords'=>$keywords]]);
        if(!empty($serRes['items'])){
            $this->assign('serRes',$serRes);
        }
        $article = new Article();
        $cateid = input('cateid');
        $hotRes = $article->getHotRes($cateid);
        $cateModel = new \app\index\model\Cate();
        $cateInfo = $cateModel->getCateInfo($cateid);
        $this->assign(array(
            'keywords'=>$keywords,
            'hotRes'=>$hotRes,
            'cateInfo'=>$cateInfo
        ));
        return $this->fetch('search');
    }
}
