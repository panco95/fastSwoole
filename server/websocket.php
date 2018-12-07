<?php

use library\Config;
use library\Console;
use think\Db;

$app = Config::get("app");
$ws = new Swoole\WebSocket\Server($app['host'], $app['port']);
$ws->set([
    'worker_num' => $app['worker_num'],
    'daemonize' => $app['deamonize'],
    'pid_file' => ROOT_PATH . '/runtime/pids/websocket.pid',
    'heartbeat_check_interval' => 5,
    'heartbeat_idle_time' => 15,
]);

//管理进程开启
$ws->on('start', function () {
    Console::hello();
});

//服务进程开启，数量为worker_num
$ws->on('workerStart', function () {
    Db::setConfig(Config::get("db"));
    swoole_timer_tick(60 * 1000, function () {
        Db::query("show tables;");
    });
});

//新连接
$ws->on('open', function ($server, $request) {

});

//收到消息
$ws->on('message', function ($server, $frame) {
    var_dump($frame);
});

//有连接关闭
$ws->on('close', function ($ser, $fd) {

});

$ws->start();