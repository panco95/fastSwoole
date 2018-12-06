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
    //第一个参数为执行的模块/控制/方法，第二个参数请求方式(多个方式用|分割)，第三个参数中间件完整命名空间
    '/' => ["index/index/index", "*", "\app\middleware\Check"],
    'intro' => ["index/index/intro", "*"],
    'tell' => ["index/index/tell", "GET"],
];