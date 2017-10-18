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

    /**
     * 获取主页
     */
    public function getIndex($p=0) {
        ($p) ? $len = ($p-1)*12 : $len = 0;
        $map = array(
            'status' => 1,
        );
        $order = array('create_time desc');
        $field = array('id,title,class,create_time');
        $res = $this->where($map)->order($order)->field($field)->limit($len,12)->select();
        foreach ($res as $value) {
            $value['time'] = date("Y-m-d",$value['create_time']);
        }
        return $res;
    }

    /**
     * 获取详情
     */
    public function getDetail($id) {
        $this->where('id',$id)->setInc('views');
        $res = $this->get($id);
        return $res;
    }
}