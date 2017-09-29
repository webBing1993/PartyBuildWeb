<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/29
 * Time: 15:03
 */

namespace app\home\model;


use think\Model;

/**
 * Class Special
 * @package app\home\model
 * 红色专题
 */
class Special extends Model {
    /**
     * 获取主页轮播
     */
    public function getIndexList() {
        $map = array(
            'status' => 1
        );
        $order = array('create_time desc');
        $res = $this->where($map)->order($order)->limit(3)->select();
        return $res;
    }
}