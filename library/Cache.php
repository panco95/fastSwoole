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

namespace library;

/**
 * 缓存支持
 * Class Cache
 * @package library
 */
class Cache
{

    /**
     * 设置缓存
     * @param $key
     * @param $val
     * @return bool
     */
    public static function set($key, $val)
    {
        return Container::cache()->set($key, ["val" => $val]);
    }

    /**
     * 获取缓存
     * @param $key
     * @return array|bool|string
     */
    public static function get($key)
    {
        return Container::cache()->get($key);
    }

    /**
     * 查询缓存是否存在
     * @param $key
     * @return bool
     */
    public static function exists($key)
    {
        return Container::cache()->exist($key);
    }

    /**
     * 删除缓存
     * @param $key
     * @return bool
     */
    public static function del($key)
    {
        return Container::cache()->del($key);
    }

}