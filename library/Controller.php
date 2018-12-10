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

namespace FastSwoole\Library;

use think\Validate;

/**
 * 控制器基础支持
 * Class Controller
 * @package library
 */
class Controller
{

    protected $request;
    protected $response;
    protected $template;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->template = new Template(Config::get("template"));
    }

    /**
     * 获取get参数
     * @param $key
     * @param bool $default
     * @return bool
     */
    public function get($key, $default = false)
    {
        if (isset($this->request->get[$key])) {
            return $this->request->get[$key];
        } else {
            return $default;
        }
    }

    /**
     * 获取post参数
     * @param $key
     * @param bool $default
     * @return bool
     */
    public function post($key, $default = false)
    {
        if (isset($this->request->post[$key])) {
            return $this->request->post[$key];
        } else {
            return $default;
        }
    }

    /**
     * 获取所有请求参数
     * @return array
     */
    public function params()
    {
        $get = $this->request->get;
        $post = $this->request->post;
        !is_array($get) && $get = [];
        !is_array($post) && $post = [];
        $params = array_merge($get, $post);
        return $params;
    }

    /**
     * 获取头部信息
     * @param $key
     * @param bool $default
     * @return bool
     */
    public function header($key, $default = false)
    {
        if (isset($this->request->header[$key])) {
            return $this->request->header[$key];
        } else {
            return $default;
        }
    }

    /**
     * 获取上传文件
     * @param $key
     * @return bool
     */
    public function file($key)
    {
        if (isset($this->request->files[$key])) {
            return $this->request->files[$key];
        } else {
            return false;
        }
    }

    /**、
     * 重定向URL
     * @param $url
     * @param int $code
     */
    public function redirect($url, $code = 302)
    {
        $this->response->redirect($url, $code);
    }

    /**
     * html响应
     * @param $content
     */
    public function fetch($tpl, $array = [])
    {
        if (is_array($array) && count($array) > 0) {
            $this->template->assign($array);
        }
        return $this->template->fetch($tpl);
    }

    /**
     * 验证请求参数
     * @param array $rule | 验证规则
     * @return mixed
     */
    public function validate($rule = [])
    {
        $validate = Validate::make($rule);
        $params = self::params();
        if (!$validate->check($params)) {
            return $validate->getError();
        }
        return true;
    }

}