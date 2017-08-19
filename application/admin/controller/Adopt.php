<?php
/**
 * Created by PhpStorm.
 * User: xuhui
 * Date: 17-6-27
 * Time: 下午6:32
 */

namespace app\admin\controller;

use app\admin\model\WaitAdopt;
use think\Controller;

class Adopt extends Controller
{
    public function _initialize()
    {
        if (session('adminuser') != 'super') {

            $this->error('请先登录', 'admin/login/login');
        }
    }

    //领养列表
    public function adopt_list($status=0)
    {
        if (!request()->isGet()) $this->error('request_error');
        $list = WaitAdopt::where('status',$status)->order('id asc')->limit(10)->select();
        $this->assign('list',$list);
        return $this->fetch('adopt/adopt_list');
    }


    //删除领养
    public function del_adopt()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $update = WaitAdopt::where('id', $id)->update(['status' => '9']);
        return json($update ? ['success' => '删除成功！'] : ['error' => '删除失败！']);
    }



}