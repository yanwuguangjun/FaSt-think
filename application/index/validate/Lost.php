<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/23 0023
 * Time: 13:28
 */

namespace app\index\validate;
use think\Validate;


class Lost extends Validate
{
    //为空时使用默认设置
    protected $rule = [
        'title'=>'max:20|min:5|chsDash|require',
        'age' => 'require|max:20|chsAlphaNum',
        'sex' => 'require|number',
        'species' => 'require|max:20|chs',       //物种
        'category'=>'require|max:15|chs',        //物种分类
        'province'=>'require|number|max:15',           // 市
        'city'=>'require|number|max:15',           // 市
        'area'=>'require|number|max:15',           //区
        'address'=>'require|max:50',
        'connect'=>'require|max:100',
        'email'=>'require|email',
        'open'=>'accepted',                          //是否公开电话
        'agree'=>'accepted|require',                 //是否同意公开电话
        'images'=>'require',
        'charity_name'=>'require',
        'captcha|验证码'=>'require|captcha',
        'belongTo_id'=>'require',
        'tel'=>'require|max:11|number|min:7',
        'belongTo_charity'=>'require',
        'belongTo_charity_user'=>'require',
        'note'=>'max:140|require|min:20',
//        验证规则为指定
    ];


    //此处可以不编辑 使用默认配置  也可以进行个性化定制化设置
    protected $message =[
        'username.alphaDash'=>'用户名只能是字母、数字和下划线_及破折号-',
        'username.require' => '管理员名必须填写',
        'username.max:25'  => '管理员名长度不得大于25',
        'password.require' => '管理员密码不得为空',
        'master_type.require' => '宠物种类必须填写',
    ];


//    常用功能 可进行定制
    protected $scene = [
        'add_lost'=>['sex','age','species','note','category','province','city','area','agree','tel','email','title'],
        /*普通用户发布领养*/
        'charity_add_adopt'=>['master_type','note','belongTo_id','captcha','connect','connect_email','address','keywords'],/*机构负责人发布领养*/
        'charity_user_add_adopt'=>['master_type','note','belongTo_id','captcha','connect','connect_email','address','keywords'],  /*机构用户发布领养*/

        'charity_register' => ['username', 'password','captcha','charity_name','address','city','responsible_name','responsible_idCard','telephone','email'],
        'login' => ['username', 'password','captcha'],//此处captcha指的是二维码and  键名错了呵呵  所以没用

    ];
}