<?php

namespace FastSwoole\Library\DB\Facade;

/**
 * DB单例外观类
 * @see \FastSwoole\Library\DB
 * @mixin \FastSwoole\Library\DB
 * @method mixed toggleConnect(string $connect = '') static 切换默认连接
 * @method mixed query(string $sql = '', mixed $params = array(), string $connect = '') static 执行SQL语句
 * @method mixed ping static ping所有连接，防止连接断开
 */
class DB
{

    /**
     * 保存单例Db类
     * @var null
     */
    private static $db = null;

    /**
     * 不允许实例化此类，只能使用静态方法
     * Db constructor.
     */
    private function __construct()
    {
    }

    /**
     * 配置数据库参数
     * @param $dbs @数据库配置，可一维数组（单连接）或者二维数组（多连接）
     */
    public static function setConfig($dbs)
    {
        self::checkDbInstance();
        self::$db->setConfig($dbs);
    }

    /**
     * 调用实际Db类非静态方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        self::checkDbInstance();
        return self::$db->$name(...$arguments);
    }

    /**
     * 检查实际Db类是否已经创建
     */
    private static function checkDbInstance()
    {
        if (!self::$db instanceof \FastSwoole\Library\DB) {
            self::$db = new \FastSwoole\Library\DB();
        }
    }

}