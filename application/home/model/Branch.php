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
        $t1 = $this->where($map)->count();
        $map['type'] = 2;
        $two = $this->where($map)->order($order)->field($field)->limit(12)->select();
        $t2 = $this->where($map)->count();
        $map['type'] = 3;
        $three = $this->where($map)->order($order)->field($field)->limit(12)->select();
        $t3 = $this->where($map)->count();
        $res = array(
            'one' => $one,
            't1' => $t1,
            'two' => $two,
            't2' => $t2,
            'three' => $three,
            't3' => $t3,
        );
        return $res;
    }

    /**
     * 获取详情
     * $id
     */
    public function getDetail($id) {
        $this->where('id',$id)->setInc('views');
        $res = $this->get($id);
        switch ($res['type']) {
            case 1:
                $res['type_name'] = "通知公告";
                break;
            case 2:
                $res['type_name'] = "活动报道";
                break;
            case 3:
                $res['type_name'] = "支部内刊";
                break;
            default:
                break;
        }
        return $res;
    }

    /**
     * 获取分页
     */
    public function getPage($type,$p) {
        $len = ($p-1)*12;
        $map = array(
            'type' => $type,
            'status' => $p
        );
        $order = array("create_time desc");
        $field = array("id,title,create_time");
        $res = $this->where($map)->order($order)->field($field)->limit($len,12)->select();
        foreach ($res as $value) {
            $value['time'] = date("Y-m-d",$value['create_time']);
        }
        return $res;
    }

}