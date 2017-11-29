<?php
namespace app\index\controller;
use app\index\model\Article;
use think\Controller;
class Artlist extends Base
{
    public function index()
    {
    	$article = new Article();
    	$cateid = input('cateid');
    	$artRes = $article->getAllArticles($cateid);
    	$hotRes = $article->getHotRes($cateid);
        $cateModel = new \app\index\model\Cate();
        $cateInfo = $cateModel->getCateInfo($cateid);
    	$this->assign(array(
            'artRes'=>$artRes,
        	'hotRes'=>$hotRes,
            'cateInfo'=>$cateInfo
        ));
        return $this->fetch('artlist');
    }
}
