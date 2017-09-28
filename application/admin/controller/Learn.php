<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 14:33
 */

namespace app\admin\controller;

use app\admin\model\Learn as LearnModel;

/**
 * Class Learn
 * @package app\admin\controller
 * 两学一做
 */
class Learn extends Admin {
    /**
     * 主页列表
     */
    public function index() {
        $map = array(
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('Learn',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
            'class' => array(1=>"图文",2=>'视频'),
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
            $Model = new LearnModel();
            if($data['class'] == 1) {
                $valid = 'Learn.pic';
            }else {
                $valid = 'Learn.video';
            }
            $info = $Model->validate($valid)->save($data);
            if($info) {
                return $this->success("新增成功",Url('Learn/index'));
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
            $Model = new LearnModel();
            if($data['class'] == 1) {
                $valid = 'Learn.pic';
            }else {
                $valid = 'Learn.video';
            }
            $info = $Model->validate($valid)->save($data,['id'=>input('id')]);
            if($info){
                return $this->success("修改成功",Url("Learn/index"));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $id = input('id');
            $msg = LearnModel::get($id);
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
        $info = LearnModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
}