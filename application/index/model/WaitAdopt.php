<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/22 0022
 * Time: 22:13
 */

namespace app\index\model;

use think\Model;

class WaitAdopt extends Model
{
    public function comments()
    {
        return $this->hasMany('AdoptComment', 'adoptId', 'id');
    }

    public function morosely()
    {
        return$this->hasOne('Morosely','morselyId','id');
    }
}