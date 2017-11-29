<?php
//后台商品类型管理
class TypeController extends Controller {
	//显示类型
	public function index(){
		//获取所有商品类型总记录数
		$typeModel = new TypeModel('goods_type');
		$total = $typeModel->total();
		//分页获取数据
		$pagesize = 2;//每页显示的记录数
		$current = isset($_GET['page'])?$_GET['page']:1;
		$offset = ($current - 1) * $pagesize;

		//获取所有类型及对应属性数
		$types = $typeModel->getTypeAttrs($offset,$pagesize);

		//显示分页详情
		$this->library('page');
		$page = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'type','a'=>'index'));
		$pageinfo = $page->showPage();
		include CUR_VIEW_PATH . "goods_type_list.html";
	}
	//显示添加类型页面
	public function add(){
		include CUR_VIEW_PATH . "goods_type_add.html";
	}
	//类型入库操作
	public function insert(){
		//1.收集表单数据，以关联数组的形式来收集
		$data['type_name'] = trim($_POST['type_name']);
		//2.验证和处理
		if($data['type_name'] === ''){
			$this->jump('index.php?p=admin&c=type&a=add','商品类型名称不能为空');
		}
		//转义处理
		$this->helper('input');
		$data = transferchars($data);
		//3.调用模型完成入库操作并给出提示
		$typeModel = new TypeModel('goods_type');
		if($typeModel->insert($data)){
			$this->jump('index.php?p=admin&c=type&a=index','添加商品类型成功',1);
		}else{
			$this->jump('index.php?p=admin&c=type&a=add','添加商品类型失败');
		}
	}
	//显示编辑类型页面
	public function edit(){
		include CUR_VIEW_PATH . "goods_type_edit.html";
	}
	//类型更新操作
	public function update(){

	}
	//删除类型操作
	public function delete(){

	}
}