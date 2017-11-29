<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-25 16:43:43
 * @version $Id$
 */
function transferchars($data)
{
	if(empty($data)){
		return $data;
	}
	//中高级的写法
	return is_array($data)?array_map('transferchars',$data):htmlspecialchars(addslashes($data));
	//初级写法
	/*if(is_array($data)){
		//数组
		foreach ($data as $k => $v) {
			$data[$k] = transferchars($v);
		}
		return $data;
	}else{
		//单个变量
		return htmlspecialchars(addslashes($data));
	}*/
}