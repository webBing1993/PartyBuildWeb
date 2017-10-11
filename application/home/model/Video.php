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
 * Class Video
 * @package app\home\model
 * 趣味视频
 */
class Video extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1
        );
        $order = array('create_time desc');
        $res = $this->where($map)->order($order)->limit(4)->select();
        return $res;
    }

    /**
     * 获取频道主页
     */
    public function getIndex() {
        //顶部轮播
        $map = array(
            'status' => 1,
            'recommend' => 1
        );
        $order = array("create_time desc,recommend desc");
        $field = array("id,title,type,front_cover,create_time");
        $top = $this->where($map)->order($order)->field($field)->limit(5)->select();
        //原创视频
        $map1 = array(
            'status' => 1,
            'type' => 1
        );
        $one = $this->where($map1)->order($order)->field($field)->limit(8)->select();
        //转载视频
        $map2 = array(
            'status' => 1,
            'type' => 2
        );
        $two = $this->where($map2)->order($order)->field($field)->limit(4)->select();

        $res = array(
            'top' => $top,
            'one' => $one,
            'two' => $two,
        );
        return $res;
    }
}