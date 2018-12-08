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

namespace App\Http\index\controller;

use FastSwoole\Library\Controller;

/**
 * Index控制器
 */
class Index extends Controller
{

    public $middleware = '\App\Http\middleware\Check';  //控制器中间件

    public function index()
    {
        return $this->fetch("tpl/welcome", ["name" => "开发"]);
    }

    public function hello()
    {
        return "hello world";
    }

}