<?php

namespace FastSwoole\Library;

class Console
{

    public static function hello()
    {
        $app = Config::get("app");
        $server_type = $app['type'];
        $swoole_version = swoole_version();
        $php_version = phpversion();
        $fastSwoole_version = FASTSWOOLE_VERSION;
        $app['debug'] = intval($app['debug']);
        echo <<<EOT
    
███████╗ █████╗ ███████╗████████╗  ███████╗██╗    ██╗ ██████╗  ██████╗ ██╗     ███████╗
██╔════╝██╔══██╗██╔════╝╚══██╔══╝  ██╔════╝██║    ██║██╔═══██╗██╔═══██╗██║     ██╔════╝
█████╗  ███████║███████╗   ██║     ███████╗██║ █╗ ██║██║   ██║██║   ██║██║     █████╗  
██╔══╝  ██╔══██║╚════██║   ██║     ╚════██║██║███╗██║██║   ██║██║   ██║██║     ██╔══╝  
██║     ██║  ██║███████║   ██║     ███████║╚███╔███╔╝╚██████╔╝╚██████╔╝███████╗███████╗
╚═╝     ╚═╝  ╚═╝╚══════╝   ╚═╝     ╚══════╝ ╚══╝╚══╝  ╚═════╝  ╚═════╝ ╚══════╝╚══════╝ 
type                 {$server_type}
debug                {$app['debug']}
daemon               0
listen address       {$app['host']}
listen port          {$app['port']}
workers              {$app['workers']}
swoole version       {$swoole_version}
fastSwoole vwesion   {$fastSwoole_version}
php version          {$php_version}

EOT;
    }

}