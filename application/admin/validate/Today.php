<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 16:49
 */

namespace app\admin\validate;


use think\Validate;

class Today extends Validate{
    protected $rule = [
        'title' => 'require',
    ];

    protected $message = [
        'title' =>  '标题不能为空',
    ];
}