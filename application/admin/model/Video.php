<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 10:45
 */

namespace app\admin\model;


class Video extends Base {
    protected $insert = [
        'create_time' => NOW_TIME,
        'comments' => 0,
        'likes' => 0,
        'views' => 0,
        'status' => 1,
    ];
}