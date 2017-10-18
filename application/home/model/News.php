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
     * $id
     */
    public function getDetail($id) {
        $this->where('id',$id)->setInc('views');
        $res = $this->get($id);
        return $res;
    }
}