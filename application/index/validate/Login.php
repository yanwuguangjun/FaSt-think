<?php
namespace app\index\validate;
use think\Validate;

class Login extends Validate
{
    //为空时使用默认设置
    protected $rule = [
        'username' => 'require|max:25|min:4',
        'password'=>'min:6|max:8|alphaNum|require',
        'tel' => 'require|length:11',
        'rel_name'=>'require|chs',                                   //只能是汉字
        'city'=>'require|captcha',
        'telephone'=>'require|alphaDash|min:3|max:15',
        'email'=>'require|email',
        'charity_name'=>'require|chs|max:25',
        'responsible_name'=>'require',
        'responsible_idCard'=>'require|max18|alphaNum',   //只能是数字或字字母
        'sex'=>'require|between:0,1',
        'agree'=>'require|accepted',                          //accepted只能是1 或yes 或on；
        'birthday' => 'require|alphaDash|date',  //必填项  字母或数字 或者是破折号-或下划线  必须使用日期格式
        'captcha|验证码' => 'require|captcha'


    ];

    //此处可以不编辑 使用默认配置  也可以进行个性化定制化设置
    protected $message =[
        'username.alphaDash'=>'用户名只能是字母、数字和下划线_及破折号-',
        'username.require' => '用户名必须填写',
        'username.max:25'  => '用户名长度不得大于25',
        'password.require' => '用户员密码不得为空',
    ];

//    不常用功能 可进行定制
    protected $scene = [
        'morosely_register'=>['username','password','email','sex','birthday','agree','captcha'],
        'charity_register' => ['username', 'password','captcha','charity_name','address','city','responsible_name','responsible_idCard','telephone','email'],
        'login' => ['email', 'password','captcha'],//此处captcha指的是验证码and  键名错了呵呵  所以没用

    ];

}