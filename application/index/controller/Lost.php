<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 17:28
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\index\model\Comment;
use app\index\model\Blog;
use app\index\model\Draft as DraftModel;
use app\index\model\Lost as LostModel;
use app\index\model\Morosely;
use app\index\controller\Common;
use app\index\controller\Draft;

class Lost extends Common
{
    private $request_error = ['error' => 'request_error'];

    public function add_lost()
    {
        $this->online_check();
        if (request()->isPost()) {
            $data = input();
            $imagePath = ROOT_PATH . 'public\uploads\index\lost';
            $data['note'] = strip_tags($data['note']);
            $data['note'] = preg_replace('/\s|nbsp;|&/', "", $data['note'], -1);
            $validate = validate('Lost');
            $check = $validate->scene('add_lost')->check($data);
            if (!$check) {
                return $validate->getError();
            } else {
                if (array_key_exists('town', $data)) {
                    $data['location'] = $data['town'];
                } elseif (array_key_exists('area', $data)) {
                    $data['location'] = $data['area'];
                } elseif (array_key_exists('city', $data)) {
                    $data['location'] = $data['city'];
                }
                unset($data['agree']);
                unset($data['province']);
                unset($data['city']);
                unset($data['area']);
                unset($data['captcha']);
                unset($data['agree']);
                $data['moroselyId'] = session('moroselyId');
                $data['moroselyName'] = session('moroselyName');
                $images = request()->file('images');

                if (isset($images)) {
                    foreach ($images as $key => $img) {
                        $info = $images[$key]->rule('date')->move($imagePath);
                        if ($info) {
                            $path[$key] = $info->getSaveName();
                        }
                    }
                }
                if (isset($path)) {
                    $data['images'] = join('&', $path);
                }
                $create = LostModel::create($data);
            }
            echo $data['tel'];
            if (isset($create) && $create) {
                return json($create);
            } else {
                return json(['error' => '数据存储错误']);
            }
        } else {
            return $this->fetch();
        }
    }

    public function lost_list(int $status = 0)
    {
        if (!request()->isGet()) return json($this->request_error);
        $lost_list = Db::table('user_lost')
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->where('a.status', $status)
            ->field('a.id,a.status,a.images,b.username,b.pic,a.title,a.moroselyId')
            ->order('a.id desc')
            ->paginate(12);
//        var_dump($lost_list);
        $page = $lost_list->render();
        //todo 加个判断给找到宠物的加个logo
        //todo 设计个logo不显示图片时的logo
        $lost_list = $lost_list->toArray();
        foreach ($lost_list['data'] as $key => $item) {
            if (!empty($item['images'])) {
                $item['images'] = explode('&', $item['images']);
                $lost_list['data'][$key]['images'] = $item['images'][0];
            }
        }
        $this->assign('page', $page);
//        krsort($lost_list['data']);
        $lost_list = $lost_list['data'];
        $this->assign('list', $lost_list);
        return $this->fetch('lost/lost_list');
    }


    public function show_lost()
    {
        if (!\request()->isGet()) return json($this->request_error);
        $id = $_GET['id'];
        LostModel::where('id', $id)->setInc('see');               //浏览次数加1 此处目前用于统计用
        $lost = LostModel::where('id', $id)->field('')->find($id);
        $morosely = Morosely::where('id',$lost->moroselyId)
            ->alias('a')->join('user_morosely_one b','a.id = b.moroselyId')
            ->field('a.username,a.id,a.pic,b.company,b.maxim')->find();
        if (preg_match('/&/',$lost['images']))
            $lost['images'] = explode('&', $lost['images']);

        $this->assign('lost', $lost);
        $this->assign('morosely', $morosely);
        //把lost【‘images’】 变成数组
        return $this->fetch('lost/show_lost');
    }

    public function shutdown_lost()
    {

    }

    public function my_lost()
    {
        $this->online_check();
        $list = LostModel::where('moroselyId',session('moroselyId'))
            ->where('status = 0 or status = 10')->order('id desc')->paginate(5);
        $page = $list->render();
        $list = $list->toArray();
        $list = $this->getNO_1_image($list['data'],'images','&');
        $morosely = ['id' => session('moroselyId'), 'pic' => session('moroselyPic')];
        $this->assign('page',$page);
        $this->assign('morosely',$morosely);
        $this->assign('list',$list);
        return $this->fetch('lost/my_lost');
    }
}