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
 * 错误处理
 * Class Error
 * @package library
 */
class Error
{

    /**
     * 错误页面渲染
     * @param $response
     */
    public static function error($response)
    {
        register_shutdown_function(function () use ($response) {
            if ($error = error_get_last()) {
                $message = "File：{$error['file']}，Line：{$error['line']}，Message：" . $error['message'] . "\n";
                \library\Log::write($message, "Error");
                $response->end("Error：<br>File：{$error['file']}<br>Line：{$error['line']}<br>Message：{$error['message']}");
            }
        });
    }

}