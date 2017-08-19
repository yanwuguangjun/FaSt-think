<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12 0012
 * Time: 17:55
 */

namespace app\index\controller;

use think\Controller;
use app\index\controller\Functions;
use think\Db;
use app\index\model\SociallyUsefulActivity;
use app\index\model\ActivityComment;
use  app\index\model\ActivityImgUploadLog;

class Activity extends Common
{
    public function _initialize()
    {
        //todo  改成判断是否等于0
//        if (session('userType') != 2) $this->error('请完成组织或机构认证', 'index/morosely/modify_true_name');
    }

    private $login_error = ['error'=>'尚未登陆！'];

    //活动列表
    public function activity_list()
    {
        if (!request()->isGet()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $list = SociallyUsefulActivity::where('status', 0)->cache(0, 'activity_list')->order('endTime desc')->paginate(20);
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('activity/activity_list');
    }

    //活动页面
    public function show_activity()
    {
        if (!request()->isGet()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $id = input('id');
        $pageNum = input('page');
        $pageNum ? $pageNum : $pageNum = '1';
        SociallyUsefulActivity::where('id', $id)->setInc('see');             //浏览量+1
        $activity = SociallyUsefulActivity::get($id);
        $comment = $activity->comment()
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->cache('page_' . $pageNum, 0, 'comment_activity_' . $id)
            ->order('time desc')->paginate(5, false, ['query' => ['id' => $id]]);
        $morosely = $activity->morosely()
            ->alias('a')->join('user_morosely_one b', 'a.id = b.moroselyId')
            ->find($activity->moroselyId);
//        ->cache(0,'comment_activity_'.$id)
        $page = $comment->render();
        $this->assign('activity', $activity);
        $this->assign('morosely', $morosely);
        $this->assign('comments', $comment);
        $this->assign('page', $page);
        return $this->fetch('activity/show_activity');
    }

    //  获取申请活动内容中的图片
    //  即为ajax上传的图片内容
    public function get_activity_face()
    {
        if (!request()->isPost()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $image = request()->file('file');
        $path = '\public\uploads\index\useful_activity';
        $info = $image->move(ROOT_PATH . $path);
        if ($info) {
            $cutUrl = $info->getSaveName();
            $url = $path . DS . $cutUrl;
            $data = [
                'url' => $cutUrl,
                'moroselyId' => session('moroselyId'),
                'uploadTime' => time()
            ];
            $create = ActivityImgUploadLog::create($data);
            if (!$create) {
                return http_response_code(404);
            }
        } else {
            return http_response_code(404);
        }
        $array = ['link' => $url];
        return json($array);
    }

    //申请发起活动
    public function promotional_activity()
    {
        //判断是否登录
        //TODO 此处应该判断下实名认证 后面再做吧
        if (empty(session('moroselyId'))) $this->index_login_jump();
        if (request()->isPost()) {
            $imagePath = ROOT_PATH . 'public/uploads/index/activity_face';                     //图片保存地址
            $imgThumbPath = ROOT_PATH . 'public/uploads/index/activity_face_thumb';           //缩略图保存地址
            $data = input();
            if (array_key_exists('town', $data)) {
                $data['location'] = $data['town'];
            } elseif (array_key_exists('area', $data)) {
                $data['location'] = $data['area'];
            } elseif (array_key_exists('city', $data)) {
                $data['location'] = $data['city'];
            }
//            $data['location'] =
//                Functions::getAreaCode($data['province'], $data['city'], $data['area']);          //本来有自己写的方法获取位置但是数据太大了
//            if (is_array($data['location'])) return json($data['location']);          //如果地理位置返回的是数组则返回数组错误
            unset($data['agree']);
            unset($data['province']);
            unset($data['city']);
            if (array_key_exists('area', $data)) unset($data['area']);
            if (array_key_exists('town', $data)) unset($data['town']);

            $img = request()->file('images');
            if ($img) {
                $thumbImg = \think\Image::open($img);
                $info = $img->rule('date')->move($imagePath);
                if ($info) {
                    $datePath = $imgThumbPath . DS . date('Ymd', time());
                    if (!file_exists($datePath)) mkdir($datePath);
                    $data['faceImage'] = $info->getSaveName();
                    $thumbImg->thumb(400, 400, \think\Image::THUMB_SCALING)->save($imgThumbPath . DS . $data['faceImage']);
                }
            }
            $data['moroselyId'] = session('moroselyId');
            $data['startTime'] = preg_replace('/-/', '', $data['startTime']);
            $data['endTime']= preg_replace('/-/', '', $data['endTime']);
            if ($data['startTime'] > $data['endTime']) return json(['error' => '活动结束时间有误！']);
            $create = SociallyUsefulActivity::create($data);
            return json($create);
        } else {
            //最新活动
            $new_activity = SociallyUsefulActivity::where('status = 1')
                ->field('id,faceImage,title')
                ->limit(2)->order('id desc')->select();
            $this->assign('new_activity',$new_activity);
            return $this->fetch('activity/promotional_activity');
        }
    }

    //点赞
    public function like_activity()
    {
        if (!request()->isPost()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $inc = SociallyUsefulActivity::where('id', $_POST['id'])->setInc('love');   //点赞量＋1
        return json(['msg' => $inc ? '点赞成功！' : '点赞失败！']);
    }

    public function add_comment()
    {
        if (!request()->isPost()) return json(['error' => 'request_error']);
        $data = input();
        $data['moroselyId'] = session('moroselyId');
        $data['time'] = time();
        $create = ActivityComment::create($data);
        $create['moroselyName'] = session('moroselyName');
        $create['moroselyPic'] = session('moroselyPic');
        return json($create);
    }

    public function reply_comment()
    {
        if (!request()->isPost()) return json(['error' => 'request_error']);
        $data = input();
        $data['moroselyId'] = session('moroselyId');
        $data['time'] = time();
        $create = ActivityComment::create($data);
        $create['moroselyName'] = session('moroselyName');
        $create['moroselyPic'] = session('moroselyPic');
        return json($create);
    }

    //还没有对所有的回复 评论发表文章类进行权限控制

    //报名活动
    public function activity_enroll()
    {
        if (!request()->isPost()) return json(['error' => 'request_error']);
        if (empty(session('moroselyId'))) return json($this->login_error);
        $data = input();    //获取传入数据
        $id = input('id');  //获取id
        $data['data'] = preg_replace('/\[/', '', $data['data']);
        $data['data'] = preg_replace('/\]/', '', $data['data']);
        $data['moroselyId'] = session('moroselyId');
        $data = $data['data'] . "," . $data['moroselyId'];
        $get_data = SociallyUsefulActivity::where('id', $id)->field('enroll')->find();   //获取数据表中数据
//        if (!empty($get_data['enroll'])){                       //如果存在数据
//            $user_data = preg_replace('/"[\u4e00-\u9fa5]{0,}","[0-9]*","(是|否)",/','',$get_data['enroll']); // 过滤掉用户信息只留下用户id
//            $user_data = explode('&&&',$user_data); // 变为数组
//            $user_data = array_flip($user_data);              //反转数组
//            if (array_key_exists($id,$user_data))  return json(['error'=>'该活动已报名！']);         //判断 用户是否已经报名
//        }

        if(!empty($get_data['enroll'])){
            if (!(preg_match('/,'.$data['moroselyId'].'&&&/',$get_data['enroll']) or preg_match('/,'.$data['moroselyId'].'$/',$get_data['enroll'])) )
                return json(['error'=>'该活动已报名！']);         //判断 用户是否已经报名
        }
        $create = empty($get_data['enroll']) ? SociallyUsefulActivity::where('id', $id)->update(['enroll' => $data]) : SociallyUsefulActivity::where('id', $id)->update(['enroll' => $get_data['enroll'] . '&&&' . $data]);
        return json($create);
    }
}