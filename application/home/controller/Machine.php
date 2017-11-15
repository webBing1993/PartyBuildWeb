<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/11/14
 * Time: 15:59
 */

namespace app\home\controller;

use app\home\model\Machine as MachineModel;
/**
 * Class Machine
 * @package app\home\controller
 * 一体机监控
 */
class Machine extends Base {
    /**
     * 地图主页
     */
    public function index() {
        $Model = new MachineModel();
        $list = $Model->getDetail();
        return json_encode($list);
    }

    /**
     * 获取一体机信息
     * mid: 机器编号
     * lat: 经度
     * lng：维度
     */
    public function setAddress() {
        $Model = new MachineModel;
        $data = input('get.');
        $data['update_time'] = time();
        $msg = $Model->where('mid',$data['mid'])->find();
        if($msg) {
            $res = $Model->where('mid',$data['mid'])->update($data);
            return $this->success("识别成功","",$res);
        }else {
            return $this->error("缺失唯一识别ID,请后台添加机器信息");
        }
    }
}