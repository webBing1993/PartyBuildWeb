<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 14:53
 */

namespace app\admin\controller;

use app\admin\model\Branch as BranchModel;
/**
 * Class Branch
 * @package app\admin\controller
 * 支部建设
 */
class Branch extends Admin {
    /**
     * 主页列表
     */
    public function index() {
        $map = array(
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('Branch',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
            'type' => array(1=>"通知公告",2=>"活动报道",3=>"支部内刊")
        ));
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add() {
        if(IS_POST) {
            $data = input('post.');
            $data['create_user'] = $_SESSION['think']['user_auth']['id'];
            if(empty($data['id'])) {
                unset($data['id']);
            }
            $Model = new BranchModel();
            if($data['type'] == 3) {
                $valid = 'Branch.video';
            }else {
                $valid = 'Branch.pic';
            }
            $info = $Model->validate($valid)->save($data);
            if($info) {
                return $this->success("新增成功",Url('Branch/index'));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
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
            $Model = new BranchModel();
            if($data['type'] == 3) {
                $valid = 'Branch.video';
            }else {
                $valid = 'Branch.pic';
            }
            $info = $Model->validate($valid)->save($data,['id'=>input('id')]);
            if($info){
                return $this->success("修改成功",Url("Branch/index"));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $id = input('id');
            $msg = BranchModel::get($id);
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
        $info = BranchModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
}