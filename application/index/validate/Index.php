<?php
namespace app\index\validate;
use think\Validate;

class Index extends Validate
{
    //为空时使用默认设置
    protected $rule = [
//        'username' => 'require|max:25|alphaDash',
        'idcard' => 'require',
        'tel' => 'require',
        'name' => 'require',
        'workunit'=>'require'
//        'link_name' => 'require|max:25',
//        'link' => 'require',
//        'description' => 'max:20',
//        'captcha|验证码'=>'require|captcha'
    ];

    //此处可以不编辑 使用默认配置  也可以进行个性化定制化设置
    protected $message =[
        'username.alphaDash'=>'用户名只能是字母、数字和下划线_及破折号-',
        'username.require' => '管理员名必须填写',
        'username.max:25'  => '管理员名长度不得少于25',
        'password.require' => '管理员密码不得为空',
    ];


//    不常用功能 可进行定制
    protected $scene = [
        'login'=>['idcard','tel'],
        'edit' => ['username', 'password'],
        'user' => ['name', 'tel','idcard','workunit'],
        'add' => ['username', 'password'],
        'longin' => ['username', 'password','captcha'],//此处captcha指的是二维码and  键名错了呵呵  所以没用

    ];

}