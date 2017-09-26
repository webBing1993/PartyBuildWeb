<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 14:35
 */

namespace app\admin\validate;


use think\Validate;

class Learn extends Validate {
    protected $rule = [
        'front_cover' => 'require',
        'title' => 'require',
        'content' => 'require',
        'publisher' => 'require',
    ];

    protected $message = [
        'front_cover' => '封面图片不能为空',
        'title' =>  '标题不能为空',
        'content'  =>  '内容不能为空',
        'publisher' => '发布者不能为空',
    ];
}