<?php
//后台商品品牌管理
class BrandController extends Controller {
	//显示品牌
	public function index(){
		//分页获取品牌
		$brandModel = new BrandModel('brand');
		$this->helper('input');
		$brand_name = isset($_GET['brand_name'])?transferchars(trim($_GET['brand_name'])):null;
		$total = is_null($brand_name) ? ($brandModel->total()) : ($brandModel->total(['where'=>"`brand_name` like '%{$brand_name}%'"]));
		$pagesize = 20;
		$current = isset($_GET['page'])?$_GET['page']:1;
		$offset = ($current - 1) * $pagesize;
		$brands = $brandModel->getAll(['where'=>"`brand_name` like '%{$brand_name}%'",'limit'=>"$offset,$pagesize"]);
		//获取分页
		$this->library('Page');
		if(!is_null($brand_name)){
			$page = new Page($total,$pagesize,$current,'index.php',['p'=>'admin','c'=>'brand','a'=>'index','brand_name'=>$brand_name]);
		}else{
			$page = new Page($total,$pagesize,$current,'index.php',['p'=>'admin','c'=>'brand','a'=>'index']);
		}
		$pageinfo = $page->showPage();
		include CUR_VIEW_PATH . "brand_list.html";
	}
	//显示添加品牌页面
	public function add(){
		include CUR_VIEW_PATH . "brand_add.html";
	}
	//品牌入库操作
	public function insert(){
		//1.收集表单数据，以关联数组的形式来收集
		$data['brand_name'] = trim($_POST['brand_name']);
		$data['url'] = trim($_POST['url']);
		$data['brand_desc'] = trim($_POST['brand_desc']);
		$data['sort_order'] = trim($_POST['sort_order']) + 0;
		$data['is_show'] = trim($_POST['is_show']) + 0;
		//2.验证和处理
		if(empty($data['brand_name'])){
			$this->jump("index.php?p=admin&c=brand&a=add","商品品牌名称不能为空");
		}
		if(empty($_FILES['logo']['name'])){
			$this->jump("index.php?p=admin&c=brand&a=add","请上传品牌logo");
		}
		//转义处理
		$this->helper('input');
		$data = transferchars($data);
		//处理文件上传
		$this->library('Upload');
		$upload = new Upload();
		if($filename = $upload->up($_FILES['logo'])){
			$data['logo'] = $filename['0'];
			$brandModel = new BrandModel('brand');

			//3.调用模型完成入库操作并给出提示
			if($brandModel->insert($data)){
				$this->jump("index.php?p=admin&c=brand&a=index","添加商品品牌成功",1);
			}else{
				$this->jump("index.php?p=admin&c=brand&a=add","添加商品品牌失败");
			}
		}else{
			$this->jump("index.php?p=admin&c=brand&a=add",$upload->error());
		}
	}

	//显示编辑品牌页面
	public function edit(){
		//获取当前品牌信息
		$brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] + 0 : 0;
		$brandModel = new BrandModel('brand');
		$brand_info = $brandModel->getRow(['where'=>"`brand_id`=$brand_id"]);

		include CUR_VIEW_PATH . "brand_edit.html";
	}

	//品牌更新操作
	public function update(){
		//获取表单数据
		$data['brand_name'] = trim($_POST['brand_name']);
		$data['url'] = trim($_POST['url']);
		$data['brand_desc'] = trim($_POST['brand_desc']);
		$data['sort_order'] = trim($_POST['sort_order']) + 0;
		$data['is_show'] = trim($_POST['is_show']) + 0;
		$brand_id = $_POST['brand_id'];
		//2.验证和处理
		if(empty($data['brand_name'])){
			$this->jump("index.php?p=admin&c=brand&a=edit","商品品牌名称不能为空");
		}
		//转义
		$this->helper('input');
		$data = transferchars($data);
		//若重新上传图片则删除原上传图片,重新上传
		
		if($_FILES['logo']['name']){
			$logo = $_POST['brand_logo'];
			@unlink(UPLOAD_PATH.$logo);
			$this->library('Upload');
			$upload = new Upload();
			if($filenames = $upload->up($_FILES)){
				$data['logo'] = $filenames['0'];
			}else{
				 $this->jump('index.php?p=admin&c=brand&a=edit',$upload->error());
			}
		}else{
			$data['logo'] = $_POST['brand_logo'];
		}
		//3.更新数据记录
		$brandModel = new BrandModel('brand');
		if($brandModel->update($data,"brand_id=$brand_id")){
			$this->jump("index.php?p=admin&c=brand&a=index","更新商品品牌成功",1);
		}else{
			$this->jump("index.php?p=admin&c=brand&a=add","更新商品品牌失败");
		}
	}
	//删除品牌操作
	public function delete(){
		isset($_GET['brand_id'])?($brand_id = $_GET['brand_id'] + 0):$this->jump("index.php?p=admin&c=brand&a=index","未获取到有效品牌id,无法进行删除");
		//先删除欲删除品牌的logo图片
		$brandModel = new BrandModel('brand');
		$brand_info = $brandModel->getRow(['where'=>"brand_id=$brand_id"]);
		$logo = $brand_info['logo'];
		@unlink(UPLOAD_PATH.$logo);
		//删除记录
		if ($brandModel->delete("brand_id=$brand_id")) {
			$this->jump("index.php?p=admin&c=brand&a=index","删除商品品牌成功",1);
		}else{
			$this->jump("index.php?p=admin&c=brand&a=index","删除商品品牌失败");

		}
	}
}