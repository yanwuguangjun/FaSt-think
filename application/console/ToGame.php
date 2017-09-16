<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15 0015
 * Time: 13:36
 */

namespace app\console;
//命令行核心
//核心
use think\console\Input;
//核心
use think\console\Output;

use app\console\Common;
use \swoole\server;
use Predis\Client;
use think\Config;
use think\Controller;
use think\Session;

class ToGame extends Common
{

    //命令行配置函数
    protected function configure()
    {
        $this->setName('toGame:start')->setDescription('start Web Server Server!');
        //        parent::configure(); // TODO: Change the autogenerated stub
    }


    protected function execute(Input $input, Output $output)
    {

//        echo $this->getRandArrayNum(91);
        echo $this->check_rand(90,1000);

    }

    public function check_rand($win,$number = 100)
    {
        $arr = [];
        for ($i = 0; $i < $number; $i++) {
            $num = $this->getRandArrayNum($win);
            if ($num == 1) {
                array_push($arr,$num);
            }
        }
        return count($arr);
    }

    public function getRandArrayNum(int $number): int
    {
        if ($number > 90 || $number < 20) {
            $number = 50;
        }
        $arr = [];
        $max = 100;
        $ob_arr = [10, 5, 4, 2];
        foreach ($ob_arr as $item) {
            if ($number % $item == 0) {
                $number = $number / $item;
                $max = $max / $item;
                break;
            }
        }
        for ($i = 0; $i < $number; $i++) {
            $arr[$i] = 1;
        }
        for ($i = $number; $i < $max; $i++) {
            $arr[$i] = 0;
        }
        $key = array_rand($arr);
        return $arr[$key];
    }

    public function onStart()
    {

    }

    public function onWorkerStart()
    {


    }

    public function onConnect()
    {

    }


    public function onOpen(\swoole_websocket_server $server, \swoole_http_request $request)
    {
    }


    public function onMessage(\swoole_websocket_server $server, \swoole_websocket_frame $frame)
    {


    }

    //指的是客户端关闭
    public function onClose(\swoole_websocket_server $server, $fd)
    {

    }

}