<?php

namespace FastSwoole\Library;

/**
 * 数据库连接类（PDO）
 * Class Connector
 * @package panco
 */
class Connector
{

    /**
     * 存储数据库连接
     * @var \PDO|null
     */
    public $connect = null;

    /**
     * 连接数据库
     * Connector constructor.
     * @param $host      @数据库地址
     * @param $port      @数据库端口
     * @param $user      @数据库用户名
     * @param $password  @数据库密码
     * @param $type      @数据库类型，mysql测试通过
     * @param $database  @数据库名称
     * @param $charset   @数据库编码，推荐utf8
     */
    public function __construct($host, $port, $user, $password, $type, $database, $charset = 'utf8')
    {
        try {
            $dbh = new \PDO("{$type}:host={$host};port={$port};charset={$charset};dbname={$database}", $user, $password);
            $this->connect = $dbh;
        } catch (\Exception $e) {
            die(ucfirst($type) . " connect Error: " . $e->getMessage());
        }
    }

}