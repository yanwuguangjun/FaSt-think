<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12 0012
 * Time: 20:28
 */

namespace app\index\model;
use think\Model;

class SociallyUsefulActivity extends Model
{
    public function comment()
    {
        return $this->hasMany('ActivityComment', 'activityId', 'id');
    }

    public function morosely()
    {
        return $this->hasOne('morosely','moroselyId','id');
    }
}