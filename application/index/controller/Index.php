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

use library\Controller;

/**
 * Index控制器
 */
class Index extends Controller
{

    //public $middleware = 'app\middleware\Check';

    /**
     * 默认路由index方法
     */
    public function index()
    {
        \library\Config::get("app","");
        $this->fetch("tpl/welcome", ["name" => "开发"]);
    }

    /**
     * json响应
     *
     */
    public function intro()
    {
        $this->json(["name" => "FastSwoole", "author" => "panco"]);
    }

}