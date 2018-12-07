<?php

use library\Config;
use library\Console;
use think\Db;

$app = Config::get("app");
$tcp = new Swoole\Server($app['host'], $app['port'], SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
$tcp->set(array(
    'worker_num' => $app['worker_num'],
    'daemonize' => $app['deamonize'],
    'pid_file' => ROOT_PATH . '/runtime/pids/tcp.pid',
    'heartbeat_check_interval' => 5,
    'heartbeat_idle_time' => 15,
));

//管理进程开启
$tcp->on('Start', function ($server) {
    Console::hello();
});

//服务进程开启，数量为worker_num
$tcp->on('WorkerStart', function ($server, $worker_id) {
    Db::setConfig(Config::get("db"));
    swoole_timer_tick(60 * 1000, function () {
        Db::query("show tables;");
    });
});

//新连接
$tcp->on('Connect', function ($server, $fd, $reactorId) {

});

//收到消息
$tcp->on('Receive', function ($server, $fd, $reactor_id, $data) {
    var_dump($data);
});

//有连接关闭
$tcp->on('Close', function ($server, $fd, $reactorId) {

});

$tcp->start();