<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12 0012
 * Time: 20:38
 */

namespace app\index\controller;

use think\Controller;
use think\Config;

//use think\config;
//use Phinx\Config;

class Functions extends Controller
{
//    public $function_area_config = [];

//        public  static $demo;


    /**
     * @param string $province 省份
     * @param string $city 市名
     * @param string $area 区县名
     * @return array error
     * @return string 地区代码
     */
    public static function getAreaCode($province, $city, $area)
    {

        $function_area_config = Config::get('function_area_config');
        $function_area_config = array_unique($function_area_config);                               //删除重复的键值主要是针对值；
        $reversal_area_code = array_flip($function_area_config);                                   //反转代码表为  地名=>代码
        $province_code = substr($reversal_area_code[$province], 0, 2);             //获取省份代码前俩位
        $city_code = substr($reversal_area_code[$city], 2, 2);                    //获取市代码中间2位
        $area_code = $reversal_area_code[$area];                                                 //获取地区完整代码
        $cut_area_code = substr($area_code, 0, 4);                               //获取地区代码前4位
        return $province_code . $city_code == $cut_area_code ? $area_code : ['error' => '未找到此区域'];      //验证代码返回代码
    }


    /**
     * @param string $code 地区代码
     * @return array error
     * @return array($province,$city,$area)  数组话省市区名
     */
    public static function getAreaName($code)
    {
        $function_area_config = Config::get('function_area_config');
        $area = $function_area_config[$code];                                                 //县区名
        $province_cut_code = substr($code, 0, 2);                              //获取代码前倆位
        $city_cut_code = substr($code, 0, 4);                                  //获取代码前四位
        $province = $function_area_config[$province_cut_code . '0000'];                       //获取省份
        $city = $function_area_config[$city_cut_code . '00'];                                 //获取市名
        return $province == $city ? array($city, $area) : array($province, $city, $area);     //
    }

}

//