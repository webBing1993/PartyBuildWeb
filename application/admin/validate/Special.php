<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 11:19
 */

namespace app\admin\validate;


use think\Validate;

class Special extends Validate {
    protected $rule = [
        'front_cover' => 'require',
        'name' => 'require',
        'class' => 'require',
        'net_path' => 'require',
        'title' => 'require',
        'content' => 'require',
        'publisher' => 'require',
    ];

    protected $message = [
        'front_cover' => '封面图片不能为空',
        'name' => '专题名称不能为空',
        'class' => '类别不能为空',
        'net_path' => '视频路径不能为空',
        'title' =>  '标题不能为空',
        'content'  =>  '内容不能为空',
        'publisher' => '发布者不能为空',
    ];

    protected $scene = [
        'special' => ['front_cover','name'],
        'pic' => ['class','front_cover','title','content','publisher'],
        'video' => ['class','front_cover','net_path','title','content','publisher'],
    ];
}