<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 14:34
 */

namespace app\admin\model;


class Learn extends Base {
    protected $insert = [
        'create_time' => NOW_TIME,
        'status' => 1,
        'views' => 0,
        'likes' => 0,
        'comments' => 0,
    ];
}