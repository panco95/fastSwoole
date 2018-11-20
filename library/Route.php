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

Class Route
{

    public static function route($path, $request, $response)
    {
        if ($path === "/") {
            $path_arr = Config::get("app", "default_route");
        } else {
            $path_arr = explode("/", substr($path, 1));
        }
        if (count($path_arr) === 3) {
            $module = $path_arr[0];
            $path_arr[1][0] = strtoupper($path_arr[1][0]);
            $class = "\app\\" . $module . "\\controller\\" . $path_arr[1];
            $func = $path_arr[2];
            try {
                if (!class_exists($class)) {
                    Container::template()->assign(["code" => "404", "message" => "Class类不存在!"]);
                    $response->end(Container::template()->fetch("tpl/error"));
                } else if (!method_exists($class, $func)) {
                    Container::template()->assign(["code" => "404", "message" => "Function方法不存在!"]);
                    $response->end(Container::template()->fetch("tpl/error"));
                } else {
                    call_user_func_array([$class, $func], [$request, $response]);
                }
            } catch (\Exception $e) {
                Container::template()->assign(["code" => "500", "message" => "服务器内部错误!"]);
                $response->end(Container::template()->fetch("tpl/error"));
            }
            //}
        } else {
            Container::template()->assign(["code" => "500", "message" => "PathInfo不完整，完整格式：模块/控制器/方法！"]);
            $response->end(Container::template()->fetch("tpl/error"));
        }
    }

}