<?php
/**
 * Created by PhpStorm.
 * User: YXJ
 * Date: 2019/6/8
 * Time: 3:28
 */

namespace core\lib;

class model extends \PDO
{
    public function __construct($dsn, $username, $passwd, $options)
    {
        try {
            parent::__construct($dsn, $username, $passwd, $options);
        } catch (\PDOException $e) {
            p($e->getMessage());
        }

    }
}