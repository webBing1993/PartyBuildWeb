<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/25
 * Time: 17:00
 */

namespace app\admin\controller;

use app\admin\model\News as NewsModel;

/**
 * Class News
 * @package app\admin\controller
 * 新闻聚焦
 */
class News extends Admin {
    /**
     * 主页列表
     */
    public function index() {
        $map = array(
            'pid' => 0,
            'status' => array('eq',1),  // 推送  未推送
        );
        $list = $this->lists('News',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
            'class' => array(1=>"图文",2=>'视频'),
        ));
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * 二级页面
     */
    public function index2() {
        $pid = input('pid');
        $map = array(
            'pid' => $pid,
            'status' => 1
        );
        $list = $this->lists('News',$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>'已发布'),
            'class' => array(1=>"图文",2=>'视频'),
        ));
        $this->assign('list',$list);
        $this->assign('pid',$pid);
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
            $Model = new NewsModel();
            if($data['class'] == 1) {
                $valid = 'News.pic';
            }else {
                $valid = 'News.video';
            }
            $info = $Model->validate($valid)->save($data);
            if($info) {
                if($data['pid']) {
                    return $this->success("新增成功",Url('News/index2?pid='.$data['pid']));
                }else {
                    return $this->success("新增成功",Url('News/index'));
                }
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $this->assign('msg','');
            $pid = input('pid');
            $this->assign('pid',$pid);
            return $this->fetch('edit');
        }
    }

    /**
     * 修改
     */
    public function edit() {
        if(IS_POST) {
            $data = input('post.');
            $Model = new NewsModel();
            if($data['class'] == 1) {
                $valid = 'News.pic';
            }else {
                $valid = 'News.video';
            }
            $info = $Model->validate($valid)->save($data,['id'=>input('id')]);
            if($info){
                if($data['pid']) {
                    return $this->success("修改成功",Url('News/index2?pid='.$data['pid']));
                }else {
                    return $this->success("修改成功",Url("News/index"));
                }
            }else{
                return $this->get_update_error_msg($Model->getError());
            }
        }else{
            $this->default_pic();
            $id = input('id');
            $msg = NewsModel::get($id);
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
        $info = NewsModel::where('id',$id)->update($data);
        if($info) {
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }
}