<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{
	protected static function init(){
		Article::event('before_insert', function ($data) {
            //插入数据时 若有图片 则先上传图片
			if($_FILES['thumb']['tmp_name']){
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $data->thumb = $info->getSaveName();
                }
            }
		});

		Article::event('before_update', function ($data) {
			//若重新上传图片
			if($_FILES['thumb']['tmp_name']){
				//获取图片资源
                $file = request()->file('thumb');
                //获取数据库原记录
                $article = Article::find($data->id);
                //拼接路径
                $path = ROOT_PATH.'public'.DS.'uploads/'.$article->thumb;
                if(file_exists($path)){
                	//根据路径删除原图片
                	@unlink($path);
                }
                //上传新图片
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $data['thumb'] = $info->getSaveName();
                }
            }
		});

		Article::event('before_delete', function ($data) {
            $article = Article::find($data['id']);
            $path = ROOT_PATH.'public'.DS.'uploads/'.$article->thumb;
            if(file_exists($path)){
            	@unlink($path);
            }
		});
	}
}