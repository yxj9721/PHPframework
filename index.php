<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/7
 * Time: 14:25
 */
define('IMOOC', realpath('./'));//框架所在目录
define('CORE', IMOOC . '/core');//核心文件所在目录
define('APP', IMOOC . '/app');//项目文件.控制器模型
define('MODULE', 'app');//定义默认模块
//echo IMOOC;

//调试模式
define('DEBUG', true);

//想要引入composer自动加载的类,需要先include
include "vendor/autoload.php";

if (DEBUG) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set('display_errors', 'on');
} else {
    ini_set('display_errors', 'off');
}

//加载函数库
//在公共函数加载之后,在框架的其他地方,可以直接使用这些自定义函数
include CORE . '/common/function.php';

//加载核心文件
include CORE . '/imooc.php';


//关于命名空间的理解/关于include和require的区别,关于use和include/require的关系
//use core\imooc;

//自动加载类
spl_autoload_register('\core\imooc::load');

//启动框架
//路由类的启动将在run中完成,路由类的作用是:获取请求接口(控制器和方法)以及请求所带的参数
//路由启动之后获取到对应的控制器和方法以及参数,通过include引入该控制器,并将其实例化,然后即可调取对应的方法
\core\imooc::run();