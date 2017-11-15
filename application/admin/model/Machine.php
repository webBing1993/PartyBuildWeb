<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/11/15
 * Time: 10:06
 */

namespace app\admin\model;


class Machine extends Base {
    protected $insert = [
        'create_time' => NOW_TIME,
        'status' => 1
    ];
}