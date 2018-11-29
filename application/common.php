<?php
/**
 * 应用公共函数
 */

namespace app;

/**
 * 获取微秒级时间戳
 * @return float
 */
function getMicroTime()
{
    list($usec, $sec) = explode(" ", microtime());
    return (float)$usec + (float)$sec;
}