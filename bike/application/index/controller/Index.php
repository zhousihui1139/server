<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
    	//获取最新文章
    	$article = new \app\index\model\Article();
    	$newArts = $article->getNewRes();
        $siteHotArt = $article->getSiteHot();
        //友情链接
        $links = db('link')->order('sort desc')->select();
        //推荐轮播文章图片
        $recArt = $article->getRecArt();
        //获取推荐栏目
        $cateModel = new \app\index\model\Cate();
        $indexRec = $cateModel->getIndexRec();
    	$this->assign(array(
    		'newArts'=>$newArts,
            'siteHotArt'=>$siteHotArt,
            'links'=>$links,
            'recArt'=>$recArt,
            'indexRec'=>$indexRec,
    	));
        return $this->fetch();
    }
}
