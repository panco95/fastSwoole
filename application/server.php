<?php
// +----------------------------------------------------------------------
// | fastSwoole [ WE CAN FAST MORE AND MORE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://fastSwoole.iorip.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Panco <1129443982@qq.com>
// +----------------------------------------------------------------------

namespace app;

use library\Config;
use library\Route;
use Swoole\Http\Server;

$app = Config::get("app");

$http = new Server($app['host'], $app['port']);

$http->set([
    'document_root' => ROOT_PATH . '/public',
    'enable_static_handler' => true,
    'worker_num' => $app['worker_num'],
    'daemonize' => $app['deamonize']
]);

$http->on('start', function () use ($http, $app) {
    echo "WebServer is run at " . $app['host'] . ":" . $app['port'] . "\n";
    echo "WorkerNum: {$http->setting['worker_num']}\n\n";
});

$http->on('request', function ($request, $response) {
    $start = getMicroTime();
    $path = $request->server['path_info'];
    $method = $request->server['request_method'];
    $query_string = isset($request->server["query_string"]) ? $request->server["query_string"] : "";
    Route::route($path, $request, $response);
    $end = getMicroTime();
    $time = round($end - $start, 4);
    echo "{$method}: {$path}  {$query_string}  {$time}ms\n";
});

$http->start();