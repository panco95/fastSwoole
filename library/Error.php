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
                $debug = Config::get("app", "debug");
                $message = "File：{$error['file']}，Line：{$error['line']}，Message：" . $error['message'] . "\n";
                \library\Log::write($message, "Error");
                if (true === $debug) {
                    Container::template()->assign(["code" => 500, "message" => "Line {$error['line']} at {$error['file']}：" . $error['message']]);
                    $response->end(Container::template()->fetch("tpl/error"));
                } else {
                    Container::template()->assign(["code" => 500, "message" => "调试模式未开启！"]);
                    $response->end(Container::template()->fetch("tpl/error"));
                }
            }
        });
    }

}