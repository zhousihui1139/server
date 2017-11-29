<?php
namespace app\index\controller;
use think\Controller;
class Page extends Base
{
    public function index()
    {
    	$cate = db('cate')->find(input('cateid'));
    	$this->assign('cate',$cate);
        return $this->fetch('page');
    }
}
