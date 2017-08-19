<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Blog;
use app\admin\controller\Adopt;
use app\admin\controller\Activity;
use app\admin\controller\Lost;

class Index extends Controller            //类名称
{

    public function _initialize()
    {
        if (session('adminuser') != 'super') {

            $this->error('请先登录', 'admin/login/login');
        }
    }

    public $request_error = ['error' => 'reques_error'];


    //后台首页
    public function index()
    {
        $blog = new UBlog();
        return $blog->blog_list();
    }

    //以对象的形式去获取活动列表
    public function activity_list($status = 0)
    {
        $activity = new Activity();
        return $activity->activity_list($status);
    }

    //领养列表 正常的领养为0  此处status为0 默认值也为零
    public function adopt_list()
    {
        $adopt = new Adopt();
        return $adopt->adopt_list(0);
    }

    //丢失列表 获取默认status 为0的
    public function lost_list($status = 0)
    {
        $lost = new Lost();
        return $lost->lost_lsit($status);
    }


    //推荐到banner
    public function banner()
    {
        $blog = new UBlog();
        return $blog->banner();
    }

    //推荐到首页
    public function page_one()
    {
        $blog = new UBlog();
        return $blog->page_one();
    }

    //确认检查文章
    public function had_read()
    {
        $blog = new UBlog();
        return $blog->had_red();
    }


    public function del_blog()
    {
        $blog = new UBlog();
        return $blog->del_blog();
    }

    //返回ajax请求的文章的数据
    public function show_blog()
    {
        $blog = new UBlog();
        return $blog->show_blog();
    }

    //查看activity
    public function show_activity()
    {
        $activity = new Activity();
        return $activity->show_activity();
    }


    //登陆
    public function login()
    {
        if (!session('user')) {
            if (request()->isPost()) {
                $date = input();
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
                        if ($find) {
                            session('user', $find);
                            $this->success($date['username'], 'admin/article/article_list');
                        }
                    } else {
                        $this->error('登陆失败');
                    }
                };
            } else {
                return $this->fetch('login');
            }
        }

    }


    public function quite() //退出登录
    {
        session(null);
        if (!session('adminuser')) {
            $this->success('退出成功', 'admin/login/login');
        } else {
            $this->error('退出失败');
        }
    }


    public function alis()   //管理员列表
    {
        $list = AdminModel::paginate(6);
//        $list = db('admin')->field('id,username,password')->paginate(5);
        $adid = 7;
        $this->assign('adid', $adid);
        $this->assign('list', $list);

        return $this->fetch('alis');
    }

    public function ad_add()  //添加管理员
    {
        if (request()->isPost()) {

            //获取请求数据
            $data = [
                'username' => input('username'),
                'password' => input('password'),
            ];

            //启用验证方法
            $validate = validate('admin');

            //进行验证判断
            if (!$validate->check($data)) {
                //未通过验证输出警告
                echo '<script>alert("' . $validate->getError() . '")</script>';
            } else {
                $data['password'] = md5($data['password']); //数据md5 加密

                if (db('admin')->insert($data)) {  //选择数据库 插入数据 返回布尔值
                    return $this->success('tianjiaguanliyuanchengogng', 'Index/alis');
                } else {
                    return $this->error('tianjiaguanliyuanshibai');
                }
            }

        }
        return $this->fetch('ad_add');
    }

    public function del()
    {
        $id = input('id');
        $adid = 7;                                                   //设置超级管理员id；
        if ($id == $adid) {
            return $this->error('wufashanchugaiguanliyuan');       //判断管理员是否为超级管理员
        } elseif ($id == null) {
            return $this->error('feifacaozuo');                    //防止非法访问此方法
        } else {
//        $destroy=AdminModel::destroy(['id'=>$id]);
            $destroy = db('admin')->where('id', $id)->delete();
            if ($destroy) {
                return $this->success('shanchuchengong', 'admin/index/alis');
            } else {
                return $this->error('shanchushibai');
            }
        }
    }

    public function ad_update()
    {
        //判断请求类型
        if (request()->isPost()) {
            $date = input();
            $validate = validate('admin');
            //检查表单是否填写完毕
            if (!$validate->scene('edit')->check($date)) {
                echo '<script>alert("' . $validate->getError() . '")</script>';
                $this->error('xiugaishibai');
            } else {

                $check = db('admin')->find($date['id']);
                //查询提交数据是否与数据库数据相同，如果相同则提示修改成功不再将数据插入数据库；
                if ($date == $check) {
                    return $this->success('修改密码成功', 'admin/index/alis');
                } else {
                    //提交数据与数据库数据有变化更新数据
                    $update = db('admin')->where('id', $date['id'])->update($date);

                    if ($update) {
                        //数据库插入成功返回提示消息
                        $this->success('xiugaichengong', 'admin/index/alis');
                    } else {
                        //数据插入失败 返回提示消息
                        $this->error('xiugaishibai');
                    }
                }
            }

        } else {
            //获取请求id
            $id = input('id');
            $check = db('admin')->find($id);
            if ($id == null) {
                return $this->error('feifacaozuo');
            } elseif (!$check) {
                //查询是否有此id 判断是否为非法请求
                return $this->error('feifacaozuo');
            } else {
                $user = db('admin')->where('id', $id)->find();
                $this->assign('user', $user);
                return $this->fetch('ad_update');
            }

        }

    }
}
