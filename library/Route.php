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
                $c = new $class($request, $response);
                //控制器中间件
                if (isset($c->middleware)) {
                    Route::middleware($c->middleware, $request, $response);
                }
                $c->$func($request, $response);
                unset($c);
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
            $r = $routes[$route];
            $methods = $r['method'];
            //路由中间件
            if (isset($r['middleware'])) {
                Route::middleware($r['middleware'], $request, $response);
            }
            if (in_array($request->server['request_method'], explode("|", $methods))) {
                $new_route = explode('/', $r['pathinfo']);
                self::path_info($new_route, $request, $response);
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

    /**
     * 中间件支持
     * @param $c
     * @param $request
     * @param $response
     */
    private static function middleware($middleware, $request, $response)
    {
        if (!class_exists($middleware)) {
            Error::response($request, $response, 500, "中间件不存在！");
        } else if (!method_exists($middleware, "handler")) {
            Error::response($request, $response, 500, "中间件handler方法不存在！");
        } else {
            $m = new $middleware();
            $m->handler($request, $response);
            unset($m);
        }
    }

}