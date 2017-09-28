<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/26
 * Time: 11:17
 */

namespace app\admin\controller;

use app\admin\model\Picture;
use app\admin\model\Special as SpecialModel;
use app\admin\model\SpecialDetail;

/**
 * Class Special
 * @package app\admin\controller
 * 红色专题
 */
class Special extends Admin {
    /**
     * 主页列表
     */
    public function index() {
        $map = array(
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('Special',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
        ));
        $this->assign('list',$list);
        $this->default_pic();
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
            $Model = new SpecialModel();
            $info = $Model->validate('Special.special')->save($data);
            if($info) {
                return $this->success("新增成功",Url('Special/index'));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
    }

    /**
     * 修改
     */
    public function edit() {
            $data = input('post.');
            $Model = new SpecialModel();
            $info = $Model->validate('Special.special')->save($data,['id'=>input('id')]);
            if($info){
                return $this->success("修改成功",Url("Special/index"));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
    }

    /**
     * 获取详情
     */
    public function getDetail() {
        $id = input('id');
        $res = SpecialModel::get($id);
        $pic = Picture::get($res['front_cover']);
        $res['path'] = $pic['path'];
        if($res) {
            return $this->success("获取成功","",$res);
        }else {
            return $this->error("获取失败");
        }
    }

    /**
     * 删除
     */
    public function del() {
        $id = input('id');
        $data['status'] = '-1';
        $info = SpecialModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
    
    /**
     * 专题文章主页
     */
    public function index2() {
        $pid = input('pid');
        $map = array(
            'pid' => $pid,
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('SpecialDetail',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
            'class' => array(1=>"图文",2=>'视频'),
        ));
        $this->assign('list',$list);
        $this->assign('pid',$pid);
        return $this->fetch();
    }
    
    /**
     * 文章新增
     */
    public function dadd() {
        if(IS_POST) {
            $data = input('post.');
            $data['create_user'] = $_SESSION['think']['user_auth']['id'];
            if(empty($data['id'])) {
                unset($data['id']);
            }
            $Model = new SpecialDetail();
            if($data['class'] == 1) {
                $valid = 'Special.pic';
            }else {
                $valid = 'Special.video';
            }
            $info = $Model->validate($valid)->save($data);
            if($info) {
                    return $this->success("新增成功",Url('Special/index2?pid='.$data['pid']));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $this->assign('msg','');
            $pid = input('pid');
            $this->assign('pid',$pid);
            return $this->fetch('dedit');
        }
    }
    
    /**
     * 修改
     */
    public function dedit() {
        if(IS_POST) {
            $data = input('post.');
            $Model = new SpecialDetail();
            if($data['class'] == 1) {
                $valid = 'Special.pic';
            }else {
                $valid = 'Special.video';
            }
            $info = $Model->validate($valid)->save($data,['id'=>input('id')]);
            if($info){
                return $this->success("修改成功",Url('Special/index2?pid='.$data['pid']));
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $id = input('id');
            $msg = SpecialDetail::get($id);
            $this->assign('msg',$msg);

            return $this->fetch();
        }
    }
    
    /**
     * 删除
     */
    public function ddel() {
        $id = input('id');
        $data['status'] = '-1';
        $info = SpecialDetail::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
}