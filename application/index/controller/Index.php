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
use app\index\service\Index as IndexService;

/**
 * Index控制器
 */
class Index extends Controller
{

    public $middleware = 'app\middleware\Check';  //控制器中间件

    //默认方法，简单开发演示
    public function index()
    {
        $id = $this->get("id", 0);  //获取个体请求参数id
        $id = IndexService::saveId($id);  //调取服务层
        return $this->fetch("tpl/welcome", ["name" => "开发", "id" => $id]);
    }

    //返回json
    public function intro()
    {
        return getMicroTime();
        return ["name" => "FastSwoole", "author" => "panco"];
    }

}