<?php
namespace app\common\model;
use think\Model;
class AdminUser extends Model
{
	protected $autoWriteTimestamp = true;
	
	protected function SetPasswordAttr($value)
	{
		return md5($value.'_#singwa');
	}

	public function add($data)
	{
		if(!is_array($data)){
			exception('传递数据不合法');
		}
        $data['status'] = 1;
		$this->allowField(true)->save($data);
		return $this->id;
	}
}