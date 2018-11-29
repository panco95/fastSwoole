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

return [
    "debug" => true,
    "deamonize" => false,
    "host" => "0.0.0.0",
    "port" => 8888,
    "worker_num" => 8,
    "default_route" => ['index', 'index', 'index'],  //默认路由
    "force_route" => 0,  //强制路由模式，1开启，0关闭
];