<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/30
 * Time: 9:15
 */

namespace app\home\model;


use think\Model;

/**
 * Class Redbook
 * @package app\home\model
 * 红色书籍
 */
class Redbook extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1
        );
        $order = array('create_time desc');
        $res = $this->where($map)->order($order)->limit(6)->select();
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