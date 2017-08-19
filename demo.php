<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8 0008
 * Time: 15:52
 */

$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
    swoole_timer_tick(1000, function () use ($server, $request) {
        $server->push($request->fd, '你好！'.$request->fd);
    });
});

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();


//$server_2 = new swoole_websocket_server("0.0.0.0", 9502);
//
//$server_2->on('open', function (swoole_websocket_server $server_2, $request) {
//    echo "server: handshake success with fd{$request->fd}\n";
//    swoole_timer_tick(1000, function () use ($server_2, $request) {
//        $server_2->push($request->fd, '你好我是老二');
//    });
//});
//
//$server_2->on('message', function (swoole_websocket_server $server_2, $frame) {
//    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
//    $server_2->push($frame->fd, "this is server");
//});
//
//$server_2->on('close', function ($ser, $fd) {
//    echo "client {$fd} closed\n";
//});
//
//$server_2->start();



//下面的是tcp的socket

//$serv = new swoole_server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);
//
//$serv->set(array(
//    'worker_num' => 4,
//    'daemonize' => false,
//    'backlog' => 128,
//));
//
//
//$serv->on('Connect', function (swoole_server $request) use($serv) {
//    $serv->send($request->fd,'hello');
////    echo '脸上了';
//});
//
//$serv->on('Receive', function ()use($serv) {
////    $serv->send($request->fd, '你好',  0);
//});
//
//$serv->on('Close', function () {
//
//});
//
//$serv->start();