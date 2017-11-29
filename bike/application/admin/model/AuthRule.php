<?php
namespace app\admin\model;
use think\Model;
class AuthRule extends Model
{
   public function getRules()
   {
       $arr = $this->where('status',1)->select();
       return $this->getSub($arr);
   }

   public function getSub($arr,$pid=0)
   {
   		$getSub = [];
   		foreach ($arr as $v) {
   			if($v['pid'] == $pid){
   				$getSub[] = $v;
   				$tmp = $this->getSub($arr,$v['id']);
   				if(!empty($tmp)){
   					$getSub = array_merge($getSub,$tmp);
   				}
   			}
   		}
   		return $getSub;
   }

   public function getSubIds($id)
   {
      $arr = $this->field('id,pid')->where('status',1)->select();
      $Sup = $this->getSub($arr,$id);
      $ids = [];
      foreach ($Sup as $v) {
        $ids[] = $v['id'];
      }
      return implode(',',$ids);
   }

   public function getSupIds($id)
   {
      $arr = $this->field('id,pid')->where('status',1)->select();
      $pid = $this->field('pid')->find($id);
      $Supb = $this->getSup($arr,$pid['pid']);
      $ids = [];
      foreach ($Supb as $v) {
        $ids[] = $v['id'];
      }
      return implode(',',$ids);
   }

  public function getSup($arr,$pid)
  {
    $getSup = [];
    foreach ($arr as $v) {
      if($v['id'] == $pid){
        $getSup[] = $v;
        $tmp = $this->getSup($arr,$v['pid']);
        if(!empty($tmp)){
          $getSup = array_merge($getSup,$tmp);
        }
      }
    }
    return $getSup;
  }
  public function tree($arr,$pid=0)
   {
      $tree = [];
      foreach ($arr as $v) {
        if($v['pid'] == $pid){
          $v['child'] = $this->tree($arr,$v['id']);
          if(empty($v['child'])){
            unset($v['child']);
          }
          $tree[] = $v;
        }
      }
      return $tree;
   }
}