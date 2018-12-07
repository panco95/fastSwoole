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

namespace FastSwoole\Library;

use Swoole\Http\Response;

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
    public static function error($request, $response)
    {
        register_shutdown_function(function () use ($request, $response) {
            if ($error = error_get_last()) {
                $message = "File：{$error['file']}，Line：{$error['line']}，Message：" . $error['message'] . "\n";
                \library\Log::write($message, "Error", 1);
                Error::response($request, $response, 500, "Line {$error['line']} at {$error['file']}：" . $error['message']);
            }
        });
    }

    /**
     * 统一路由错误响应
     * @param $response
     * @param int $code
     * @param string $message
     */
    public static function response($request, $response, $code = 404, $message = "error!")
    {
        $debug = Config::get("app", "debug");
        false === $debug && $message = "调试模式未开启！";
        $template = new Template(Config::get("template"));
        $template->assign(["code" => $code, "message" => $message]);
        //重新创建响应，防止错误处理可能出现request is finish
        $response->detach();
        $new_response = Response::create($request->fd);
        $new_response->end($template->fetch("tpl/error"));
        unset($template);
    }

}