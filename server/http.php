<?php

use FastSwoole\Library\Config;
use FastSwoole\Library\Error;
use FastSwoole\Library\Route;
use FastSwoole\Library\Console;
use think\Db;

$app = Config::get("app");
$http = new Swoole\Http\Server($app['host'], $app['port']);
$http->set([
    'document_root' => ROOT_PATH . '/public',
    'enable_static_handler' => true,
    'worker_num' => $app['worker_num'],
    'daemonize' => $app['deamonize'],
    'pid_file' => ROOT_PATH . '/runtime/pids/http.pid',
    'upload_tmp_dir' => ROOT_PATH . '/public/uploads'
]);

//管理进程开启
$http->on('start', function () {
    Console::hello();
});

//服务进程开启，数量为worker_num
$http->on('workerStart', function () {
    $use_db = Config::get("app", "use_db");
    if ($use_db) {
        Db::setConfig(Config::get("db"));
        swoole_timer_tick(60 * 1000, function () {
            Db::query("show tables;");
        });
    }
});

//收到http请求
$http->on('request', function ($request, $response) use ($http) {
    Error::error($request, $response);
    $response->header("content-type", "text/html; charset=utf-8");
    $start = getMicroTime();
    $path = $request->server['path_info'];
    $method = $request->server['request_method'];
    $query_string = isset($request->server["query_string"]) ? $request->server["query_string"] : "";
    Route::work($path, $request, $response);
    $end = getMicroTime();
    $time = round($end - $start, 4);
    echo "{$method}: {$path}  {$query_string}  {$time}ms\n";
});

$http->start();