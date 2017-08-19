<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/21 0021
 * Time: 19:41
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Admin as AdminModel;

class Login extends Controller
{

    /**
     * 通过session判断是否登状态
     */

    public function login()
    {
        if (!session('admin_user')) {
            if (request()->isPost()) {
                $date = input();
                var_dump($date);
                $validate = validate('admin');
                if (!$validate->scene('longin')->check($date)) {
                    $this->error($validate->getError());
                } else {
                    $find = AdminModel::where(
                        [
                            'username' => $date['username'],
                            'password' => $date['password']
                        ]
                    )->find();

                    if ($find) {
                        session('adminuser', 'super');
                        $this->success($date['username'], 'admin/index/index');
                    } else {
                        $this->error('用户名或密码错误');
                    }
                };
            } else {
                return $this->fetch('index/login');
            }
        } else {
            $this->error('您已登录', 'admin/article/article_list');
        }
    }
}