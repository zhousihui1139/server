<?php
namespace app\common\model;
class ArrayDeal 
{
  /**
   * 获取传入id的所有后代数据(不包含自己)
   * @param  [array]  $arr [总数组]
   * @param  integer $id [指定id]
   * @return [二维数组]       [id对应数据的所有后代数据]
   */
   public function getSub($arr,$id=0,$tmp_level=0)
   {
   		$getSub = [];
   		foreach ($arr as $v) {
   			if($v['pid'] == $id){
          $v['tmp_level'] = $tmp_level;
   				$getSub[] = $v;
   				$tmp = $this->getSub($arr,$v['id'],$tmp_level+1);
   				if(!empty($tmp)){
   					$getSub = array_merge($getSub,$tmp);
   				}
   			}
   		}
   		return $getSub;
   }

  /**
   * 获取传入id对应所有后代id(包含自己)
   * @param  [array]  $arr      [总数组]
   * @param  [type]  $id       [指定id]
   * @param  boolean $is_array [返回id是否为数组;默认为二位数组;false时为以','分隔的字符串]
   * @return [mix]            [返回ids;数组或字符串]
   */
   public function getSubIds($arr,$id,$is_array=true)
   {
      $Sub = $this->getSub($arr,$id);
      $ids = [];
      foreach ($Sub as $v) {
        $ids[] = $v['id'];
      }
      $ids[]=$id+0;
      if($is_array){
        return $ids;
      }
      return implode(',',$ids);
   }

  /**
   * 获取传入id对应所有祖辈id
   * @param  [array]  $arr      [总数组]
   * @param  [type]  $id       [指定id]
   * @param  boolean $is_array [返回id是否为数组;默认为二位数组;false时为以','分隔的字符串]
   * @return [mix]            [返回ids;数组或字符串]
   */
   public function getSupIds($arr,$id=0,$is_array=true)
   {
      $Sup = $this->getSup($arr,$id);
      $ids = [];
      foreach ($Sup as $v) {
        $ids[] = $v['id'];
      }
      return implode(',',$ids);
   }

  /**
   * 获取传入id的所有祖辈数据包含自己
   * @param  [array]  $arr [总数组]
   * @param  integer $id [指定id]
   * @return [二维数组]       [id对应数据的所有祖辈数据包含自己]
   */
  public function getSup($arr,$id)
  {
    $getSup = [];
    foreach ($arr as $v) {
      if($v['id'] == $id){
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
