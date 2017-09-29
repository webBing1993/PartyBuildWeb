<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 15:44
 */

namespace app\admin\validate;


use think\Validate;

class Lead extends Validate {
    protected $rule = [
        'front_cover' => 'require',
        'name' => 'require',
        'content' => 'require',
    ];

    protected $message = [
        'front_cover' => '照片不能为空',
        'name' =>  '标题不能为空',
        'content'  =>  '内容不能为空',
    ];
}