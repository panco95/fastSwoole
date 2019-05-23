<?php

/**
 * 数据库配置
 */
return [
    // 类型（需PDO支持）
    'type'      => 'mysql',
    // 地址
    'host'      => '127.0.0.1',
    // 端口
    'port'      => 3306,
    // 用户名
    'user'      => 'root',
    // 密码
    'password'  => 'root',
    // 数据库名称
    'database'  => 'test',
    // 字符集
    'charset'   => 'utf8mb4',
    // 连接池数量
    'pool'      => 5
];


/*
 * 多个数据库连接配置示例
 * return [
    'default' => [
        'type'     => 'mysql',
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'user'     => 'root',
        'password' => 'root',
        'database' => 'public_temp',
        'charset'  => 'utf8mb4',
        'pool'     => 5,
    ],
    'app' => [
        'type'     => 'mysql',
        'host'     => '59b0edc3291e1.gz.cdb.myqcloud.com',
        'port'     => 5940,
        'user'     => 'root',
        'password' => 'rpgmoba@#2017',
        'database' => 'sdk_count',
        'charset'  => 'utf8mb4',
        'pool'     => 5
    ]
];
*/
