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
 * Class News
 * @package app\home\model
 * 新闻聚焦
 */
class News extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'pid' => 0,
            'status' => 1
        );
        $order = array('create_time desc');
        $field = array('id,title');
        $res = $this->where($map)->order($order)->limit(3)->field($field)->select();
        foreach ($res as $value) {
            $map2 = array(
                'pid' => $value['id'],
                'status' => 1
            );
            $value['son'] = $this->where($map2)->order($order)->limit(4)->field($field)->select();
        }
        return $res;
    }

    /**
     * 获取主页
     */
    public function getIndex() {
        $map = array(
            'status' => 1,
        );
        $order = array('create_time desc');
        $field = array('id,title,create_time');
        $res = $this->where($map)->order($order)->limit(12)->field($field)->select();
        return $res;
    }
    
    /**
     * 获取详情
     * $id
     */
    public function getDetail($id) {
        $this->where('id',$id)->setInc('views');
        $res = $this->get($id);
        return $res;
    }
}