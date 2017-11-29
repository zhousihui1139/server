<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-28 11:55:18
 * @version $Id$
 */

class GoodsModel extends Model {
	//商品图片上传处理
    public function imgUpload($post,$files,$objController)
    {
    	$data[]='';
    	if(!empty($files['goods_img']['name'])){
			$objController->library('Upload');
			$upload = new Upload();
			$upfiles[] = $files['goods_img'];
			if($goods_imgs_1 = $upload->up($upfiles)){
				//成功
				$data['goods_img'] = implode(PHP_EOL,$goods_imgs_1);
			}else{
				//失败
				$objController->jump('index.php?p=admin&c=goods&a=add',$upload->error(),100);
			}
		}
		if($post['goods_img_url'] != '商品图片外部URL'){
			$urls = implode(PHP_EOL,$post['goods_img_url']);
			$goods_imgs_2 = [];
			//遍历所有URL,并通过URL下载图片到上传目录
			foreach ($urls as $url) {
				if(!$goods_imgs_2[] = $this->grabImage($url,UPLOAD_PATH.date('Ymd').'/')){
					//失败
					$objController->jump('index.php?p=admin&c=goods&a=add','URL方式上传图片失败');
				}
			}
			//全部下载成功
			$data['goods_img'] .= PHP_EOL . implode(PHP_EOL,$goods_imgs_2);
		}

		//对上传缩略图的处理
		if($post['auto_thumb'] == 1){
			$data['goods_thumb'] = $this->autoThumb($data['goods_img'],$objController);
		}else{
			$data['goods_thumb'] = $this->handThumb($post,$files,$objController);
		}
		
		return $data;
    }

    //以URL方式获取图片,并下载到指定目录
    function grabImage($url,$path) {
		if ($url == ""){
			return false;
		}
		//如果$url地址为空，直接退出
		
		$ext = strrchr($url, ".");
		//得到$url的图片格式
		
		if($ext != ".gif" || $ext != ".jpg" || $ext != ".png"){return false;}
		//如果图片格式不为.gif或者.jpg或者.png，直接退出
		$filename = date("Ymd"). uniqid() . $ext;//重命名图片
		$target = $path . $filename;
		ob_start();//打开缓存输出
		readfile($url);//输出图片文件
		$img = ob_get_contents();//得到浏览器输出
		ob_end_clean();//清除输出并关闭
		$fp2 = @fopen($target, "a");
		fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
		fclose($fp2);
		return $target;//返回新的文件名
	}

	public function autoThumb($goodsimg,$objController)
	{
		//自动生成缩略图到对应已上传商品文件夹下
		$thumbs = [];
		$objController->library('Image');
		$img = new Image();
		$goodsimg = explode(PHP_EOL, $goodsimg);
		foreach ($goodsimg as $image) {
			$thumb_name = $img->thumbnail(UPLOAD_PATH.$image,50,50,UPLOAD_PATH.date('Ymd').'/');
			$thumbs[] = $thumb_name;
		}
		$thumbstr = implode(PHP_EOL,$thumbs);
		return $thumbstr;
	}

	public function handThumb($post,$files,$objController)
	{
		//手动上传缩略图
		$thumbstr = '';
		if(!$post['goods_thumb_url'] == ''){
			//通过URL上传的缩略图
			$urls = implode(PHP_EOL,$post['goods_thumb_url']);
			foreach ($urls as $url) {
				if(!$goods_imgs[] = $this->grabImage($url,UPLOAD_PATH.date('Ymd').'')){
					//失败
					$objController->jump('index.php?p=admin&c=goods&a=add','URL方式上传图片失败');
				}
			}
			$thumbstr = implode(PHP_EOL,$goods_thumb_imgs);
		}
		if(!$files['goods_thumb']['name'] == ''){
			//选择图片上传的缩略图
			$objController->library('Upload');
			$upload = new Upload();
			$upfiles[] = $files['goods_thumb'];
			if($goods_imgs = $upload->up($upfiles)){
				//成功
				$thumbstr .= PHP_EOL.implode(PHP_EOL,$goods_thumb);					
			}else{
				//失败
				$objController->jump('index.php?p=admin&c=goods&a=add',$upload->error());
			}
		}
		return $thumbstr;
	}

	//获取推荐商品
	public function getBestGoods()
	{
		return $this->getAll(['colnum'=>['goods_id','goods_name','good_img','shop_price'],'where'=>'is_best=1 AND is_onsale=1','order by'=>'goods_id DESC','limit'=>'4']);
	}
}