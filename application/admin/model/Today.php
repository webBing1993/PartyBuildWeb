<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 15:57
 */

namespace app\admin\model;


class Today extends Base {
    protected $insert = [
        'create_time' => NOW_TIME,
        'status' => 1,
    ];
}