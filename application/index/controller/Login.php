<?php
namespace app\index\controller;

use app\index\Model\MoroselyOne;
use think\Controller;
use think\Request;
use think\Db;
use app\index\controller\Common;   //机构超级管理员
use app\index\model\Charity;   //机构超级管理员
use app\index\model\CharityUser;  //机构管理员
use app\index\model\Morosely;
use app\index\model\MoroselyCore;



class Login extends Common
{
    use \traits\controller\Jump;              /*引入jump*/

    // todo 统一个方法验证在线状态 和 验证身份

    public function _initialize()
    {
        if (!empty(session('moroselyName'))) {
            $this->error('已登录','index/index/index');
        }
    }
    public  function index(){
        echo 'fuck';

    }


    //Charity申请 公益机构申请
    public function charity_register()
    {
        if (request()->isPost()) {
            $date = input();
            $validate = validate('Login');
            if (!$validate->scene('charity_register')->check($date)) {
                $this->error($validate->getError());
            } else {
                unset($date['captcha']);         /*删除验证码*/
                $find = Charity::where('charity_id',$date['charity_id'])
                    ->whereOr('username',$date['username'])
                    ->whereOr('charity_name',$date['charity_name'])
                    ->find();

                if (empty($find)) {
                    $this->error('用户名已存在或组织机构已存在，请检查组织机构名或用户名。');
                } else {
                    $create = Charity::create($date);
                    if ($create) {
                        $this->success('注册成功', 'index/index/index');
                    } else {
                        $this->error('注册失败');
                    }
                }
            }
        }
    }



    //Charity登录 公益机构登录
    public function charity_login()
    {
        if (request()->isPost()) {
            $date = input();
            $validate = validate('Login');
            if (!$validate->scene('login')->check($date)) {
                $this->error($validate->getError());
            } else {
                $find = Charity::where($date)->find();
                if ($find) {
                    session('username', $find['responsible_name']);
                    $welcome = '欢迎回来' . $find['responsible_name'];
                    $this->success($welcome, 'index/index/index');
                } else {
                    $this->error('账号或登录密码有误');
                }
            }
        } else {
            return $this->fetch('login/charity');
        }
    }




    //Charity_user登录
    public function charity_user_login()
    {
        if (request()->isPost()) {
            $date = input();
            $validate = validate('Login');
            if (!$validate->scene('login')->check($date)) {
                $this->error($validate->getError());
            } else {
                unset($date['captcha']);          /*删除验证码*/
                $find = CharityUser::where($date)->find();
                if ($find) {
                    session('user', $find['username']);
                    $welcome = '欢迎回来' . $find['username'];
                    $this->success($welcome, 'index/index/index');
                } else {
                    $this->error('账号或登录密码有误');
                }
            }
        } else {
            return $this->fetch('login/charity_user');
        }
    }



    //Morosely登录  //仆人
    public function morosely_login()
    {
        if (!empty(session('moroselyId'))) $this->index_jump('已登录，正在跳转至首页！');
        if (request()->isPost()) {
            $date=input();
            $validate = validate('Login');
            if (!$validate->scene('login')->check($date)) {
                return json(['error'=>$validate->getError()]);
            } else {
                unset($date['captcha']);
                $date=[
                    'email' => input('email'),
                    'password' => input('password'),
                ];
                $find = Morosely::where($date)->find();
                if ($find) {
                    session('userType','morosely');
                    session('moroselyName', $find['username']);
                    session('moroselyId',$find['id']);
                    session('moroselyPic',$find['pic']);
                    $welcome = '欢迎回来' . $find['username'];
                    return json(['success'=>$welcome]);
//                    $this->success($welcome, 'index/index/index');
                } else {
                    return json(['error'=>'账号或登录密码有误']);
//                    $this->error('账号或登录密码有误');
                }
            }
        } else {
            return $this->fetch('login/login');
        }
    }



    //morosely注册   //普通用户
    public function morosely_register()
    {
        if (request()->isPost()) {
            $date = input();
            $same = true;
            if ($date['password'] != $date['re_word']) { $same = false; }
            $date['agree']=='had_read' ? $date['agree']=1:$date['agree']=0;
            $validate = validate('Login');
            if (!$same) {
                $this->error('俩次密码不一致');
            } else {
                if (!$validate->scene('morosely_register')->check($date)) {
                    $this->error($validate->getError());

                } else {
                    $find = Morosely::where('username', input('username'))
                        ->whereOr('email', input('email'))
                        ->find();
                    if ($find) {
                        $this->error('用户名或邮箱不可用！');
                    } else {
                        unset($date['captcha']);             /*从数组中删除验证码*/
                        unset($date['agree']);               /*从数组中删除字段agree*/
                        unset($date['re_word']);               /*从数组中删除字段agree*/
                        $insert=Morosely::create($date);
                        if ($insert) {
                            MoroselyCore::create(['moroselyId'=>$insert['id']]);            //core 核心表中创建数据主键
                            MoroselyOne::create(['moroselyId'=>$insert['id']]);            //core 核心表中创建数据主键
                            session('moroselyId', $insert['id']);            /*在session中保存用户登录状态*/
                            $this->success('注册成功', 'index/index/index');
                        } else {
                            $this->error('注册失败');
                        }
                    }
                }
            }
        }else{
            return $this->fetch('login/register');
        }
    }
}