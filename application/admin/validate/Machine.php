<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/11/15
 * Time: 15:15
 */

namespace app\admin\validate;


use think\Validate;

class Machine extends Validate {
    protected $rule = [
        'mid' => 'require',
        'name' => 'require',
        'introduction' => 'require',
        'lat' => 'require',
        'lng' => 'require'
    ];

    protected $message = [
        'mid' => '唯一识别码不能为空',
        'name' =>  '一体机名称不能为空',
        'introduction'  =>  '一体机简介不能为空',
        'lat' => '经度不能为空',
        'lng' => '纬度不能为空'
    ];
}