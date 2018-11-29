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
        self::custom($path_arr, $request, $response);
    }


    private static function path_info($path_arr, $request, $response)
    {
        if (count($path_arr) === 3) {
            $module = $path_arr[0];
            $path_arr[1][0] = strtoupper($path_arr[1][0]);
            $class = "\app\\" . $module . "\\controller\\" . $path_arr[1];
            $func = $path_arr[2];
            if (!class_exists($class)) {
                self::error($response, 404, "控制器不存在！");
            } else if (!method_exists($class, $func)) {
                self::error($response, 404, "方法不存在！");
            } else {
                call_user_func_array([$class, $func], [$request, $response]);
            }
        } else {
            self::error($response, 404, "路由不存在！");
        }
    }


    private static function custom($path_arr, $request, $response)
    {
        $route = join("/", $path_arr);
        $routes = require(ROOT_PATH . '/route/route.php');
        if (key_exists($route, $routes)) {
            $temp = $routes[$route];
            $methods = $temp['method'];
            if (in_array($request->server['request_method'], explode("|", $methods))) {
                $new_array = explode('/', $temp['pathinfo']);
                self::path_info($new_array, $request, $response);
            } else {
                self::error($response, 404, "路由不存在！");
            }
        } else {
            $force_route = Config::get("app", "force_route");
            if ($force_route === 0) {
                self::path_info($path_arr, $request, $response);
            } else {
                self::error($response, 404, "路由不存在！");
            }
        }
    }


    private static function error($response, $code = 404, $message = "error!")
    {
        Container::template()->assign(["code" => $code, "message" => $message]);
        $response->end(Container::template()->fetch("tpl/error"));
    }

}