<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-22 15:44:41
 * @version $Id$
 */
//商品分类控制器
class CategoryController extends BaseController {
    
    //显示分类
    public function index()
    {
    	//获取所有分类
    	$category = new CategoryModel('category');
    	$cats = $category->getCats();

    	//载入分类页面
    	include CUR_VIEW_PATH."cat_list.html";
    }

    //显示添加分类页面
    public function add()
    {
    	//获取所有分类
    	$category = new CategoryModel('category');
    	$cats = $category->getCats();
    	//载入添加分类页面
    	include CUR_VIEW_PATH."cat_add.html";
    }

    //分类入库
    public function insert()
    {
    	//1.收集表单数据,以关联数组的形式收集
    	$data['cat_name'] = trim($_POST['cat_name']);
    	$data['parent_id'] = $_POST['parent_id'];
    	$data['unit'] = trim($_POST['unit']);
    	$data['sort_order'] = $_POST['sort_order'];
    	$data['cat_desc'] = $_POST['cat_desc'];
    	$data['is_show'] = $_POST['is_show'];

        //转义处理
        $this->helper('input');
        $data = transferchars($data);

    	//2.验证和处理
    	if($data['cat_name']===''){
    		$this->jump('index.php?p=admin&c=category&a=add','分类名称不能为空');
    	}
    	//3.调用模型完成入库操作并给出提示信息
    	$category = new CategoryModel('category');
    	if($category->insert($data)){
    		$this->jump('index.php?p=admin&c=category&a=index','添加分类成功',1);
    	}else{
    		$this->jump('index.php?p=admin&c=category&a=add','添加分类失败');
    	}
    }

    //显示编辑分类页面
    public function edit()
    {
    	$cat_id = $_GET['cat_id'] + 0; 
    	$category = new CategoryModel('category');
    	$cats = $category->getCats();
    	$cat = $category->getRow(['where'=>"`cat_id`=$cat_id"]);
    	include CUR_VIEW_PATH."cat_edit.html";
    }

    //分类更新
    public function update()
    {
    	//1.收集表单数据,以关联数组的形式收集
    	$data['cat_name'] = trim($_POST['cat_name']);
        $data['parent_id'] = $_POST['parent_id'];
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = $_POST['sort_order'];
        $data['cat_desc'] = $_POST['cat_desc'];
        $data['is_show'] = $_POST['is_show'];
    	$data['cat_id'] = $_POST['cat_id'];
    	$condition = "cat_id={$data['cat_id']}";

        //转义处理
        $this->helper('input');
        $data = transferchars($data);

    	//2.验证和处理
    	if($data['cat_name']===''){
    		$this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'分类名称不能为空');
    	}

    	//3.调用模型完成更新操作并给出提示信息
    	$category = new CategoryModel('category');
		//判断要更新的上级分类是否有效(不能将当前分类及其子级分类作为上级分类)
    	$ids = $category->getSubIds($data['cat_id']);
    	if(in_array($data['parent_id'], $ids)){
    		$this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'不能将当前分类及其子级分类作为上级分类');
    	}
    	if($category->update($data,$condition)){
    		$this->jump('index.php?p=admin&c=category&a=index','编辑分类成功',1);
    	}else{
    		$this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'编辑分类失败');
    	}
    }

    //删除分类
    public function delete()
    {
        //1.获取cat_id
        $cat_id = intval($_GET['cat_id']);
        //2.调用模型进行删除
        $category = new CategoryModel('category');
        //删除前判断预先删除分类是否有后代分类,如果有,则不允许删除
        $ids = $category->getSubIds($cat_id);
        if(count($ids)>1){
            $this->jump("index.php?p=admin&c=category&a=index",'删除分类失败,请先删除子分类');
        }
        if($category->delete("cat_id=$cat_id")){
            $this->jump('index.php?p=admin&c=category&a=index','删除分类成功',1);
        }else{
            $this->jump("index.php?p=admin&c=category&a=index",'删除分类失败');
        }
    }
}