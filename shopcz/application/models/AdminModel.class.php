<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-21 17:40:34
 * @version $Id$
 */
class AdminModel extends Model {
    
    //验证用户名和密码
    public function userCheck($username,$password)
    {
    	return $this->getRow(['where'=>"admin_name='$username' AND password='$password'",'limit'=>'1']);
    }

    public function getAdmins()
    {
    	return $this->getAll();
    }
}