<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModle;
use think\Controller;
use think\Request;
class Article extends Base
{
    public function index()
    {
    	$artid = input('artid');
    	db('article')->where(['id'=>$artid])->setInc('click');
    	$article = db('article')->find($artid);
    	$ArticleModle = new ArticleModle();
    	$hotRes = $ArticleModle->getHotRes();
    	$this->assign(array(
    		'hotRes'=>$hotRes,
    		'article'=>$article,
    	));
        return $this->fetch('article');
    }
}
