<?php

namespace App\Http\middleware;

/**
 * 中间件示例
 */
class Check
{

    /**
     * 中间件前置方法
     * @param $request
     * @param $response
     */
    public function before($request, $response)
    {
        echo "Check middleware: before\n";
    }

    /**
     * 中间件后置方法
     * @param $request
     * @param $response
     */
    public function after($request, $response)
    {
        echo "Check middleware: after\n";
    }

}