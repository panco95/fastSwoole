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
    'password'  => '0825',
    // 数据库名称
    'database'  => 'test1',
    // 字符集
    'charset'   => 'utf8mb4',
    // 连接池数量
    'pool'      => 5
];


/*
 * 多个数据库连接配置示例
return [
    'test1' => [
        // 类型（需PDO支持）
        'type'      => 'mysql',
        // 地址
        'host'      => '127.0.0.1',
        // 端口
        'port'      => 3306,
        // 用户名
        'user'      => 'root',
        // 密码
        'password'  => '0825',
        // 数据库名称
        'database'  => 'test1',
        // 字符集
        'charset'   => 'utf8mb4',
        // 连接池数量
        'pool'      => 5
    ],

    'test2' => [
        // 类型（需PDO支持）
        'type'      => 'mysql',
        // 地址
        'host'      => '127.0.0.1',
        // 端口
        'port'      => 3306,
        // 用户名
        'user'      => 'root',
        // 密码
        'password'  => '0825',
        // 数据库名称
        'database'  => 'test2',
        // 字符集
        'charset'   => 'utf8mb4',
        // 连接池数量
        'pool'      => 5
    ]
];
*/
