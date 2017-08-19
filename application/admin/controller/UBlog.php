<?php
/**
 * Created by PhpStorm.
 * User: xuhui
 * Date: 17-6-29
 * Time: 下午7:00
 */

namespace app\admin\controller;

use app\admin\model\Blog;
use think\Controller;

class UBlog extends Controller
{

    //ajax get文章数据
    public function show_blog()
    {
        if (!request()->isGet()) return json($this->request_error);
        $id = input('id');
        $show_blog = Blog::get($id);
        return json($show_blog);

    }


    //blog 管理列表 获取列表
    public function blog_list()
    {
        if (!\request()->isGet()) return json($this->request_error);
        //按从小到大的顺序排列
        $blog = Blog::where('status', 0)->order('id asc')
            ->field('id,title')
            ->limit(20)->select();
        $this->assign('blog', $blog);
        return $this->fetch('index/index');
    }

    //首页banner设置 设置为banner
    public function banner()
    {
        if (!\request()->isGet()) return json($this->request_error);
        $id = $_GET['id'];
        $update = $this->modify_status(1,$id);
        $update = Blog::where('id', $id)->update(['status' => '2']);
        return json($update ? ['success' => '设为banner成功！'] : ['error' => '设置失败！']);
    }

    //将文章添加到首页
    public function page_one()
    {
        if (!\request()->isGet()) return json($this->request_error);
        $id = $_GET['id'];
        $update = $this->modify_status(1,$id);
        return json($update ? ['success' => '添加到首页成功！'] : ['error' => '设置失败！']);
    }

    //删除文章
    public function del_blog()
    {
        if (!\request()->isGet()) return json($this->request_error);
        $id = $_GET['id'];
        $update =  $this->modify_status('9',$id);
       //TODO 记得删除缓存 暂时没有删除缓存  普通文章缓存时间在一个月就不得了了
        return json($update ? ['success' => '删除文章成功！'] : ['error' => '屏蔽文章成功！']);
    }



    //基础修改文章状态方法
    public function modify_status($status, $id)
    {
        $modify = Blog::where('id', $id)->update(['status' => $status]);
        return $modify;
    }

    //文章完成阅读
    public function had_red()
    {
        $id = $_GET['id'];
        $update = $this->modify_status('10',$id);
        return json($update ? ['success' => '已阅！'] : ['error' => '阅读失败！']);
    }
}