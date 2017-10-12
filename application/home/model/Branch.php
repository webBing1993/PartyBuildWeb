<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/29
 * Time: 15:01
 */

namespace app\home\model;


use think\Model;

/**
 * Class Branch
 * @package app\home\model
 * 支部建设
 */
class Branch extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1,
        );
        $order = array('create_time desc');
        $field = array('id,title');
        $res = $this->where($map)->order($order)->limit(4)->field($field)->select();
        return $res;
    }

    /**
     * 获取主页
     */
    public function getIndex() {
        $map = array(
            'status' => 1
        );
        $order = array("create_time desc");
        $field = array("id,title,create_time");
        $map['type'] = 1;
        $one = $this->where($map)->order($order)->field($field)->limit(12)->select();
        $map['type'] = 2;
        $two = $this->where($map)->order($order)->field($field)->limit(12)->select();
        $map['type'] = 3;
        $three = $this->where($map)->order($order)->field($field)->limit(12)->select();
        $res = array(
            'one' => $one,
            'two' => $two,
            'three' => $three
        );
        return $res;
    }

}