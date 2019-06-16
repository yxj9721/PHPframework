<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/7
 * Time: 14:33
 */

namespace core\lib;

class route
{
    public $ctrl;
    public $action;

    public function __construct()
    {
        //当访问xxx.com/index/index的时候,请求的是index控制器里的index方法
        //实际的路径是xxx.com/index.php/index/index,在Apache的路由重写模块里面,将请求加上index.php
        //然后除xxx.com/index.php之外的其他URL参数,在获取后将进行处理.
        //关于请求获取方式主要通过全局函数$_SERVER
        /**
         * (1)隐藏index.php
         * (2)获取URL的参数
         * (3)返回对应的控制器和方法
         */
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
            $uriArr = explode('/', $uri);
            if (isset($uriArr[0])) {
                $this->ctrl = $uriArr[0] . 'Controller';
                unset($uriArr[0]);
            }

            if (isset($uriArr[1])) {
                $this->action = $uriArr[1];
                unset($uriArr[1]);
            } else {
                $this->action = conf::get('ACTION', 'route');
            }

            $count = count($uriArr) + 2;
            $i = 2;
            while ($i < $count) {
                if (isset($uriArr[$i + 1])) {
                    $_GET[$uriArr[$i]] = $uriArr[$i + 1];
                }
                $i += 2;
            }
            p($_GET);
        } else {
            //默认访问index控制器的index方法
            $this->ctrl = conf::get('CONTROLLER', 'route');
            $this->action = conf::get('ACTION', 'route');
        }
    }

}