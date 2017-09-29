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

}