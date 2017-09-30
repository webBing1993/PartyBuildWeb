<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/30
 * Time: 9:15
 */

namespace app\home\model;


use think\Model;

/**
 * Class Redfilm
 * @package app\home\model
 * 红色电影
 */
class Redfilm extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1
        );
        $order = array('recommend desc,create_time desc');
        $res = $this->where($map)->order($order)->limit(6)->select();
        return $res;
    }
}