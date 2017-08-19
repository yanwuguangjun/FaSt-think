<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10 0010
 * Time: 9:35
 */

namespace app\index\controller;




use think\swoole\Server;

class Swoole extends Server
{
    /**
     * @此处server  是tcpsocket  无法用于直播 广播类
     */
    protected $host = '0.0.0.0';

    protected $port = '9502';

    protected $mode = SWOOLE_PROCESS;

    protected $sockType = WEBSOCKET_STATUS_CONNECTION;

    protected $option = [
        'worker_num' => 4,
        'demonize' => false,
        'backlog' => 128
    ];

    public function onReceive(\swoole_server $server, $fd, $form_id, $data)
    {
        $server->send($fd, '收到消息：' . $data.'来自：'.$form_id);
    }

}