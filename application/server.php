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

/**
 * 应用服务核心
 */

namespace app;

use library\Config;
use library\Error;
use library\Log;
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
    $swoole_version = swoole_version();
    $php_version = phpversion();
    $fastSwoole_version = FASTSWOOLE_VERSION;
    $daemonize = $app['deamonize'] ? "true" : "false";
    $debug = $app['debug'] ? "true" : "false";
    echo <<<EOT
    
███████╗ █████╗ ███████╗████████╗  ███████╗██╗    ██╗ ██████╗  ██████╗ ██╗     ███████╗
██╔════╝██╔══██╗██╔════╝╚══██╔══╝  ██╔════╝██║    ██║██╔═══██╗██╔═══██╗██║     ██╔════╝
█████╗  ███████║███████╗   ██║     ███████╗██║ █╗ ██║██║   ██║██║   ██║██║     █████╗  
██╔══╝  ██╔══██║╚════██║   ██║     ╚════██║██║███╗██║██║   ██║██║   ██║██║     ██╔══╝  
██║     ██║  ██║███████║   ██║     ███████║╚███╔███╔╝╚██████╔╝╚██████╔╝███████╗███████╗
╚═╝     ╚═╝  ╚═╝╚══════╝   ╚═╝     ╚══════╝ ╚══╝╚══╝  ╚═════╝  ╚═════╝ ╚══════╝╚══════╝ 
main server         WEB_SERVER
debug               {$debug}
daemonize           {$daemonize}
listen address      {$app['host']}
listen port         {$app['port']}
worker num          {$app['worker_num']}
swoole version      {$swoole_version}
php version         {$php_version}
fastSwoole          {$fastSwoole_version}

EOT;
});

$http->on('request', function ($request, $response) {
    $response->header("content-type", "text/html; charset=utf-8");
    $start = getMicroTime();
    $path = $request->server['path_info'];
    $method = $request->server['request_method'];
    $query_string = isset($request->server["query_string"]) ? $request->server["query_string"] : "";
    Error::error($response);
    Route::route($path, $request, $response);
    $end = getMicroTime();
    $time = round($end - $start, 4);
    echo "{$method}: {$path}  {$query_string}  {$time}ms\n";
});

$http->start();