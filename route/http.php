<?php

//Http服务自定义路由

return [
    /*第一个参数为执行的模块/控制/方法，第二个参数请求方式(多个方式用|分割，不限制用*)，第三个参数中间件完整命名空间
        '/' => ["index/index/index", "*", "\App\Http\middleware\Check"],
        '/' => ["index/index/index", "GET|POST", "\App\Http\middleware\Check"],
        '/' => ["index/index/index", "GET", "\App\Http\middleware\Check"],
    */

    '/' => ["index/index/index", "*"]
];