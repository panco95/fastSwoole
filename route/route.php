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

//自定义路由

return [
    '' => [
        "method" => "GET|POST",
        "pathinfo" => "index/index/index",
        "middleware" => "\app\middleware\Check"  //路由中间件
    ],
    "intro" => [
        "method" => "GET|POST",
        "pathinfo" => "index/index/intro"
    ]
];