<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/11
 * Time: 23:53
 */

namespace core\lib;

class conf
{
    static public $conf = array();

    static public function get($name, $file)
    {
        //判断是否已经加载
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];
        } else {
            //判断配置文件是否存在
            $path = IMOOC . '/core/config/' . $file . '.php';
            if (is_file($path)) {
                self::$conf[$file] = include $path;

                //判断配置项是否存在
                if (isset(self::$conf[$file][$name])) {
                    return self::$conf[$file][$name];
                } else {
                    throw new \Exception('未找到配置项' . $name);
                }
            } else {
                throw new \Exception('未找到配置文件' . $file);
            }
        }
    }

    static public function getAll($file)
    {
        //判断是否已经加载
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        } else {
            //判断配置文件是否存在
            $path = IMOOC . '/core/config/' . $file . '.php';
            if (is_file($path)) {
                self::$conf[$file] = include $path;
                return self::$conf[$file];
            } else {
                throw new \Exception('未找到配置文件' . $file);
            }
        }
    }
}