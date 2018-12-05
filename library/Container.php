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

namespace library;

use Medoo\Medoo;

/**
 * 框架基础容器管理
 * Class Container
 * @package library
 */
class Container
{

    private static $template = null;
    private static $db = null;
    private static $cache = null;

    // 模板引擎
    public static function template()
    {
        if (self::$template === null) {
            self::$template = new Template(Config::get("template"));
        }
        return self::$template;
    }

    // 数据库
    public static function db()
    {
        if (self::$db === null) {
            self::$db = new Medoo(Config::get("db"));
            swoole_timer_tick(60 * 1000, function () {
                Container::db()->query("show tables;");
            });
        }
        return self::$db;
    }

    // 缓存
    public static function cache()
    {
        if (self::$cache === null) {
            self::$cache = new \swoole_table(Config::get("app", "max_cache_size"));
            self::$cache->column('val', \swoole_table::TYPE_STRING, 1024);
            self::$cache->create();
        }
        return self::$cache;
    }

}