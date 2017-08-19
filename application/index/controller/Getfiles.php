<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/4 0004
 * Time: 13:54
 */

namespace app\index\controller;

use think\Controller;
use think;
use think\Db;
use think\Request;
use app\index\model\Morosely;
use app\index\model\WaitAdopt;
use think\Validate;
use think\FroalaEditor;
use app\index\model\Blog;
use app\index\model\Draft;
use app\index\model\ImgUploadLog;


class Getfiles extends Controller
{

//    public function _initialize(){
//        $userType=session('userType');
//        if($userType!='morosely'){
//            $this->error('非法请求','index/index/index');
//        }
//    }


    public function upload()
    {
        if (request()->isPost()) {
            $image = request()->file('file');
            $path = '/public/uploads/index/temporary';
            $info = $image->move(ROOT_PATH . $path);
            if ($info) {
                $cutUrl = $info->getSaveName();
                $url = $path . DS . $cutUrl;
                $data = [
                    'url' => $cutUrl,
                    'moroselyId' => session('moroselyId'),
                    'uploadTime' => time()
                ];
                $create = ImgUploadLog::create($data);
                if (!$create) {
                    return http_response_code(404);
                }
            } else {
                return http_response_code(404);
            }
            $array = ['link' => $url];
            return json($array);
        }
    }

    public function delete()
    {
        $unixToday = time();
//        $difference = ;
        $today = date('Ymd');                        //获取今天
        $yesterday = $today - 1;                               //获取昨天
        $the_day_before_yesterday = $today - 2;                //获取前天
        $yesterday = date_timestamp_get(date_create($yesterday));    //获取昨天时间戳
        $the_day_before_yesterday = date_timestamp_get(date_create($the_day_before_yesterday));         //获取前天时间戳
        $imgLog = ImgUploadLog::where('uploadTime', 'between', [$the_day_before_yesterday, $yesterday])->field('uploadTime,url')->select();
        $imgDraft = Draft::where('modifyTime', 'between', [$the_day_before_yesterday, $unixToday])->select();
        $blog = Blog::where('modifyTime', 'between', [$the_day_before_yesterday, $unixToday])->field('content')->select();
        if ($imgLog) {
            foreach ($imgLog as $key => $item) {
                $imgList[$key] = $item->toArray();
            }
        }
        if ($imgDraft) {
            foreach ($imgDraft as $key => $item) {
                $imgDraftList[$key] = $item->toArray();
            }
        }
        if ($blog) {
            foreach ($blog as $key => $item) {
                $blogContentList[$key] = $item->toArray();
            }
        }
        if (isset($imgList) && isset($imgDraftList) && isset($blogContentList)) {
            foreach ($imgList as $key => $item) {
                foreach ($imgDraftList as $key_draft => $item_draft) {
                    if (!preg_match('/' . preg_quote($item['url']) . '/', $item_draft['content'], $demo)) {
                        foreach ($blogContentList as $key_content => $item_content) {
                            if (!preg_match('/' . preg_quote($item['url']) . '/', $item_content['content'], $demo2)) {
                                $clear[$key] = $item['url'];
                            }
                        }
                    }
                }
            }
        }
        $file = ROOT_PATH . 'public\uploads\index\temporary\\';
        if (isset($clear)) {
            foreach ($clear as $item) {
                if (file_exists($file . $item)) {
                    unlink($file . $item);
                    echo $item;
                }
            }
            echo 'successes';
        }
    }
}
