<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/7
 * Time: 14:33
 */

namespace core;

use core\lib\log;

class imooc
{
    public static $classMap = array();
    public $assign = array();

    static public function run()
    {
        p('enter imooc::run');

        //实例化日之类
        log::init();

        //实例化路由类
        $routeObj = new \core\lib\route();
        //获取控制器类
        $controller = $routeObj->ctrl;
        //获取方法
        $action = $routeObj->action;

        $apiPath = APP . '/controller/' . $controller . '.php';

        //不做is_file判断,也可以被自动加载类,加载控制器和方法
        if (is_file($apiPath)) {
            //引入类文件
            include $apiPath;
            //实例化控制器类
            $requestNamespace = '\\' . MODULE . '\controller\\' . $controller;
            $requestCtr = new $requestNamespace();
            //调用控制器的方法
            $requestCtr->$action();
        }
    }

    static public function load($class)
    {
        p($class);//调试阶段,改行代码可以清楚得看到各个自动加载的类的顺序
        //判断是否已经加载过
        if (isset(self::$classMap[$class])) {
            return true;
        } else {
            //将类名的反斜线转化为路径斜线
            $file = IMOOC . '/' . str_replace('\\', '/', $class) . '.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    public function assign($name, $data)
    {
        $this->assign[$name] = $data;
    }

    public function display($filename)
    {
        $viewPath = APP . '/view/' . $filename;
        if (is_file($viewPath)) {
            extract($this->assign);
            include $viewPath;
        }
    }
}