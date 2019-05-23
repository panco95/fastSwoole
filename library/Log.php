<?php

namespace FastSwoole\Library;

/**
 * 日志
 * Class Log
 * @package library
 */
class Log
{

    /**
     * 记录日志
     * @param string $data：日志内容
     * @param string $code：日志标识
     * @param int $is_error：是否错误日志
     */
    public static function write($data = "", $code = "log", $is_error = 0)
    {
        if (!is_dir(ROOT_PATH . "/runtime/log")) mkdir(ROOT_PATH . "/runtime/log", 0777);
        $year_month = date("Y-m", time());
        if (!is_dir(ROOT_PATH . "/runtime/log/{$year_month}")) mkdir(ROOT_PATH . "/runtime/log/{$year_month}", 0777);
        $day = date("d", time());
        if (is_array($data)) $data = json_encode($data);
        $time = date("Y-m-d H:i:s", time());
        $filename = "/runtime/log/{$year_month}/{$day}.log";
        $is_error && $filename = "/runtime/log/{$year_month}/{$day}_error.log";
        file_put_contents(ROOT_PATH . $filename, "[$time][$code]：{$data}\n", FILE_APPEND);
    }

}