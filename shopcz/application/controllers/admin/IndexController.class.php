<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-21 14:22:37
 * @version $Id$
 */

class IndexController extends BaseController{
    
    public function index()
    {
    	//载入视图
    	include CUR_VIEW_PATH.'index.html';
    }

    public function top()
    {
    	//载入视图
    	include CUR_VIEW_PATH.'top.html';
    }

    public function menu()
    {
    	//载入视图
    	include CUR_VIEW_PATH.'menu.html';
    }

    public function drag()
    {
    	//载入视图
    	include CUR_VIEW_PATH.'drag.html';
    }

    public function main()
    {
    	//载入视图
    	include CUR_VIEW_PATH.'main.html';
    }
}