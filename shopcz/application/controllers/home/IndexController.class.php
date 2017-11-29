<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-10-09 10:03:18
 * @version $Id$
 */
//前台首页控制器
class IndexController extends BaseController {
    //显示首页
    public function index()
    {
    	if(!$this->smarty->isCached('index.html')){
            //获取推荐商品
            $goodsModel = new GoodsModel('goods');
            $bestGoods = $goodsModel->getBestGoods();
            
            //分配数据
            function imgDeal($imgs)
            {
               $imgs = explode(PHP_EOL,$imgs['imgs']);
               return $imgs['0'];
            }
            $this->smarty->registerPlugin("function","imgDeal","imgDeal");
            $this->smarty->assign('bestGoods',$bestGoods);
            //当前页面是首页
            $this->smarty->assign('index',true);
        }
        //载入模板文件
        $this->smarty->display('index.html');
    }
	
	//清除缓存
   public function clear()
   {
        //删除首页缓存
        //$this->smarty->clearCache('index.html');
        //清楚指定页面的指定缓存
        //$this->smarty->clearCache('goods.html',13);
        //删除所有
        $this->smarty->clearAllCache();
   }
}