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
define("ROOT_PATH", __DIR__);
define("APP_PATH", ROOT_PATH . "/application");
define("FASTSWOOLE_VERSION", "1.0.0");
require_once APP_PATH . "/common.php";
require_once ROOT_PATH . "/vendor/autoload.php";
require_once ROOT_PATH . "/config/app.php";
require_once ROOT_PATH . "/library/Route.php";

//自动载入
spl_autoload_register(function ($class) {
    $class = ROOT_PATH . "/" . str_replace("App", "application", str_replace("\\", "/", $class)) . ".php";
    if (file_exists($class)) {
        require_once $class;
    } else {
        $class = str_replace("FastSwoole/Library", "library", str_replace("\\", "/", $class));
        if (file_exists($class)) {
            require_once $class;
        }
    }
});

//环境配置
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();