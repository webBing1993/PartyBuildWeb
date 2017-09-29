<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/29
 * Time: 15:04
 */

namespace app\home\model;


use think\Model;

/**
 * Class Today
 * @package app\home\model
 * 党史上的今天
 */
class Today extends Model {
    /**
     * 获取首页列表数据
     */
    public function getIndexTag() {
        $map = array(
            'status' => 1,
        );
        $res = $this->where($map)->whereTime('create_time','d')->order('create_time desc')->find();
        return $res;
    }
}