<?php
/**
 * Created by PhpStorm.
 * User: Panco
 * Date: 2018/12/5/005
 * Time: 下午 2:04
 */

namespace app\index\service;


class Index
{

    public static function saveId($id)
    {
        return md5($id);
    }

}