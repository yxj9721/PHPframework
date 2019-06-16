<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/16
 * Time: 1:01
 */

namespace core\lib\driver\log;

use core\lib\conf;

class file
{
    public $path;

    public function __construct()
    {
        $option = conf::get('OPTION', 'log');
        $this->path = $option['PATH'];
    }

    public function log($massage, $suffix = 'log')
    {
        //p($name);
        /**
         * 文件位置是否存在
         * 不存在新建目录
         * 写入目录
         */
        $path = $this->path . '/' . date('Ym');
        if (!is_dir($path)) {
            mkdir($path, '0777', true);
        }
        $massage = date('Y-m-d H:i:s') . $massage;
        $realFile = $path . '/' . date('d') . '.' . $suffix;
        return file_put_contents($realFile, $massage . PHP_EOL, FILE_APPEND);
    }
}