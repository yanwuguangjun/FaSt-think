<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/22 0022
 * Time: 22:13
 */

namespace app\index\model;

use think\Model;

class Morosely extends Model
{
    public function moroselyOne()
    {
        return $this->hasOne('MoroselyOne', 'moroselyId', 'id');
    }
}