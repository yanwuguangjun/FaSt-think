<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/11 0011
 * Time: 2:30
 */

namespace app\index\controller;

use app\index\model\EnrollLog;
use Phinx\Db\Adapter\TablePrefixAdapter;
use think\Controller;
use think\Db;
use app\index\controller\Common;
use think\Request;
use think\Validate;
use app\index\model\Morosely;
use app\index\model\WaitAdopt;
use think\Image;


class Adopt extends Common
{
    use \traits\controller\Jump;              /*引入jump*/

//    领养 todo  身份判定规则
//    用户领养  暂时未定用户在线身份判定规则
//    public function _initialize(){
//        $userid=session('morselyId');
//        if($userid!=10){
//            $this->error('非法请求','index/index/index');
//        }
//    }

    //判断登录状态

    private $adopt_error = ['error' => '该账号已申请领养该宝宝！'];


    public function adopt_list()
    {
        if (!request()->isGet()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $list = WaitAdopt::where('a.status = 0 or a.status = 10 ')
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->field('a.see,a.title,forward,a.images,a.id,b.pic')->order('a.id desc')->paginate(20);
        $page = $list->render();                  //分页
        $list = $list->toArray();
        foreach ($list['data'] as $key => $value) {
            if (!empty($value['images'])) {
                $list['data'][$key]['images'] = explode('&', $list['data'][$key]['images'])[0];      //获取首页图片
            }
        }
        $this->assign('page', $page);
        $this->assign('list', $list['data']);
        return $this->fetch('adopt/adopt_list');
    }


    //打开领养
    public function show_adopt()
    {
        if (!request()->isGet()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $id = $_GET['id'];
        WaitAdopt::where('id', $id)->setInc('see');
        $adopt = WaitAdopt::get($id);
        $comments = $adopt->comments()
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->where('adoptId', $id)->paginate(10, ['query' => ['id' => $id]]);
        $morosely = $adopt->morosely()->alias('a')->join('user_morosely_one b', 'a.id = b.moroselyId')
            ->find($adopt->moroselyId);
        $page = $comments->render();
        if (preg_match('/&/', $adopt['images'])) {
            $adopt['images'] = explode('&', $adopt['images']);
        }
        $adopt['sex'] = $adopt['sex'] == '1' ? '雄性' : '雌性';
        $this->assign('adopt', $adopt);
        $this->assign('page', $page);
        $this->assign('comments', $comments);
        $this->assign('morosely', $morosely);
        return $adopt ? $this->fetch('adopt/show_adopt') : 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>';
    }

    //增加领养
    public function add_adopt()
    {
        $this->online_check();
        if (request()->isPost()) {
            $data = input();
            $imagePath = ROOT_PATH . 'public/uploads/index/adopt';
            $imgThumbPath = ROOT_PATH . 'public/uploads/index/adopt_thumb';
            $validate = validate('Adopt');
            if (!$validate->scene('user_add_adopt')->check($data)) {
                return json(['error' => $validate->getError()]);
            } else {
                $path = null;
                if (array_key_exists('town', $data)) {
                    $data['location'] = $data['town'];
                } elseif (array_key_exists('area', $data) && !empty($data['area'])) {
                    $data['location'] = $data['area'];
                } elseif (array_key_exists('city', $data) && !empty($data['city'])) {
                    $data['location'] = $data['city'];
                } else {
                    $data['location'] = $data['province'];
                }
                $pics = request()->file('images');
                if ($pics) {
                    $picsThumb = \think\Image::open($pics[0]);      //此处就是莫名奇妙的不能放在下放的
                    $datePath = date('Ymd', time());
                    if (!file_exists($imgThumbPath)) mkdir($imgThumbPath);
                    if (!file_exists($imgThumbPath . DS . $datePath)) mkdir($imgThumbPath . DS . $datePath);
                    foreach ($pics as $key => $pic) {
                        $info = $pics[$key]->rule('date')->move($imagePath);
                        if ($info) {
                            $path[$key] = $info->getSaveName();
                            //仅且只制作一张缩略图
                            if ($key == 0) {
                                $picsThumb->thumb(400, 400, \think\Image::THUMB_SCALING)
                                    ->thumb(262, 160, \think\Image::THUMB_CENTER)
                                    ->save($imgThumbPath . DS . $path[$key]);
                            }
                        } else {
                            return $info->getError();
                        }
                    }
                }
                if ($path) $data['images'] = join('&', $path);
                unset($data['captcha']);
                unset($data['agree']);
                unset($data['province']);
                unset($data['city']);
                unset($data['area']);
                $userId = session('moroselyId');
                $data['moroselyId'] = $userId;
                $create = WaitAdopt::create($data);
                return json($create ? $create : ['error' => '发布领养失败！']);
            }
        } else {
            return $this->fetch('adopt/add_adopt');
        }
    }


    // 报名领养宠物
    public function adopt_enroll()
    {
//        $this->online_check();
        if (!request()->isPost()) return json(['error' => 'request_error']);
        $id = input('id');
        $data = input('data');
        $user_id = session('moroselyId');
        $data = preg_replace('/\[/', '', $data);
        $data = preg_replace('/\]/', '', $data);
        $data = $data . ',' . $user_id;
        $find = WaitAdopt::where('id', $id)->field('enroll')->find();
        if (!empty($find['enroll'])) {
            if (preg_match('/,' . $user_id . '&&&/', $find['enroll']) || preg_match('/,' . $user_id . '$/', $find['enroll'])) {
                return json($this->adopt_error);
            }
        }
        $create = empty($find['enroll']) ? WaitAdopt::where('id', $id)->update(['enroll' => $data]) :
            WaitAdopt::where('id', $id)->update(['enroll' => $find['enroll'] . '&&&' . $data]);

        //记录领养报名信息
        if ($create) EnrollLog::create(['moroselyId' => session('moroselyId'), 'enrollId' => $id, 'enrollType' => '1', 'enrollTime' => time()]);
        return json($create);
    }


    //用户个人页面领养列表
    public function my_adopt()
    {
        $this->online_check();
        $list = WaitAdopt::where('status = 0 or status = 10')
            ->where('moroselyId', session('moroselyId'))
            ->order('id desc')
            ->paginate(5,true);
        $page = $list->render();
        $list = $list->toArray();
        //调用了自己封装的方法
        $list = $this->getNO_1_image($list['data'],'images','&');
        $morosely = $this->personal_top();
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('morosely', $morosely);
        return $this->fetch('adopt/my_adopt');
    }



    //用户参与报名的领养
    public function my_enroll_adopt()
    {
        $this->online_check();
        $list = EnrollLog::where('a.moroselyId', session('moroselyId'))
            ->where('a.enrollType', 1)
            ->alias('a')->join('user_wait_adopt b', 'a.enrollId = b.id')
            ->field('a.enrollId,b.images,b.title,b.note')
            ->order('a.id desc')->paginate(5,true);
        $page = $list->render();
        $list = $list->toArray();
        $list = $this->getNO_1_image($list['data'],'images','&');
        $morosely = $this->personal_top();
        $this->assign('list', $list);
        $this->assign('morosely',$morosely);
        $this->assign('page', $page);
        return $this->fetch('adopt/my_enroll_adopt');
    }

    //删除  即关闭领养
    public function del_adopt()
    {
        if (request()->isPost()) {
            $id = input('id');                      //获取领养id
            $belongTo_id = input('belongTo_id');    //获取领养发布人id
            $userType = session('userType');                  //当前用户类型
            $userId = session('userId');                    //当前用户id
            //判断  当前用户是否是发布领养人
            //            当前用户类型
            if ($userType == 'morosely' && $belongTo_id == $userId) {
                //   todo  了解如何配置全局变量
                $close = Db::table('wait_adopt')
                    ->where('id', $id)->update('status', '2');
                if ($close) {
                    $this->success('关闭领养成功');
                } else {
                    $this->error('关闭领养失败');
                }
            }
        }
    }


    //修改
    public function modify_adopt()
    {
        //todo  ajax  表单选择  选择种类
        if (request()->isPost()) {
            $date = input();
            $validate = validate('Adopt');
            if (!$validate->scene('user_add_adopt')->check($date)) {
                $this->error($validate->getError());
            } else {
                $userId = session('userId');
                $modify = Db::where('belongTo_id', $userId)->where('id', $date['id'])->update($date);
                if (!$modify) {
                    $this->error('修改失败');
                } else {
                    //todo  模板+1
                    $this->success('修改成功', 'index/morosely/adoptList');     //修改成功后跳转到领养列表中
                }
            }
        } else {
            // todo  模板+1
            return $this->fetch('index/adopt/add_adopt');
        }
    }



    // todo  修改报名领养的位置   当然也可以不用关闭
    //关闭领养     //todo   位置放错了  烦躁
    public function close_adopt()
    {
        if (request()->isPost()) {
            $id = input('id');
            $close = Db::table('wait_adopt')->where('id', $id)->update('status', '2');
            if (!empty($close)) {
                $this->success('关闭成功！');
            } else {
                $this->error('关闭失败！请重试');
            }
        } else {
            $this->error('非法请求');
        }
    }
}