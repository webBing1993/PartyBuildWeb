<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 11:22
 */

namespace app\admin\validate;


use think\Validate;

class Video extends Validate {
    protected $rule = [
        'front_cover'  =>  'require',
        'net_path' => 'require',
        'title' =>  'require', 
        'introduction' => 'require',
        'content'  =>  'require',
    ];

    protected $message = [
        'front_cover.require'  =>  '请添加封面图片！',
        'net_path.require' => '请填写电影地址路径',
        'title.require' =>  '请填写电影名称！',
        'introduction.require' => '请填写地址路径',
        'content.require'  =>  '请填写内容！',
    ];
}