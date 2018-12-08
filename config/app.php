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
 * 应用配置
 */
return [
    // 调试模式
    "debug"        => getenv("DEBUG"),
    // 守护进程
    "deamonize"    => getenv("DAEMONIZE"),
    // 服务类型，支持http，tcp，udp，websocket，分别对应server目录下的四个同名文件，可以自己扩展
    "server_type"  => getenv("SERVER_TYPE"),
    // 0.0.0.0表示对外公开访问，127.0.0.1表示本机访问
    "host"         => getenv("HOST"),
    // 服务端口号
    "port"         => getenv("PORT"),
    // 服务进程数
    "worker_num"   => getenv("WORKER_NUM"),
    // 强制路由模式
    "force_route"  => getenv("FORCE_ROUTE"),
    // 是否使用数据库
    "use_db"       => getenv("USE_DB"),
];