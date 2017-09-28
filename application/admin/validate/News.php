<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/4/24
 * Time: 16:15
 */

namespace app\admin\validate;


use think\Validate;

class News extends Validate {
    protected $rule = [
        'class' => 'require',
        'front_cover' => 'require',
        'net_path' => 'require',
        'title' => 'require',
        'content' => 'require',
        'publisher' => 'require',
    ];

    protected $message = [
        'class' => '类别不能为空',
        'front_cover' => '封面图片不能为空',
        'net_path' => '视频路径不能为空',
        'title' =>  '标题不能为空',
        'content'  =>  '内容不能为空',
        'publisher' => '发布者不能为空',
    ];

    protected $scene = [
        'pic' => ['class','front_cover','title','content','publisher'],
        'video' => ['class','front_cover','net_path','title','content','publisher'],
    ];

}