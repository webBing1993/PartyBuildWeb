<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 15:49
 */

namespace app\admin\controller;

use app\admin\model\Today as TodayModel;
/**
 * Class Today
 * @package app\admin\controller
 * 党史上的今天
 */
class Today extends Admin {
    /**
     * 主页
     */
    public function index() {
        $map = array(
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('Today',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
        ));
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add() {
        $data = input('post.');
        $data['create_user'] = $_SESSION['think']['user_auth']['id'];
        if(empty($data['id'])) {
            unset($data['id']);
        }
        $Model = new TodayModel();
        $info = $Model->validate(true)->save($data);
        if($info) {
            return $this->success("新增成功",Url('Today/index'));
        }else{
            return $this->get_update_error_msg($Model->getError());
        }
    }

    /**
     * 修改
     */
    public function edit() {
        $data = input('post.');
        $Model = new TodayModel();
        $info = $Model->validate(true)->save($data,['id'=>input('id')]);
        if($info){
            return $this->success("修改成功",Url("Today/index"));
        }else{
            return $this->get_update_error_msg($Model->getError());
        }
    }

    /**
     * 删除
     */
    public function del() {
        $id = input('id');
        $data['status'] = '-1';
        $info = TodayModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }

    /**
     * 获取详情
     */
    public function getDetail() {
        $id = input('id');
        $res = TodayModel::get($id);
        if($res) {
            return $this->success("获取成功","",$res);
        }else {
            return $this->error("获取失败");
        }
    }
}