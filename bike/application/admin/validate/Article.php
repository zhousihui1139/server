<?php
namespace app\admin\validate;
use think\Validate;


class Article extends Validate
{
	protected $rule=array(
		'title'=>'require|max:50|unique:article',
		'author'=>'require|max:25',
		'content'=>'require'
	);

	protected $message=array(
		'title.require'=>'文章标题不能为空!',
		'title.max'=>'文章标题长度不能超过25个字符!',
		'title.unique'=>'文章标题已存在!',
		'author.require'=>'作者不能为空!',
		'author.max'=>'作者名称长度不能超过25个字符!',
		'content.require'=>'文章内容不能为空!',
	);
}