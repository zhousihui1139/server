<?php
namespace app\admin\validate;
use think\Validate;

class AuthGroup extends Validate
{
	protected $rule=array(
		'title'=>'require|max:25|unique:auth_group',
	);

	protected $message=array(
		'title.require'=>'权限名称不能为空!',
		'title.max'=>'权限名称长度不能超过25个字符!',
		'title.unique'=>'权限名称已存在!',
	);

	protected $scene = array(
		
	);
}