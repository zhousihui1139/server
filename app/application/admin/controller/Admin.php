<?php
namespace app\admin\controller;
use think\Controller;
class Admin extends Controller
{
    public function lst()
    {
        return $this->fetch();
    }

    public function add()
    {
        //判断是否有post表单数据提交
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('AdminUser');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            try{
                $id = model('AdminUser')->add($data);
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
            if($id){
                $this->success('id='.$id.'的管理员新增成功');
            }else{
                $this->error('error');
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        return $this->fetch();
    }
    
    public function del()
    {
        return $this->fetch();
    }
}
