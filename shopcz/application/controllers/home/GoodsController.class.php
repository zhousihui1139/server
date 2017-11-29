<?php
//后台商品管理
class GoodsController extends BaseController {
	//显示商品详情
	public function index(){
		$goods_id = $_GET['goods_id'] + 0;

		if(!$this->smarty->isCached('goods.html',$goods_id)){
			$goodsModel = new GoodsModel('goods');
			$goods = $goodsModel->getRow(['where'=>"goods_id=$goods_id"]);
			//图片地址处理
			$imgs = explode(PHP_EOL, $goods['goods_img']);
			$thumbs = explode(PHP_EOL, $goods['goods_thumb']);
			//面包屑导航
			$categoryModel = new CategoryModel('category');
			//获取指分类的所有上级分类
			$upcats = $categoryModel->getSupIds($goods['cat_id']);

	        //分配数据
	        $this->smarty->assign('goods',$goods);
	        $this->smarty->assign('imgs',$imgs);
	        $this->smarty->assign('thumbs',$thumbs);
	        $this->smarty->assign('upcats',$upcats);
	        
		}
		//载入模板文件
	    $this->smarty->display('goods.html',$goods_id);
	}
	
}