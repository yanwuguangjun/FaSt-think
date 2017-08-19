<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/11 0011
 * Time: 21:20
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Cache;
use think\Request;
use app\index\model\Comment;
use app\index\model\Blog;
use app\index\model\Draft as DraftModel;
use app\index\controller\Common;
use app\index\controller\Draft;

class Ublog extends Common
{
    use \traits\controller\Jump;

    //todo session判断还没做


//    public function _initialize(){
//        $userType=session('userType');
//        if($userType!='morosely'){
//            $this->error('非法请求','index/index/index');
//        }
//    }

    public function add_article()
    {
        $imageError = '图片保存错误';
        $path = ROOT_PATH . DS . 'public/uploads/index/faceimage';
        $imgThumbPath = ROOT_PATH . 'public/uploads/index/faceimage_thumb';
        $moroselyId = session('moroselyId');
        if (request()->isPost()) {
            $data = input();
            $data['moroselyId'] = $moroselyId;
            $img = request()->file('faceImage');
            if ($img) {
                $thumbImg = \think\Image::open($img);
                $info = $img->rule('date')->move($path);
                if ($info) {
                    $data['faceImage'] = $info->getSaveName();
                    $datePath = $imgThumbPath . DS . date('Ymd', time());
                    if (!file_exists($imgThumbPath)) mkdir($imgThumbPath);
                    if (!file_exists($datePath)) mkdir($datePath);
                    $thumbImg->thumb(400, 400, \think\Image::THUMB_SCALING)->thumb(262, 160, \think\Image::THUMB_CENTER)->save($imgThumbPath . DS . $data['faceImage']);

                } else {
                    return $imageError;
                }
            }
            $create = Blog::create($data);
            $find = DraftModel::get($data['moroselyId']);
            if (file_exists($path . $find['faceImage']) == 'file') unlink($path . $find['faceImage']);
            $delete = DraftModel::destroy($moroselyId);
            if ($find) {
                return $create && $delete ? '发布成功！' : '发布失败！';
            } else {
                if ($create) return '发布成功！';
            }

        } else {
            $draft = DraftModel::get($moroselyId);
            $this->assign('draft', $draft);
            return $this->fetch('article/add_article');
        }
    }


    public function save_article()
    {
        if (request()->isPost()) {
            $path = ROOT_PATH . 'public/uploads/index/faceImage/';
            $data = input();
            $data['modifyTime'] = time();
            $error = '保存失败！';
            $imageError = '图片保存错误';
            $data['moroselyId'] = session('moroselyId');
            $find = DraftModel::where('moroselyId', $data['moroselyId'])->find();
            if ($find) {
                $data['moroselyId'] = $find['moroselyId'];
                $image = request()->file('faceImage');
                if ($image) {
                    $info = $image->rule('date')->move($path);
                    if (isset($info)) {
                        $data['faceImage'] = $info->getSaveName();
                        if (filetype($path . $find['faceImage']) == 'file') unlink($path . $find['faceImage']);
                    } else {
                        return $imageError;
                    }
                }
                $update = DraftModel::update($data);
                return $update ? json($update) : $error;
            } else {
                $image = request()->file('faceImage');
                if ($image) {
                    $info = $image->rule('date')->move($path);
                    if (isset($info)) {
                        $data['faceImage'] = $info->getSaveName();
                    } else {
                        return $imageError;
                    }
                }
                $create = DraftModel::create($data);
                return $create ? json($create) : $error;
            }
        }
    }

    public function clear_face_img()
    {
        if (request()->isGet()) {
            $filePath = ROOT_PATH . 'public/uploads/index/faceImage/';
            $data['faceImage'] = null;
            $data['moroselyId'] = session('moroselyId');
            $find = DraftModel::where('moroselyId', $data['moroselyId'])->field('faceImage')->find();
            if (file_exists($filePath . $find['faceImage'])) unlink($filePath . $find['faceImage']); //执行删除操作
            $update = DraftModel::update($data);
            return $update ? ['success' => '删除图片成功！'] : ['error' => '删除图片失败!'];
        }
    }

    public function modify_article()
        // todo 修改其实还没完成
    {
        if (request()->isPost()) {
            $data = input();
            $update = Blog::where(['moroselyId' => session('moroselyId'), 'id' => input('id')])->update($data);
            echo $update ? '修改成功！' : '修改失败！';
        } else {
            $id = input('id');
            $moroselyId = session('moroselyId');
            $get = [
                'id' => $id,
                'moroselyId' => $moroselyId
            ];
            $find = Blog::where($get)->find();
            if ($find) {
                $this->assign('blog', $find);
                return $this->fetch('article/modify_article');
            }
        }
    }


    public function like()
    {
        if (request()->post()) {
            $id = input('id');
//            Cache::clear('comment_' . $id);                    //无需清理缓存好吧！
            $update = Blog::where('id', $id)->setInc('love');
//            return $update ? json(['msg' => '点赞成功！']) : json(['msg' => '点赞失败！']);
//            return json($update ? ['msg' => '点赞成功！'] : ['msg' => '点赞失败！']);
            return json(['msg' => $update ? '点赞成功！' : '点赞失败！']);
        }
    }

    public function add_comment()
    {
        if (request()->isPost()) {
            //todo 对评论数据进行验证  目前未验证
            //todo 用户详情页
            $data['articleId'] = input('articleId');
            $data['content'] = input('content');
            $data['moroselyId'] = session('moroselyId');
            $data['moroselyName'] = session('moroselyName');
            $data['time'] = time();
            $data['content'] = preg_replace('/<p>|<\/p>/', "", $data['content'], -1);
            $create = Comment::create($data);
            Cache::clear('comment_' . $data['articleId']);
            if ($create) {
                Blog::where('id', $data['articleId'])->setInc('comment');      //评论数加1
                $create['moroselyPic'] = session('moroselyPic');
                return json($create);
            } else {
                return '评论失败！';
            }
        }
    }

    public function del_comment()
    {

    }

    public function reply_comment()
    {
        if (request()->isPost()) {
            //todo  没有articleId
            $data = input();
            $data['moroselyId'] = session('moroselyId');
            $data['moroselyName'] = session('moroselyName');
//            $data['content'] = strip_tags($data['content']);
            $data['content'] = preg_replace('/<p>|<\/p>/', "", $data['content'], -1);
            $data['time'] = time();
            $create = Comment::create($data);
            Cache::clear('comment_' . $data['articleId']);
            if ($create) {
                Blog::where('id', $data['articleId'])->setInc('comment');      //评论数加1
                $create['moroselyPic'] = session('moroselyPic');
                return json($create);
            } else {
                return '评论失败';
            }
        }
    }


    public function my_blog()
    {
        $this->online_check();
        $list = Blog::where('moroselyId', session('moroselyId'))
            ->where('status = 0 or status = 10 or status = 1 or status = 2')
            ->order('id desc')->paginate(5,true);
        $page = $list->render();
        $morosely = $this->personal_top();
        $this->assign('list', $list);
        $this->assign('morosely', $morosely);
        $this->assign('page', $page);
        return $this->fetch('article/my_article');
    }

    public function reply_me()
    {
        $this->online_check();
        $list = Comment::where('a.CTMoroselyId', session('moroselyId'))
            ->alias('a')->join('user_blog b', 'a.articleId = b.id')
            ->join('user_morosely c', 'a.moroselyId = c.id')
            ->field('a.id,a.content,a.moroselyId,a.articleId,b.title,b.faceImage,c.pic,c.username')
            ->order('a.id desc')->paginate(5,true);
        $page = $list->render();
        $morosely = $this->personal_top();
        $this->assign('list',$list);
        $this->assign('morosely',$morosely);
        $this->assign('page',$page);
        return  $this->fetch('article/reply_me');
    }

    public function my_keep_blog()
    {

    }

    //日志增
    public function add_blog()
    {

    }

    //日志删
    public function del_blog()
    {

    }


    //日志改
    public function modify_blog()
    {

    }


    //日志列表
    public function list_blog()
    {

    }


}