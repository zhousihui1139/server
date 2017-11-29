<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-22 17:25:18
 * @version $Id$
 */

class CategoryModel extends Model {
    //获取所有的商品分类
    public function getCats()
    {
    	$cats = $this->db->fetchAll();
    	return $this->tree($cats);
    }

    /**
     * 分类重新排序
     * @param  array  $arr [要排序的数组]
     * @param  integer $pid [父id]
     * @return array       [排序好的数组]
     */
    public function tree($arr,$pid = 0,$level = 0){
        $res = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == $pid) {
                //找到后先保存，然后递归查找
                $v['level'] = $level;
                $res[] = $v;
                $temp = $this->tree($arr,$v['cat_id'],$level+1);
                if(!empty($temp)){
                    $res = array_merge($res,$temp);
                }
            }
        }
        return $res;
    }

    /**
     * 获取指定分类所有的后代分类id，包括它自己
     * @param  int $cat_id [分类id]
     * @return array       [所有后代分类id]
     */
    public function getSubIds($cat_id){
        $cats = $this->db->fetchAll();
        $cats = $this->tree($cats,$cat_id); //二维数组
        $res = array();
        foreach ($cats as $v) {
            $res[] = $v['cat_id'];
        }
        //将自己也加到数组中
        $res[] = $cat_id;
        return $res;
    }

    /**
     * [构造嵌套结构的多维数组]
     * @param  [array]  $arr [要处理的二维数组]
     * @param  integer $pid 
     * @return [array]       [处理后的多维数组]
     */
    public function child($arr,$pid = 0){
        $res = [];
        foreach($arr as $val){
            if($val['parent_id'] == $pid){
                $val['child'] = $this->child($arr,$val['cat_id']);
/*                if($val['child'] == null){
                    unset($val['child']);
                }*/
                $res[]=$val;
            }
        }
        return $res;
    }

    /**
     * 前端三级分类获取
     * @return [type] [description]
     */
    public function frontCats()
    {
        $cats = $this->db->fetchAll();
        return $this->child($cats);
    }

    /**
     * 获取指定分类所有的上级分类,包括它自己
     * @param  [type] $cats   [description]
     * @param  [type] $cat_id [description]
     * @return [type]         [description]
     */
    public function superior($cats,$cat_id)
    {
        $sup = [];
        foreach ($cats as $v) {
            if($v['cat_id'] == $cat_id){
                $sup[] = $v;
                $temp = $this->superior($cats,$v['parent_id']);
                if(!empty($temp)){
                    $sup = array_merge($temp,$sup);
                }
            }
        }
        return $sup;
    }

    public function getSupIds($cat_id)
    {
        $cats = $this->db->fetchAll();
        $upcats = $this->superior($cats,$cat_id);
        return $upcats;
    }
}