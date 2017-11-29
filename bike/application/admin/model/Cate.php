<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    public function getCate()
    {
    	$cates = $this->order('sort desc')->select();
    	return $this->sortarr($cates);
    }

    public function sortarr($arr,$pid=0,$level=0)
    {
    	$tree = [];
    	foreach($arr as $v){
    		if($v['pid'] == $pid){
    			$v['level'] = $level;
    			$tree[] = $v;
    			$tmp = $this->sortarr($arr,$v['id'],$level+1);
                if(!empty($tmp)){
                    $tree = array_merge($tree,$tmp);
                }
    		}
    	}
    	return $tree;
    }

    /**
     * [getSubIds description]
     * @param  [type] $arr [description]
     * @param  [type] $id  [description]
     * @return [type]      [description]
     */
    public function getSubIds($arr,$id)
    {
        $ids = [];
        foreach($arr as $v){
            if($v['pid'] == $id){
                $ids[] = $v['id'];
                $tmp = $this->getSubIds($arr,$v['id']);
                if(!empty($tmp)){
                    $ids = array_merge($ids,$tmp);
                }
            }
        }
        return $ids;
    }

    public function getTypeNameById($id)
    {
        $cateinfo = $this->find($id)->toArray();
        $types = ['1'=>'文章列表','2'=>'单页','3'=>'图片列表'];
        return $types[$cateinfo['type']];
    }
}