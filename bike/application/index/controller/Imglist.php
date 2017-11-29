<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Article;
class Imglist extends Base
{
    public function index()
    {
    	$article = new Article();
    	$cateid = input('cateid');
    	$artRes = $article->getAllArticles($cateid);
    	$cateModel = new \app\index\model\Cate();
        $cateInfo = $cateModel->getCateInfo($cateid);
    	$this->assign(array(
    		'artRes'=>$artRes,
    		'cateInfo'=>$cateInfo
		));
        return $this->fetch('imglist');
    }
}
