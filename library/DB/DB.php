<?php

namespace FastSwoole\Library;

/**
 * 实际DB类（通常使用Db方法只需要调用Db外观类静态方法，无需创建本类并使用，请直接使用facade/Db）
 * Class Db
 * @package panco
 */
class DB
{

    /**
     * 默认连接池数量
     */
    const defaultPool = 1;

    /**
     * 存储单个或多个数据库连接
     * @var array
     */
    public $connect = array();

    /**
     * 默认数据库配置数组的key
     * @var null
     */
    public $defaultConnect = null;

    /**
     * 数据库配置
     * @var array
     */
    public $config = array();

    /**
     * 配置数据库并连接
     * @param $config @数据库配置，可一维数组（单连接）或者二维数组（多连接）
     */
    public function setConfig($config)
    {
        if (count($config) < 1) {
            die('At least one database config!');
        }

        if (isset($config['type']) && isset($config['host'])) {

            if (isset($config['pool'])) {
                $config['pool'] = (int)($config['pool']);
                $config < 1 ? $config['pool'] = $this::defaultPool : false;
            } else {
                $config['pool'] = $this::defaultPool;
            }

            // 根据连接池数量创建连接
            for ($p = 0; $p < $config['pool']; $p++) {
                $connector = new Connector($config['host'], $config['port'], $config['user'], $config['password'], $config['type'], $config['database'], $config['charset']);
                $this->connect[0][$p] = $connector->connect;
                $this->defaultConnect = 0;
            }

        } else {

            $i = 0;
            foreach ($config as $connect => &$db) {
                if (isset($db['pool'])) {
                    $db['pool'] = (int)($db['pool']);
                    $db < 1 ? $db['pool'] = $this::defaultPool : false;
                } else {
                    $db['pool'] = $this::defaultPool;
                }

                for ($p = 0; $p < $db['pool']; $p++) {
                    $connector = new Connector($db['host'], $db['port'], $db['user'], $db['password'], $db['type'], $db['database'], $db['charset']);
                    $this->connect[$connect][$p] = $connector->connect;
                }
                if ($i == 0) {
                    $this->defaultConnect = $connect;
                }
                $i++;
            }

        }

        $this->config = $config;
    }

    /**
     * 切换默认数据库
     * @param $connect @连接key
     */
    public function toggleConnect($connect)
    {
        if (isset($this->connect[$connect])) {
            $this->defaultConnect = $connect;
        }
    }

    /**
     * 执行数据库SQL语句
     * Select语句返回数组，Update、Delete、Insert返回bool
     * @param $sql @SQL语句
     * @param array $params @预编译参数数组，SQL语句中以 ? 符号替代参数，按此参数顺序预编译 ？
     * @param null $connect @多连接连接key，单个连接给此参数
     * @return array
     */
    public function query($sql, $params = array(), $connect = null)
    {
        if (is_null($connect)) {
            $connect = $this->defaultConnect;
        }

        if (isset($this->config[$connect]['pool'])) {
            $pool = $this->config[$connect]['pool'];
        } else {
            $pool = $this::defaultPool;
        }
        $poolKey = mt_rand(0, $pool - 1);  // 随机选取连接

        $stmt = $this->connect[$connect][$poolKey]->prepare($sql);
        if (is_array($params) && count($params) > 0) {
            foreach ($params as $k => &$param) {
                $param = addslashes($param);
                $stmt->bindParam(intval($k) + 1, $param);
            }
        }

        $operation = substr($sql, 0, 6);
        if ($operation == 'select') {
            $result = array();
            if ($stmt->execute($params)) {
                while ($row = $stmt->fetch()) {
                    foreach ($row as $k => $v) {
                        if (is_numeric($k)) {
                            unset($row[$k]);
                        }
                    }
                    array_push($result, $row);
                }
            }
            return $result;
        } else {
            return $stmt->execute($params);
        }
    }

    /**
     * ping所有数据库连接，防止断开
     */
    public function ping()
    {
        if (is_array($this->connect)) {
            foreach ($this->connect as $v) {
                if (is_array($v)) {
                    foreach ($v as $v2) {
                        $sql = "show tables like 'ping'";
                        $stmt = $v2->prepare($sql);
                        $stmt->execute();
                    }
                }
            }
        }
    }

}