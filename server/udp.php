<?php

use library\Config;
use library\Console;
use think\Db;

$app = Config::get("app");
$udp = new Swoole\Server($app['host'], $app['port'], SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
$udp->set(array(
    'worker_num' => $app['worker_num'],
    'daemonize' => $app['deamonize'],
    'pid_file' => ROOT_PATH . '/runtime/pids/tcp.pid'
));

//管理进程开启
$udp->on('Start', function ($server) {
    Console::hello();
});

//服务进程开启，数量为worker_num
$udp->on('WorkerStart', function ($server, $worker_id) {
    Db::setConfig(Config::get("db"));
    swoole_timer_tick(60 * 1000, function () {
        Db::query("show tables;");
    });
});

//收到消息
$udp->on('Packet', function ($server, $data, $client_info) {
    var_dump($data);
});

$udp->start();