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
        return self::custom($path_arr, $request, $response);
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
            $class = "\app\Http\\" . $module . "\\controller\\" . $path_arr[1];
            $func = $path_arr[2];
            if (!class_exists($class)) {
                Error::response($request, $response, 404, "控制器不存在！");
            } else if (!method_exists($class, $func)) {
                Error::response($request, $response, 404, "方法不存在！");
            } else {
                $c = new $class($request, $response);
                isset($c->middleware) && self::middleware($c->middleware, $request, $response, "before");
                $result = $c->$func($request, $response);
                isset($c->middleware) && self::middleware($c->middleware, $request, $response, "after");
                unset($c);
                return $result;
            }
        } else {
            Error::response($request, $response, 404, "找不到页面！");
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
        $route == "" && $route = "/";
        $routes = require(ROOT_PATH . '/route/http.php');
        if (key_exists($route, $routes)) {
            $r = $routes[$route];
            $methods = $r[1];
            if ($methods == "*" || in_array($request->server['request_method'], explode("|", $methods))) {
                $new_route = explode('/', $r[0]);
                isset($r[2]) && self::middleware($r[2], $request, $response, "before");
                $result = self::path_info($new_route, $request, $response);
                isset($r[2]) && self::middleware($r[2], $request, $response, "after");
                return $result;
            } else {
                Error::response($request, $response, 404, "找不到页面！");
            }
        } else {
            $force_route = Config::get("app", "force_route");
            if ($force_route === 0) {
                return self::path_info($path_arr, $request, $response);
            } else {
                Error::response($request, $response, 404, "找不到页面！");
            }
        }
    }

    /**
     * 中间件支持
     * @param $c
     * @param $request
     * @param $response
     */
    private static function middleware($middleware, $request, $response, $func)
    {
        if (class_exists($middleware) && method_exists($middleware, $func)) {
            $m = new $middleware();
            $m->$func($request, $response);
            unset($m);
        }
    }

    /**
     * 执行过程
     * @param $path
     * @param $request
     * @param $response
     */
    public static function work($path, $request, $response)
    {
        $result = self::route($path, $request, $response);
        if (is_array($result)) {
            $result = json_encode($result);
        } else if (is_bool($result)) {
            $result = (string)$result;
        }
        if (is_string($result) || is_numeric($result)) {
            $response->end($result);
        }
    }

}