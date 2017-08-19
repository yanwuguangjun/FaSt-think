<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Link;

class Friends extends Controller
{
    public function add_link()
    {
        if (request()->isPost()) {
            $date = input();
            $validate = validate('friends');
            if (!$validate->check($date)) {
                echo '<script>alert("' . $validate->getError() . '")</script>';
            } else {
                if (db('link')->insert($date)) {
                    $this->success('添加链接成功', 'add_link');
                } else {
                    $this->error('添加链接失败');
                }

            }
        }
        return $this->fetch('add_link');
    }

    public function link_update()
    {
        //判断请求类型
        if (request()->isPost()) {
            //获取id值
            $id = input('id');
            //获取全部数据
            $date = input();
            //实例化验证
            $validate = validate('friends');
            //进行验证判断
            if (!$validate->check($date)) {
                echo '<script>alert("' . $validate->getError() . '")</script>';
            } else {
                //查询数据
                $find = db('link')->where('id', $id)->find();
                //判断查询结果
                if ($find) {
                    //比较查询结果与提交数据
                    if ($date == $find) {
                        $this->error('修改成功');
                    } else {
                        //更新数据
                        $update = Link::where('id', $id)->update($date);
                        //判断更新数据结果
                        if ($update) {
                            $this->success('更改成功', 'friends/link_list');
                        } else {
                            $this->error('非法操作');
                        }
                    }
                } else {
                    $this->error('非法操作');
                }
            }
        } else {
            $id = input('id');
            $date = Link::get($id);
            if ($date) {
                $this->assign('link', $date);
                return $this->fetch('link_update');
            } else {
                $this->error('feifacaozuo');
            }
        }
    }

    public function link_del()
    {
        $id=input('id');
        $find=Link::find($id);
        if ($find){
            $delete=Link::destroy($id);
            if ($delete){
                $this->success('删除成功','link_list');
            }else{
                $this->error('shanchushibai','link_list');
            }
        }else{
            $this->error('非法操作');
        }
    }


    public function link_list()
    {
        $list = Link::paginate(6);
//        $list=db('link')->field('id,link_name,link,description')->paginate(6);    //此法代码太多
        $this->assign('list', $list);
        return $this->fetch('link_list');
    }
}