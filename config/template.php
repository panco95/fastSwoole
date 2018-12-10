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
 * 模板引擎配置项
 */
return [
    // 模板文件路径
    'view_path'      => ROOT_PATH . '/views/',
    // 模板缓存路径
    'cache_path'     => ROOT_PATH . '/runtime/template/',
    // 模板后缀名
    'view_suffix'    => env("VIEW_SUFFIX","html")
];