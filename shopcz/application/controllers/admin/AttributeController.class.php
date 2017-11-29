<?php
//后台商品属性管理
class AttributeController extends Controller {
	//显示属性
	public function index(){
		//获取所有商品类型
		$typeModel = new TypeModel('goods_type');
		$types = $typeModel->getAll();
		//获取当前类型下所有的属性
		$type_id = isset($_GET['type_id'])?$_GET['type_id']+0:0;
		$attrModel = new AttributeModel('attribute');
		$pagesize = 10;
		$current = isset($_GET['page'])?$_GET['page']:1;
		$offset = ($current - 1) * $pagesize;
		$attrs = $attrModel->getPageAttrs($type_id,$offset,$pagesize);
		//获取分页
		$this->library('Page');
		$total = $type_id==0?$attrModel->total():$attrModel->total(['where'=>"type_id=$type_id"]);
		$page = new Page($total,$pagesize,$current,'index.php',['p'=>'admin','c'=>'attribute','a'=>'index','type_id'=>"$type_id"]);
		$pageinfo = $page->showPage();
		include CUR_VIEW_PATH . "attribute_list.html";
	}

	//显示添加属性页面
	public function add(){
		//获取所有商品类型
		$typeModel = new TypeModel('goods_type');
		$types = $typeModel->getAll();
		include CUR_VIEW_PATH . "attribute_add.html";
	}

	//属性入库操作
	public function insert(){
		//1.收集表单数据，以关联数组的形式来收集
		$data['attr_name'] = trim($_POST['attr_name']);
		$data['attr_type'] = $_POST['attr_type'];
		$data['attr_input_type'] = $_POST['attr_input_type'];
		$data['type_id'] = $_POST['type_id'];
		$data['attr_value'] = isset($_POST['attr_value'])?$_POST['attr_value']:'';
		//2.验证和处理
		if($data['attr_name'] === ''){
			$this->jump('index.php?p=admin&c=attribute&a=add','属性名称不能为空');
		}
		if($data['type_id'] == 0){
			$this->jump('index.php?p=admin&c=attribute&a=add','必须要选择商品类型');
		}
		//转义处理
		$this->helper('input');
		$data = transferchars($data);
		//3.调用模型完成入库操作并给出提示
		$attribute = new AttributeModel('attribute');
		if($attribute->insert($data)){
			$this->jump("index.php?p=admin&c=attribute&a=index&type_id={$data['type_id']}",'添加属性成功',1);
		}else{
			$this->jump('index.php?p=admin&c=attribute&a=add','添加属性失败');
		}
	}
	//显示编辑属性页面
	public function edit(){
		$attr_id = $_GET['attr_id'];
		$attrModel = new AttributeModel('attribute');
		//获取所有属性及对应分类名
		$attrs = $attrModel->getAttrType();
		$attr_info = $attrModel->getRow(['where'=>"attr_id=$attr_id"]);

		include CUR_VIEW_PATH . "attribute_edit.html";
	}
	//属性更新操作
	public function update(){
		if($_POST['act'] == 'update'){
			//获取表单数据
			$attr_id = $_POST['attr_id'] + 0;
			$data['attr_name'] = trim($_POST['attr_name']);
			$data['type_id'] = $_POST['type_id'] + 0;
			$data['attr_type'] = $_POST['attr_type'] + 0;
			$data['attr_input_type'] = $_POST['attr_input_type'] + 0;
			if($data['attr_input_type']>0){
				$data['attr_value'] = trim($_POST['attr_values']);
			}
			//验证处理
			if(empty($data['attr_name'])){
				$this->jump("index.php?p=admin&c=attribute&a=edit",'属性名称不能为空');
			}
			if($data['type_id'] == 0){
				$this->jump("index.php?p=admin&c=attribute&a=edit",'请选择有效商品分类');
			}
			$this->helper('input');
			$data = transferchars($data);
			//调用模型,更新数据
			$attributeModel = new AttributeModel('attribute');
			if($attributeModel->update($data,"attr_id=$attr_id")){
				//更新成功
				$this->jump("index.php?p=admin&c=attribute&a=index",'属性更新成功',1);
			}else{
				$this->jump("index.php?p=admin&c=attribute&a=edit",'属性更新失败');
			}
		}
	}
	//删除属性操作
	public function delete(){
		$attr_id = $_GET['attr_id'] + 0;
		$attrModel = new AttributeModel('attribute');
		if($attributeModel->update($data,"attr_id=$attr_id")){
			//删除成功
			$this->jump("index.php?p=admin&c=attribute&a=index",'属性删除成功',1);
		}else{
			$this->jump("index.php?p=admin&c=attribute&a=index",'属性删除失败');
		}
	}

	//获取指定类型下的属性
	public function getAttrs()
	{
		$type_id = $_GET['type_id'] + 0;
		//调用模型完成具体操作
		$attrModel = new AttributeModel('attribute');
		$attrs = $attrModel->getAttrsTable($type_id);
		echo <<<STR
		<script type=text/javascript>
			window.parent.document.getElementById('tbody-goodsAttr').innerHTML = "$attrs";
		</script>
STR;
	}
}