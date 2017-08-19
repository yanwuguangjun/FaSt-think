<?php
/**
 * Created by PhpStorm.
 * User: xuhui
 * Date: 17-6-27
 * Time: 下午6:33
 */

namespace app\admin\controller;

use app\admin\model\SociallyUsefulActivity;
use think\Controller;

class Activity extends Controller
{

    public function _initialize()
    {
        if (session('adminuser') != 'super') {

            $this->error('请先登录', 'admin/login/login');
        }
    }

    /**
     * @param null
     * @return
     */
    public function activity_list($status = 0)
    {
        if (!request()->isGet()) $this->error('request_error');
        $list = SociallyUsefulActivity::where('status', $status)->limit(10)->select();
        $this->assign('list', $list);
        return $this->fetch('activity/activity_list');
    }

    /**
     * @return \think\response\Json
     * 推荐到首页
     * @param int
     */
    public function activity_page_one()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $update = SociallyUsefulActivity::where('id', $id)->update(['status' => '1']);
        return json($update ? ['success' => '推荐至首页成功！'] : ['error' => '推荐失败！']);
    }

    /**
     * 设置到banner
     */
    public function banner()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $update = SociallyUsefulActivity::where('id', $id)->update(['status' => '1']);
        return json($update ? ['success' => '加入banner成功！'] : ['error' => '添加失败！']);
    }

    //删除活动
    public function del_activity()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $update = SociallyUsefulActivity::where('id', $id)->update(['status' => '9']);
        return json($update ? ['success' => '删除成功'] : ['error' => '删除失败']);
    }


    /**
     * 查看活动
     */
    public function show_activity()
    {
        if (!request()->isGet()) $this->error('request_error');
        $id = $_GET['id'];
        $activity = SociallyUsefulActivity::get($id);
        return json($activity);
    }
}