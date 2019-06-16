<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/16
 * Time: 0:59
 */

namespace core\lib;

class log
{
    static public $log;

    static public function init()
    {
        $driver = conf::get('DRIVER', 'log');
        $path = IMOOC . '/core/lib/driver/log/' . $driver . '.php';
        if (is_file($path)) {
            $class = '\core\lib\driver\log\\' . $driver;
            self::$log = new $class();
        } else {
            throw new \Exception('未找到日志驱动类' . $path);
        }
    }

    static public function log($massage, $suffix)
    {
        self::$log->log($massage, $suffix);
    }
}