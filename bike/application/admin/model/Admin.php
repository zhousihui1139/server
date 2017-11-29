<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    protected function setPasswordAttr($pwd)
    {
    	return md5($pwd);
    }

    public function login($data)
    {
    	$admin = self::getByName($data['name']);
    	if($admin){
    		if($admin['password'] == md5($data['password'])){
    			return array('id'=>$admin['id'],'name'=>$admin['name']); //用户名与密码均正确
    		}else{
    			return 2; //密码错误
    		}
    	}else{
    		//用户名不存在
    		return 1;
    	}
    }
}