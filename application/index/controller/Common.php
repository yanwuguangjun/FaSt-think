<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/23 0023
 * Time: 1:54
 */

namespace app\index\controller;

use app\index\Model\MoroselyCore;
use app\index\Model\EnrollLog;
use think\Controller;
use think\Db;
use app\index\Model\Morosely;  //模型与类重名必须要重新别名
use app\admin\controller\UBlog;

class Common extends Controller
{
    use \traits\controller\Jump;


    public function _initialize()
    {
    }

    //首页跳转
    public function index_jump($msg = '正在跳转至首页')
    {
        $this->success($msg,'index/index/index');
    }


    public function index_login_jump()
    {
        $this->error('尚未登录', 'index/login/morosely_login');
    }

    public function online_check()
    {

        if (empty(session('moroselyId'))) $this->index_login_jump();
    }

    //针对经常获取查询数据中的第一图片封装的方法
    public function getNO_1_image(array $list,string $images,string $logo){
        foreach ($list as $key=>$item ){
            if (!empty($item[$images])){
                $list[$key][$images] = explode($logo,$item[$images])[0];
            }
        }
        return $list;
    }

    public function personal_top(){
        $morosely = ['moroselyId', session('moroselyId'), 'pic' => session('moroselyPic')];
        return $morosely;
    }
}