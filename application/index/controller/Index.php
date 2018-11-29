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

namespace app\index\controller;

use library\Container;
use library\Controller;

/**
 * Index控制器示例
 * Class Index
 * @package app\index\controller
 */
class Index extends Controller
{

    /**
     * 默认路由index方法
     * @param $request
     * @param $response
     */
    public function index($request, $response)
    {
        $response->end(Container::template()->fetch("tpl/welcome"));
    }

}