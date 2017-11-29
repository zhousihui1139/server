<?php
namespace app\admin\validate;
use think\Validate;

class Link extends Validate
{
	protected $rule=array(
		'title'=>'require|max:25|unique:link',
		'url'=>'require|max:60|url|unique:link',
		'desc'=>'require',
	);

	protected $message=array(
		'title.require'=>'链接名称不能为空!',
		'title.max'=>'链接名称长度不能超过25个字符!',
		'title.unique'=>'链接名称已存在!',
		'url.require'=>'链接地址不能为空!',
		'url.max'=>'链接名称长度不能超过60个字符!',
		'url.url'=>'链接地址格式错误!',
		'title.unique'=>'链接地址已存在!',
		'desc.require'=>'链接描述不能为空!',
	);

	protected $scene = array(
		'edit'=>['title','url'],
		'add'=>['title','url','desc']
	);
}