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
    'index/test' => [
        "method" => "GET",
        "pathinfo" => "index/index/index"
    ],
    "readme" => [
        "method" => "GET|POST",
        "pathinfo" => "index/index/readme"
    ],
    "login" => [
        "method" => "POST",
        "pathinfo" => "index/user/login"
    ],
    "register" => [
        "method" => "POST",
        "pathinfo" => "index/user/register"
    ]
];