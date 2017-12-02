<?php
namespace app\common\validate;

use think\Validate;
class AdminUser extends Validate
{
	protected $rule = array(
		'username' => "require|max:20|unique:admin_user", 
		'password' => "require|max:20|min:6", 
	);

	protected $message = array(
		'username:require' => "用户名不能为空",
		'username:max' => "用户名长度不能超过20字符",
		'username:unique' => "用户名已存在",
		'password:require' => "密码不能为空",
		'password:max' => "密码长度不能超过20字符",
		'password:min' => "密码长度不能少于6个字符",
	);
}