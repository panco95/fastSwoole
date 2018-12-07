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

// 应用公共函数

/**
 * 获取微秒级时间戳
 * @return float
 */
function getMicroTime()
{
    list($usec, $sec) = explode(" ", microtime());
    return (float)$usec + (float)$sec;
}