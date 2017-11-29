<?php
namespace app\admin\validate;
use think\Validate;

class Conf extends Validate
{
	protected $rule=array(
		'cnname'=>'require|chs|max:60|unique:conf',
		'enname'=>'require|alpha|max:60|unique:conf',
	);

	protected $message=array(
		'cnname.require'=>'中文名称不能为空!',
		'cnname.chs'=>'中文名称只能是汉字!',
		'cnname.max'=>'中文名称长度不能超过35个字符!',
		'cnname.unique'=>'中文名称已存在!',
		'enname.require'=>'英文名称不能为空!',
		'enname.alpha'=>'英文名称只能是字母!',
		'enname.max'=>'英文名称长度不能超过25个字符!',
		'enname.unique'=>'英文名称已存在!',
	);
}