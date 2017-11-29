<?php

class Upload{
	private $path;   //文件上传目录
	private $max_size; //上传文件大小限制
	private $errno;  //错误信息号
	private $mime = array('image/jpeg','image/png','image/gif');//允许上传的文件类型

	/**
	 * 构造函数,
	 * @access public
	 * @param $path string 上传的路径
	 */
	public function __construct($path = UPLOAD_PATH	){
		$this->path = $path;
		$this->max_size = 10000000;
	}

	/**
	 * 文件上传的方法，分目录存放文件
	 * @access public
	 * @param $file array 包含上传文件信息的数组
	 * @return mixed 成功返回上传的文件名，失败返回false
	 */
	public function up($files){
		/*根据$file的结构来判断是单文件上传还是多文件上传, 如果是多文件, 则把数据转为 二维数组 ,即变为与单文件相同的结构, 然后可以通用处理
		*
		 * */
		//判断数组的类型
		$tmpArr = [];
		@$c1 = reset($files);
		if(!is_array($c1)){
			$tmpArr[] = $files;
		}else{
			$tmpArr = $files;
		}
		@$c2 = reset($c1);
		if(is_array($c2)){//判断c2是否是数组类型
			//如果是, 就说明是3维数组,需要转为2维
			$tmpArr = $this->arr_convert($files);
		}
	    //写一个能够通用的获取上传文件信息的方式
	    $fileNames=[];
	    foreach ($tmpArr as $key => $value) {
	        $name = $value['name'];
	        $tmp_name = $value['tmp_name'];
	        //判断文件是否是通过 HTTP POST 上传，防止恶意欺骗
			/*
			if (! is_uploaded_file($value['tmp_name'])) {
				$this->errno = 5;   //设置错误信息号为5，表示非法上传
				return false;
			}
			*/
	        //判断是否从浏览器端成功上传到服务器端
			if ($value['error'] == 0) {
				# 上传到临时文件夹成功,对临时文件进行处理
				//上传类型判断
				if (!in_array($value['type'], $this->mime)) {
					# 类型不对
					$this->errno = -1; 
					return false;
				}

				//判断文件大小
				if ($value['size'] > $this->max_size) {
					# 大小超出配置文件的中的上传限制
					$this->errno = -2;
					return false;
				}

				//文件重命名,由当前日期 + 随机数 + 后缀名
				$filename = date('YmdHis').uniqid().strrchr($name, '.');
				
				//获取存放上传文件的目录
				$sub_path = date('Ymd').'/';
				if (!is_dir($this->path . $sub_path)) {
					# 不存在该目录，则创建
					mkdir($this->path . $sub_path,'0777',true);
				}
				
				$target = $this->path. $sub_path.$filename;
				
				//准备就绪了，开始上传
	            if(move_uploaded_file($tmp_name,$target)){
	            	$fileNames[] = $sub_path.$filename;
	            } else {
					# 移动失败
					$this->errno = -3;
					return false;
				}
	        } else {
				# 上传到临时文件夹失败，根据其错误号设置错误号
				$this->errno = $files['error'];
				return false;
			}
	    }
	    return $fileNames;
	}

	//通用函数, 把多文件上传的三维数组转二维
	//经过转换之后的数组 和 单文件上传的数组样式是一样的结构
    private function arr_convert($files)
    {
        $newArr = [];
        foreach (reset($files) as $key => $value) {
            foreach ($value as $kk => $vv) {
                $newArr[$kk][$key] = $vv;
            }
        }
        return $newArr;
    }

	/**
	 * 获取错误信息,根据错误号获取相应的错误提示
	 * @access public
	 * @return string 返回错误信息
	 */
	public function error(){
		switch ($this->errno) {
			case -1:
				return '请检查你的文件类型，目前支持的类型有'.implode(',', $this->mime);
				break;
			case -2:
				return '文件超出系统规定的大小，最大不能超过'. $this->max_size;
				break;
			case -3:
				return '文件移动失败';
				break;
			case 1:
				return '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值,其大小为'.ini_get('upload_max_filesize');
				break;
			case 2:
				return '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值,其大小为' . $_POST['MAX_FILE_SIZE'];
				break;
			case 3:
				return '文件只有部分被上传';
				break;
			case 4:
				return '没有文件被上传';
				break;
			case 5:
				return '非法上传';
				break;
			case 6:
				return '找不到临时文件夹';
				break;
			case 7:
				return '文件写入临时文件夹失败';
				break;
			default:
				return '未知错误,灵异事件';
				break;
		}
	}
}

/*
测试代码：单文件上传
<form method='POST' action='upload.php' enctype='multipart/form-data'>
	<input type = 'hidden' name='MAX_FILE_SIZE' value = '2000000' />
	<input type = 'file' name = 'picture' />
	<input type = 'submit' value = '上传' />
</form>

$upload = new upload;

if($file_name = $upload->up($_FILES['picture'])){
	echo '上传成功,文件名为', $file_name;
} else {
	echo '上传失败，错误信息为：',$upload->error();
}
*
/*测试代码：多文件上传
<form action="Upload.class.php" method="POST" enctype="multipart/form-data">
	<label for="上传图片"></label> <input type="file" name='logos[]' /> <br />
	<label for="上传图片"></label> <input type="file" name='logos[]' /> <br />
	<label for="上传图片"></label> <input type="file" name='logos[]' /> <br />
	<input type="submit" name='确定' />
</form>
<?php
$upload = new Upload();
$filename = $upload->up($_FILES);
echo '<pre>'; 
var_dump($filename);
echo '<pre>'; */
