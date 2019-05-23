<?php

define("ROOT_PATH", __DIR__);
define("APP_PATH", ROOT_PATH . "/application");
define("FASTSWOOLE_VERSION", "1.1.0");
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

// 时区配置
date_default_timezone_set('Asia/Shanghai');

// 读取配置
global $fsConfig;
$fsConfig = parse_ini_file(ROOT_PATH . "/config.ini", true);