<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/11/15
 * Time: 9:34
 */

namespace app\admin\controller;

use app\admin\model\Machine as MachineModel;
/**
 * Class Machine
 * @package app\admin\controller
 * 一体机监控
 */
class Machine extends Admin {
    /**
     * 主页列表
     */
    public function index() {
        $map = array(
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('Machine',$map);
        int_to_string($list,array(
            'is_login' => array(0=>"离线",1=>"在线"),
            'status' => array(0=>"未审核",1=>'已发布'),
        ));
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add() {
        if(IS_POST) {
            $Model = new MachineModel();
            $data = input('post.');
            if(empty($data['id'])) {
                unset($data['id']);
            }
            $msg = $Model->where('mid',$data['mid'])->find();
            if($msg) {
                return $this->error("数据库存在该唯一编码，请更换");
            }else {
                $info = $Model->validate(true)->save($data);
                if($info) {
                    return $this->success("新增成功",Url('Machine/index'));
                }else{
                    return $this->get_update_error_msg($Model->getError());
                }
            }
        }else{
            $this->assign('msg','');
            return $this->fetch('edit');
        }
    }

    /**
     * 修改
     */
    public function edit() {
        if(IS_POST) {
            $data = input('post.');
            $Model = new MachineModel();
            $msg = $Model->where('mid',$data['mid'])->find();
            if($msg) {
                if($msg['id'] == $data['id']) {
                    $info = $Model->validate(true)->save($data,['id'=>input('id')]);
                    if($info){
                        return $this->success("修改成功",Url("Machine/index"));
                    }else{
                        return $this->get_update_error_msg($Model->getError());
                    }
                }else {
                    return $this->error("数据库存在该唯一编码，请更换");
                }
            }else {
                $info = $Model->validate(true)->save($data,['id'=>input('id')]);
                if($info){
                    return $this->success("修改成功",Url("Machine/index"));
                }else{
                    return $this->get_update_error_msg($Model->getError());
                }
            }
        }else{
            $id = input('id');
            $msg = MachineModel::get($id);
            $this->assign('msg',$msg);
            return $this->fetch();
        }
    }

    /**
     * 删除
     */
    public function del() {
        $id = input('id');
        $data['status'] = '-1';
        $info = MachineModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
}