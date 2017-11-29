<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-10-11 19:22:07
 * @version $Id$
 */

class BaseController extends Controller {
    
    function __construct(){
        //引入smarty类
        include APP_PATH.'third_party/smarty/Smarty.class.php';
        //实例化smarty对象
        $this->smarty = new Smarty();
        //设置相关属性
        $this->smarty->template_dir = CUR_VIEW_PATH.'templates';
        $this->smarty->compile_dir = CUR_VIEW_PATH.'templates_c';
        $this->smarty->setLeftDelimiter('<{');
        $this->smarty->setRightDelimiter('}>');

        //开启缓存
        $this->smarty->caching = true;
        //设置缓存目录
        $this->smarty->cache_dir = CUR_VIEW_PATH . 'cache';
        //设置有效期
        $this->smarty->cache_lifetime = 60;
        //$this->smarty->debugging = true;
        
        //获取所有分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->frontCats();
        $this->smarty->assign('cats',$cats);
        //默认不是首页
        $this->smarty->assign('index',false);
    }
}