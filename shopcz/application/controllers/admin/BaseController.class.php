<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-23 14:16:36
 * @version $Id$
 */

class BaseController extends Controller {
    
    public function __construct()
    {
    	$this->LoginCheck();
    }

    //验证用户登录
    public function LoginCheck()
    {
    	if(!isset($_SESSION['admin'])){
    		$this->jump('index.php?p=admin&c=login&a=login','请先登录');
    	}
    }
}