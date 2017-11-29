<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-21 15:25:58
 * @version $Id$
 */
class Controller
{
	//完成操作后的信息提示即跳转
	public function jump($url,$message,$wait = 3)
	{
		if($wait == 0){
			header("Location:$url");
		}else{
			include CUR_VIEW_PATH."message.html";
		}
		exit;
	}

	//加载工具类
	public function library($lib)
	{
		include LIB_PATH."{$lib}.class.php";
	}

	//加载辅助函数文件
	public function helper($helper)
	{
		include HELPER_PATH."{$helper}.php";
	}
}