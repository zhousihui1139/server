<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Cate;
use app\common\model\ArrayDeal;

class Base extends Controller
{
    public function _initialize()
    {
        //当前位置(面包屑导航)
        if(input('cateid')){
            $this->getPos(input('cateid'));
        }
        if(input('artid')){
            $article = db('article')->field('cateid')->find(input('artid'));
            $cateid = $article['cateid'];
            $this->getPos($cateid);
        }
        //获取网站配置
    	$this->getConf();
        //获取二级分类导航
    	$this->getCates();
        //获取底部推荐栏目
        $this->getBottomRec();

    }
    public function getCates()
    {
    	//获取二级分类写入模板
    	$cateres=db('cate')->order('sort desc')->where('pid',0)->select();
    	foreach ($cateres as $k => $v) {
    		$child = db('cate')->where('pid',$v['id'])->select();
    		if($child){
    			$cateres[$k]['child'] = $child;
    		}
    	}
    	$this->assign('cateres',$cateres);
    }

    public function getConf()
    {
        $_confs = db('conf')->field('enname,value')->select();
        $confs = [];
        foreach ($_confs as $k => $v) {
            $confs[$v['enname']] = $v['value'];
        }
        $this->assign('confs',$confs);

    }
    public function getPos($cateid)
    {
        $ArrayDeal = new ArrayDeal();
        $cates = $ArrayDeal->getSup(db('cate')->select(),$cateid);
        $cates = array_reverse($cates);
        $this->assign('cates',$cates);
    }

    public function getBottomRec()
    {
        $cateModel = new \app\index\model\Cate();
        $bottomRec = $cateModel->getbottomRec();
        $this->assign('bottomRec',$bottomRec);
    }
}
