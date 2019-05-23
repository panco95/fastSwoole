<?php

namespace FastSwoole\Library;

/**
 * 配置支持
 * Class Config
 * @package library
 */
class Config
{

    /**
     * 获取config目录某个配置项
     * @param $config
     * @param bool $key
     * @return mixed
     */
    public static function get($config, $key = false)
    {
        $config = require ROOT_PATH . "/config/{$config}.php";
        if (false === $key) {
            return $config;
        } else {
            return $config[$key];
        }
    }

}