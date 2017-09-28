<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 14:54
 */

namespace app\admin\validate;


use think\Validate;

class Branch extends Validate {
    protected $rule = [
        'front_cover' => 'require',
        'type' => 'require',
        'net_path' => 'require',
        'title' => 'require',
        'content' => 'require',
        'publisher' => 'require',
    ];

    protected $message = [
        'front_cover' => '封面图片不能为空',
        'type' => '类型不能为空',
        'net_path' => '视频不能为空',
        'title' =>  '标题不能为空',
        'content'  =>  '内容不能为空',
        'publisher' => '发布者不能为空',
    ];

    protected $scene = [
        'pic' => ['type','front_cover','title','content','publisher'],
        'video' => ['type','front_cover','net_path','title',],
    ];
}