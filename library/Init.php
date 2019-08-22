<?php

namespace FastSwoole\Library;

use panco\facade\DB;

class Init
{

    // 服务启动初始化：这里可以初始化数据库、缓存等支持库连接
    public static function http()
    {
        $use_db = Config::get("app", "use_db");
        if ($use_db == 1) {
            DB::setConfig(Config::get("db"));
            swoole_timer_tick(10 * 1000, function () {
                DB::ping();
            });
        }
    }

}