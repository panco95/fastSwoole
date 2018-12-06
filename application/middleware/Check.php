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

namespace app\middleware;

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
        echo "this is before middleware\n";
    }

    /**
     * 中间件后置方法
     * @param $request
     * @param $response
     */
    public function after($request, $response)
    {
        echo "this is after middleware\n";
    }

}