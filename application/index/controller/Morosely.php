<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/10 0010
 * Time: 2:51
 */

namespace app\index\controller;

use app\index\model\Blog;
use think\Controller;
use think\Request;
use think\Db;
use app\index\controller\Common;
use think\Cache;
use app\index\model\MoroselyCore;
use app\index\model\MoroselyOne;
use app\index\model\Morosely as MoroselyModel;  //模型与类重名必须要重新别名

class Morosely extends Common
{
    use \traits\controller\Jump;              /*引入jump*/


    public function _initialize()
    {
        $this->online_check();
    }

    //查看个人资料
    public function personalDate()
    {

    }


    //登出
    public function logout()
    {

    }

    //master_list      小主列表
    public function master_list()
    {

    }


    //master_modify   修改小主
    public function master_modify()
    {

    }


    //master_add   天加小主
    public function master_add()
    {
        if (request()->isPost()) {
            $data = input();
        }
    }


    //master_del   是删除主人
    public function master_del()
    {

    }

    //个人后台页面全部放在这里
    public function my_adopt()
    {
        $adopt = new Adopt();
        return $adopt->my_adopt();
    }

    //我参与报名的领养
    public function my_enroll_adopt()
    {
        $adopt = new Adopt();
        return $adopt->my_enroll_adopt();
    }


    //我的丢失
    public function my_lost()
    {
        $lost = new Lost();
        return $lost->my_lost();
    }


    //我的文章
    public function my_blog()
    {
        $blog = new Ublog();
        return $blog->my_blog();
    }

    //回复我的评论
    public function reply_me()
    {
        $article = new Ublog();
        return $article->reply_me();
    }



    /*查询个人资料*/
    public function search_personalData()
    {
        if (!request()->isGet()) return json(['error' => 'request_error']);
        $id = input('id');
        $morosely_self = $id == session('moroselyId') ? true : false; //是否是本人查看
        $morosely = MoroselyModel::where('id', $id)->alias('a')
            ->join('user_morosely_one b', 'a.id = b.moroselyId')//
            ->join('user_morosely_core c', 'a.id = c.moroselyId')->find();          //用户基础信息表
        $trueNameCheck = $morosely->trueName && $morosely->idCard ? true : false; //判断是否完成了实名验证
        $birthday = $morosely->birthday;
        $birthday = date('Y', time()) - substr($birthday, 0, 4);
        $morosely->birthday = $birthday;
        $this->assign('morosely_self', $morosely_self);
        $this->assign('trueNameCheck', $trueNameCheck);
        $this->assign('morosely', $morosely);
        return $this->fetch('morosely/search_personalData');
    }

    //查看个人资料
    public function show_personalData()
    {
        $id = session('moroselyId');
        $morosely = MoroselyModel::where('id', $id)
            ->alias('a')
            ->join('user_morosely_one b', 'a.id = b.moroselyId')//
            ->join('user_morosely_core c', 'a.id = c.moroselyId')
            ->find($id);          //用户基础信息
        $birthday = $morosely->birthday ? $morosely->birthday : null;
        $birthday = date('Y', time()) - substr($birthday, 0, 4);
        $morosely->birthday = $birthday;
        $trueNameCheck = $morosely->trueName && $morosely->idCard ? true : false;    //用户是否实名认证
        $this->assign('trueNameCheck', $trueNameCheck);
        $this->assign('morosely', $morosely);
        return $this->fetch('morosely/show_personalData');
    }

    //修改个人资料
    public function modify_personalData()
    {
        $id = session('moroselyId');
        if (request()->isPost()) {
            $data = input();
            $moroselyOne_data = $data;
            $moroselyOne_data['moroselyId'] = $id;
            unset($moroselyOne_data['username']);
            $morosely = MoroselyModel::get($id);
            $morosely->username = $data['username'];
            $save = $morosely->save();
            $update = $morosely->moroselyOne()->update($moroselyOne_data);
            return json($save || $update ? ['success' => 'successs'] : ['error' => 'error']);
        } else {
            $moro = MoroselyModel::where('id', $id)->field('username')->find($id);
            $moroselyOne = $moro->moroselyOne()
                ->field('maxim,company')
                ->find();
            $morosely = $this->personal_top();
            $this->assign('morosely', $morosely);
            $this->assign('moro', $moro);
            $this->assign('moroselyOne', $moroselyOne);
            return $this->fetch('morosely/about_me');
        }
    }

    //修改实名信息
    public function modify_true_name()
    {
        //todo   太多验证字段没做了。。。。天啦 撸!
        if (request()->isPost()) {
            $data = input();
            $update = MoroselyCore::where('moroselyId', session('moroselyId'))->update($data);
            return $update ? ['success' => '修改成功！'] : ['error' => '修改失败'];
        } else {
            $morosely = $this->personal_top();
            $moroselyCore = MoroselyCore::get(session('moroselyId'));
            $this->assign('moroselyCore', $moroselyCore);
            $this->assign('morosely', $morosely);
            return $this->fetch('morosely/true_name');
        }
    }

    //修改和新增个人头像
    public function modify_personal_image()
    {
        $data['id'] = session('moroselyId');
        if (request()->isPost()) {
            $imagePath = ROOT_PATH . 'public/uploads/index/morosely';                     //图片保存地址
            $imgThumbPath = ROOT_PATH . 'public/uploads/index/morosely_thumb';           //缩略图保存地址
            $img = request()->file('pic');
            $thumbImg = \think\Image::open($img);
            if ($img) {
                $info = $img->rule('date')->move($imagePath);
                if ($info) {
                    $datePath = $imgThumbPath . DS . date('Ymd', time());              //名称为当天日期的文件夹路径
                    if (!file_exists($datePath)) mkdir($datePath);
                    $thumbImg->thumb(150, 150, \think\Image::THUMB_SCALING)->save($imgThumbPath . DS . $info->getSaveName());      //保存并创建缩略图
                    $data['pic'] = $info->getSaveName();
                    $find = MoroselyModel::where('id', $data['id'])->field('pic')->find();
                    $update = MoroselyModel::update($data);
                    if ($find && $update) {
                        if (file_exists($imagePath . DS . $find->pic)) unlink($imagePath . DS . $find->pic);  //删除之前的照片
                        if (file_exists($imgThumbPath . DS . $find->pic) == 'file') unlink($imgThumbPath . DS . $find->pic); //删除之前的缩略图
                    }
                }
                Cache::rm('morosely_' . $data['id']);
                session('moroselyPic', $data['pic']);             //同时更新session 用户头像
                return ['success' => '保持图片成功！'];
            }
        } else {
            $morosely = MoroselyModel::where('id', $data['id'])->field('pic')->find();
            $this->assign('morosely', $morosely);
            return $this->fetch('morosely/personal_image');
        }
    }

    //退出登录
    public function quite()
    {
        session(null);
        if (!session('moroselyId')) {
            $this->success('退出成功', 'index/index/index');
        } else {
            $this->error('退出失败');
        }
    }


}