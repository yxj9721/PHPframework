<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/8
 * Time: 0:35
 */

namespace app\controller;

use core\imooc;
use core\lib\conf;
use core\lib\model;

class indexController extends imooc
{
    public function index()
    {
        p('enter indexController index_function');
        $conf = conf::getAll('database');
        $model = new model($conf['DNS'], $conf['USERNAME'], $conf['PASSWORD'], $conf['OPTION']);
        $sql = "select * from user";
        $data = $model->query($sql);
        p($data->fetchAll());

        $this->assign('data', 'Hello world');
        $this->display('index.html');

    }
}