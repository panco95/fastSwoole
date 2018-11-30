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
 * 路由支持
 * Class Route
 * @package library
 */
Class Route
{

    /**
     * 路由基础方法
     * @param $path
     * @param $request
     * @param $response
     */
    public static function route($path, $request, $response)
    {
        $path_arr = explode("/", substr($path, 1));
        self::custom($path_arr, $request, $response);
    }

    /**
     * path_info路由模式支持
     * @param $path_arr
     * @param $request
     * @param $response
     */
    private static function path_info($path_arr, $request, $response)
    {
        if (count($path_arr) === 3) {
            $module = $path_arr[0];
            $path_arr[1][0] = strtoupper($path_arr[1][0]);
            $class = "\app\\" . $module . "\\controller\\" . $path_arr[1];
            $func = $path_arr[2];
            if (!class_exists($class)) {
                Error::response($request, $response, 404, "控制器不存在！");
            } else if (!method_exists($class, $func)) {
                Error::response($request, $response, 404, "方法不存在！");
            } else {
                call_user_func_array([$class, $func], [$request, $response]);
            }
        } else {
            Error::response($request, $response, 404, "路由不存在！");
        }
    }

    /**
     * 自定义路由支持
     * @param $path_arr
     * @param $request
     * @param $response
     */
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
                Error::response($request, $response, 404, "路由不存在！");
            }
        } else {
            $force_route = Config::get("app", "force_route");
            if ($force_route === 0) {
                self::path_info($path_arr, $request, $response);
            } else {
                Error::response($request, $response, 404, "路由不存在！");
            }
        }
    }

}