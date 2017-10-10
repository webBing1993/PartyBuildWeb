<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/29
 * Time: 15:02
 */

namespace app\home\model;


use think\Model;

/**
 * Class Lead
 * @package app\home\model
 * 党员风采
 */
class Lead extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1,
            'recommend' => 1
        );
        $order = array('create_time desc');
        $res = $this->where($map)->order($order)->limit(3)->select();
        return $res;
    }

    /**
     * 获取频道主页
     */
    public function getIndex() {
        $map = array(
            'status' => 1,
        );
        $order = array('create_time,recommend desc');
        $res = $this->where($map)->order($order)->select();
        return $res;
    }
}