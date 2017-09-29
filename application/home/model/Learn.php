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
 * Class Learn
 * @package app\home\model
 * 两学一做
 */
class Learn extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1,
        );
        $order = array('create_time desc');
        $res = $this->where($map)->order($order)->limit(2)->select();
        return $res;
    }
}