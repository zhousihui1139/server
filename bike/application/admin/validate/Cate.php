<?php
namespace app\admin\validate;
use think\Validate;


class Cate extends Validate
{
	protected $rule=array(
		'catename'=>'require|max:25|unique:cate',
	);

	protected $message=array(
		'catename.require'=>'栏目名称不能为空!',
		'catename.max'=>'栏目名称长度不能超过20个字符!',
		'catename.unique'=>'栏目名称已存在!',
	);
}