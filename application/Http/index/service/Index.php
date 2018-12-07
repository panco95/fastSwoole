<?php

namespace app\Http\index\service;


class Index
{

    public static function saveId($id)
    {
        return md5($id);
    }

}