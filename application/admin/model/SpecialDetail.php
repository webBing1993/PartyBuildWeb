<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/28
 * Time: 14:50
 */

namespace app\admin\model;


class SpecialDetail extends Base{
    protected $insert = [
        'create_time' => NOW_TIME,
        'status' => 1,
        'views' => 0,
        'likes' => 0,
        'comments' => 0,
    ];
}