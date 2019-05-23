<?php

/**
 * 应用配置
 */
global $fsConfig;

return [
    // 调试模式
    "debug"        => $fsConfig['SERVER']['DEBUG'],
    // 守护进程
    "daemon"       => $fsConfig['SERVER']['DAEMON'],
    // 服务类型，支持http，tcp，udp，websocket，分别对应server目录下的四个同名文件，可以自己扩展
    "type"         => $fsConfig['SERVER']['TYPE'],
    // 0.0.0.0表示对外公开访问，127.0.0.1表示本机访问
    "host"         => $fsConfig['SERVER']['HOST'],
    // 服务端口号
    "port"         => $fsConfig['SERVER']['PORT'],
    // 服务进程数
    "workers"      => $fsConfig['SERVER']['WORKERS'],
    // 是否使用数据库
    "use_db"       => $fsConfig['SERVER']['USE_DB'],
];