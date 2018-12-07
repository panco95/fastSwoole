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

namespace FastSwoole\Library;

class Console
{

    public static function hello()
    {
        $app = Config::get("app");
        $server_type = $app['server_type'];
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
server type         {$server_type}_SERVER
debug               {$debug}
daemonize           {$daemonize}
listen address      {$app['host']}
listen port         {$app['port']}
worker num          {$app['worker_num']}
force route         {$app['force_route']}
swoole version      {$swoole_version}
php version         {$php_version}
fastSwoole          {$fastSwoole_version}

EOT;
    }

}