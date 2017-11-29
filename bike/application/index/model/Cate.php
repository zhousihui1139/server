<?php
namespace app\index\model;
use think\Model;
class Cate extends Model
{
	public function getIndexRec()
    {
        return $this->order('sort desc')->where('rec_index',1)->select();
    } 

    public function getbottomRec()
    {
        return $this->order('sort desc')->where('rec_bottom',1)->select();
    }

    public function getCateInfo($cateid)
    {
    	return $this->field('catename,keywords,desc')->find($cateid);
    	
    }
}