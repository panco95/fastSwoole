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

/**
 * 框架基础容器管理
 * Class Container
 * @package library
 */
class Container
{

    private static $template = null;

    // 模板引擎
    public static function template()
    {
        if (self::$template === null) {
            self::$template = new Template(Config::get("template"));
        }
        return self::$template;
    }

}