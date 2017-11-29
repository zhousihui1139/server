<?php
namespace app\admin\validate;
use think\Validate;


class Admin extends Validate
{
	protected $rule=array(
		'name'=>'require|unique:admin',
		'password'=>'require|regex:/^\w{6,}$/'
	);

	protected $message=array(
		'name.require'=>'管理员名称不能为空',
		'name.unique'=>'管理员名称已存在',
		'password.require'=>'管理员密码不能为空',
		'password.regex'=>'密码长度必须大于等于6位',
	);

	protected $scene = array(
		'editname'=>'name',
		'login'=>[
			'name'=>'require',
			'password'=>'require',
		],
	);
}