<?php
namespace app\admin\validate;

use think\Validate;

class Friends extends Validate
{
    //为空时使用默认设置
    protected $rule = [
        'link_name' => 'require|max:25',
        'link' => 'require',
        'description' => 'max:20',
    ];

    //此处可以不编辑 使用默认配置  也可以进行个性化定制化设置  此处 未配置全
    protected $message =[
        'link_name.require' => '链接名必须填写',
        'link_name.max:25'  => '链接名不得大于25',
//        'link.require' => '链接不是有有效的url地址',
        'link.require' => '链接不得为空',
    ];


//    不常用功能 可进行定制
    protected $scene = [
        'edit' => ['username', 'password'],  //对username，password 不验证；
        'add' => ['username', 'password'], //对username，password 不验证；
    ];

}
  //提示信息  项目完成后删除  仅作为提示
//protected static $typeMsg = [
//    'require'     => ':attribute不能为空',
//    'number'      => ':attribute必须是数字',
//    'float'       => ':attribute必须是浮点数',
//    'boolean'     => ':attribute必须是布尔值',
//    'email'       => ':attribute格式不符',
//    'array'       => ':attribute必须是数组',
//    'accepted'    => ':attribute必须是yes、on或者1',
//    'date'        => ':attribute格式不符合',
//    'file'        => ':attribute不是有效的上传文件',
//    'image'       => ':attribute不是有效的图像文件',
//    'alpha'       => ':attribute只能是字母',
//    'alphaNum'    => ':attribute只能是字母和数字',
//    'alphaDash'   => ':attribute只能是字母、数字和下划线_及破折号-',
//    'activeUrl'   => ':attribute不是有效的域名或者IP',
//    'chs'         => ':attribute只能是汉字',
//    'chsAlpha'    => ':attribute只能是汉字、字母',
//    'chsAlphaNum' => ':attribute只能是汉字、字母和数字',
//    'chsDash'     => ':attribute只能是汉字、字母、数字和下划线_及破折号-',
//    'url'         => ':attribute不是有效的URL地址',
//    'ip'          => ':attribute不是有效的IP地址',
//    'dateFormat'  => ':attribute必须使用日期格式 :rule',
//    'in'          => ':attribute必须在 :rule 范围内',
//    'notIn'       => ':attribute不能在 :rule 范围内',
//    'between'     => ':attribute只能在 :1 - :2 之间',
//    'notBetween'  => ':attribute不能在 :1 - :2 之间',
//    'length'      => ':attribute长度不符合要求 :rule',
//    'max'         => ':attribute长度不能超过 :rule',
//    'min'         => ':attribute长度不能小于 :rule',
//    'after'       => ':attribute日期不能小于 :rule',
//    'before'      => ':attribute日期不能超过 :rule',
//    'expire'      => '不在有效期内 :rule',
//    'allowIp'     => '不允许的IP访问',
//    'denyIp'      => '禁止的IP访问',
//    'confirm'     => ':attribute和字段 :rule 不一致',
//    'different'   => ':attribute和字段 :rule 不能相同',
//    'egt'         => ':attribute必须大于等于 :rule',
//    'gt'          => ':attribute必须大于 :rule',
//    'elt'         => ':attribute必须小于等于 :rule',
//    'lt'          => ':attribute必须小于 :rule',
//    'eq'          => ':attribute必须等于 :rule',
//    'unique'      => ':attribute已存在',
//    'regex'       => ':attribute不符合指定规则',
//    'method'      => '无效的请求类型',
//    'token'       => '令牌数据无效',
//    'fileSize'    => '上传文件大小不符',
//    'fileExt'     => '上传文件后缀不符',
//    'fileMime'    => '上传文件类型不符',
//
//];
