<?php
/**
 * Created by PhpStorm.
 * User: xuhui
 * Date: 17-6-27
 * Time: 下午6:30
 */

namespace app\admin\controller;
use app\admin\model\Lost as LostModel;
use think\Controller;

class Lost extends Controller
{
    public function _initialize()
    {
        if (session('adminuser') != 'super') {

            $this->error('请先登录', 'admin/login/login');
        }
    }

    public function lost_lsit($status){
        $list = LostModel::where('status',$status)
            ->order('id asc')->field('id,title')
            ->limit(10)->select();
        $this->assign('list',$list);
        return $this->fetch('lost/lost_list');
    }

    //删除丢失
    public function del_Lost()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $update = LostModel::where('id',$id)->update(['status'=>'9']);
        return json($update ? ['success'=>'删除丢失成功！']:['error'=>'删除丢失失败']);

    }

}