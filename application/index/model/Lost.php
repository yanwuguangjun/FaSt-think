<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 17:29
 */

namespace app\index\model;

use think\Model;

class Lost extends Model
{
    public function morosely()
    {
        return $this->hasOne('morosely','moroselyId','id');

    }
}