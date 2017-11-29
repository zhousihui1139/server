<?php
//后台商品管理
class GoodsController extends Controller {
	//显示商品
	public function index(){
		//获取所有的商品分类
		$categoryModel = new CategoryModel('category');
		$cats = $categoryModel->getCats();
		//获取所有的品牌
		$brandModel = new brandModel('brand');
		$brands = $brandModel->getAll();
		//获取所有的商品类型
		$typeModel = new typeModel('goods_type');
		$types = $typeModel->getAll();
		//获取所有商品
		$goodsModel = new GoodsModel('goods');
		$goods = $goodsModel->getAll();
		include CUR_VIEW_PATH . "goods_list.html";
	}
	//显示添加商品页面
	public function add(){
		//获取所有的商品分类
		$categoryModel = new CategoryModel('category');
		$cats = $categoryModel->getCats();
		//获取所有的品牌
		$brandModel = new brandModel('brand');
		$brands = $brandModel->getAll();
		//获取所有的商品类型
		$typeModel = new typeModel('goods_type');
		$types = $typeModel->getAll();
		include CUR_VIEW_PATH . "goods_add.html";
	}
	
	//商品入库
	public function insert(){
		//1.收集表单数据，以关联数组的形式来收集
		$data['goods_name'] = trim(($_POST['goods_name']));
		$data['goods_sn'] = trim(($_POST['goods_sn']));
		$data['cat_id'] = $_POST['cat_id'] + 0 ;
		$data['brand_id'] = $_POST['brand_id'] + 0;
		$data['type_id'] = $_POST['type_id'] + 0;
		$data['shop_price'] = floatval($_POST['shop_price']);
		$data['promote_price'] = floatval($_POST['promote_price']);
		$data['market_price'] = floatval($_POST['market_price']);
		$data['promote_start_time'] = strtotime($_POST['promote_start_time']) + 0;
		$data['promote_end_time'] = strtotime($_POST['promote_end_time']) + 0;
		$data['goods_desc'] = trim(($_POST['goods_desc']));
		$data['goods_brief'] = trim(($_POST['goods_brief']));
		$data['goods_number'] = trim(($_POST['goods_number'])) + 0;
		$data['is_best'] = isset($_POST['is_best']) ? $_POST['is_best'] + 0 : 0;
		$data['is_hot'] = isset($_POST['is_hot']) ? $_POST['is_hot'] + 0 : 0;
		$data['is_new'] = isset($_POST['is_new']) ? $_POST['is_new'] + 0 : 0;
		$data['is_onsale'] = isset($_POST['is_onsale']) ? $_POST['is_onsale'] + 0 : 0;

		//对上传商品图片的处理
		$goodsModel = new GoodsModel('goods');
		$return = $goodsModel->imgUpload($_POST,$_FILES,$this);
		$data['goods_img'] = $return['goods_img'];
		$data['goods_thumb'] = $return['goods_thumb'];
		//2.验证和处理
		//转义处理
	    $this->helper('input');
	    $data = transferchars($data);
		//3.调用模型完成入库操作[关联插入]
		if($goods_id = $goodsModel->insert($data)){
			//成功,同时收集所有扩展属性,完成goods_attr表的insert操作
			if(isset($_POST['attr_id_list'])){
				$ids = $_POST['attr_id_list'];
				$values = $_POST['attr_value_list'];
				$prices = $_POST['attr_price_list'];
				//批量插入 ---循环
				$model = new Model('goods_attr');
				foreach ($ids as $key => $val) {
					$list['goods_id'] = $goods_id;
					$list['attr_id'] = $val + 0;
					$list['attr_value'] = $values[$key];
					$list['attr_price'] = $prices[$key];
					$model->insert($list);
				}
			}
			$this->jump('index.php?p=admin&c=goods&a=index','添加商品成功',1);
		}else{
			//失败
			$this->jump('index.php?p=admin&c=goods&a=add','添加商品失败');
		}
		
	}

	//显示编辑商品页面
	public function edit(){
		
		include CUR_VIEW_PATH . "goods_edit.html";
	}
	//商品更新操作
	public function update(){

	}
	//删除商品操作
	public function delete(){

	}
}