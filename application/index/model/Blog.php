<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11 0011
 * Time: 2:34
 */

namespace app\index\model;

use think\Model;

class Blog extends Model
{
    public function morosely()
    {
        return $this->hasOne('morosely','moroselyId','id');
    }

    public function moroselyOne()
    {
        return $this->hasOne('moroselyOne','moroselyId','moroselyId');
    }
    public function comment()
    {
        return $this->hasMany('Comment', 'articleId', 'id');
    }
}