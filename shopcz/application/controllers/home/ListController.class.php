<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-10-13 11:29:21
 * @version $Id$
 */

class ListController extends BaseController {
    
	public function index()
	{
		$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] + 0 : 0;
		//1.获取URL地址
        $url = $_SERVER['REQUEST_URI'];
        //2.将获取到的地址进行拆分
        $urlInfo = parse_url($url);
        if(isset($urlInfo["query"])){
            parse_str($urlInfo["query"],$flag);
            unset($flag['p']);
            unset($flag['c']);
            unset($flag['a']);
        }
        $i = 0;
        $flagStr='';
        foreach($flag as $k=>$v){
        	$flagStr .= $i == 0?$v : '|'.$v;
        	$i = 1;
        }

		if(!$this->smarty->isCached('list.html',$flagStr)){
			//获取指分类的所有上级分类(面包屑)
			$categoryModel = new CategoryModel('category');
			$upcats = $categoryModel->getSupIds($cat_id);
			//print_r($upcats);
			$this->smarty->assign('upcats',$upcats);
		}
		
		$this->smarty->display('list.html',$flagStr);
	}
}