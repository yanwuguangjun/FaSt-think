<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24 0024
 * Time: 10:40
 */

namespace app\console;

use app\console\Common;

class TB extends Common
{
    protected $table;

    protected function __construct($name)
    {

    }

    public static function getInstance($name)
    {
        if (!$name instanceof \swoole_table) {
            $name = new \swoole_table();
        }
        return $name;
    }

    public static function get($key)
    {
        $obj = self::getInstance();

        return $obj->get($key);
    }
//
//    public static function set()
//    {
//
//    }
//
//    public static function del()
//    {
//
//    }
}