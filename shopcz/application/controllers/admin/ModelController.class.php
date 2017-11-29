<?php
//后台商品分类管理
class CategoryController extends Controller {
	//显示分类
	public function index(){
		include CUR_VIEW_PATH . "cat_list.html";
	}
	//显示添加分类页面
	public function add(){
		include CUR_VIEW_PATH . "cat_add.html";
	}
	//分类入库操作
	public function insert(){
		//1.收集表单数据，以关联数组的形式来收集
		
		//2.验证和处理
		
		//3.调用模型完成入库操作并给出提示
		
	}
	//显示编辑分类页面
	public function edit(){
		include CUR_VIEW_PATH . "cat_edit.html";
	}
	//分类更新操作
	public function update(){

	}
	//删除分类操作
	public function delete(){

	}
}