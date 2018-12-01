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

namespace library;

/**
 * 控制器基础支持
 * Class Controller
 * @package library
 */
class Controller
{

    private $request;
    private $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
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
     * 获取服务器信息，相当于$_SERVER
     * @param $key
     * @param bool $default
     * @return bool
     */
    public function server($key, $default = false)
    {
        if (isset($this->request->server[$key])) {
            return $this->request->server[$key];
        } else {
            return $default;
        }
    }

    /**
     * 获取cookie
     * @param $key
     * @param bool $default
     * @return bool
     */
    public function cookie($key, $default = false)
    {
        if (isset($this->request->cookie[$key])) {
            return $this->request->cookie[$key];
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
        if (isset($this->request->cookie[$key])) {
            return $this->request->files[$key];
        } else {
            return false;
        }
    }

    /**
     * 获取原始内容
     * @return mixed
     */
    public function rawContent()
    {
        return $this->rawContent();
    }

    /**
     * 获取原始HTTP报文
     * @return mixed
     */
    public function getData()
    {
        return $this->request->getData();
    }

    /**
     * 设置返回header
     * @param $key
     * @param $val
     */
    public function setHeader($key, $val)
    {
        $this->response->header($key, $val);
    }

    /**
     * 设置返回cookie
     * @param $key
     * @param $val
     * @param int $expire
     */
    public function setCookie($key, $val, $expire = 0)
    {
        $this->response->cookie($key, $val, $expire, $path = ROOT_PATH . "/runtime/cookie");
    }

    /**
     * 返回带状态吗响应
     * @param $code
     */
    public function status($code)
    {
        $this->response->status($code);
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
     * 返回响应
     * @param $content
     */
    public function view($content)
    {
        $this->response->end($content);
    }

    /**
     * 响应文件
     * @param $filename
     */
    public function sendFile($filename)
    {
        $this->response($filename);
    }

}