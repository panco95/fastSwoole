<?php

namespace App\Http\index\controller;

use FastSwoole\Library\Controller;

/**
 * Index控制器
 */
class Index extends Controller
{

    //public $middleware = '\App\Http\middleware\Check';  //控制器中间件

    public function index()
    {
        return "FastSwoole<br>Version：1.1.0<br>Document：<a href='https://www.kancloud.cn/panco/panco/864408'>https://www.kancloud.cn/panco/panco/864408</a><br>Github：<a href='https://github.com/panco95/fastSwoole'>https://github.com/panco95/fastSwoole</a><br>Author：<a href='https://github.com/panco95'>Panco</a><br>";
    }

}