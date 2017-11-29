<?php
namespace app\index\model;
use think\Model;
use app\common\model\ArrayDeal;
class Article extends Model
{
    public function getAllArticles($cateid)
    {	
    	$ArrayDeal = new ArrayDeal();
    	$arr = db('cate')->select();
    	$subids = $ArrayDeal->getSubIds($arr,$cateid,false);
    	return db('article')->where("cateid IN($subids)")->order('id desc')->paginate(9);
    }

    public function getHotRes($cateid=0)
    {   
        $ArrayDeal = new ArrayDeal();
        $arr = db('cate')->select();
        $subids = $ArrayDeal->getSubIds($arr,$cateid,false);
        return db('article')->where("cateid IN($subids)")->order('click desc')->limit(5)->select();
    }

    public function getNewRes($cateid=0)
    {	
    	return db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,c.catename')->alias('a')->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
    }

    public function getSiteHot()
    {
        return $this->field('id,title,thumb')->order('click desc')->limit(5)->select();
    }

    public function getRecArt()
    {
        return $this->where('rec',1)->field('id,title,thumb')->order('id desc')->limit(4)->select();
    }

    
}
