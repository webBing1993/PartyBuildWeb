<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/27
 * Time: 10:44
 */

namespace app\admin\controller;

use app\admin\model\Video as VideoModel;
/**
 * Class Video
 * @package app\admin\controller
 * 趣味视频
 */
class Video extends Admin {
    /**
     * 主页
     */
    public function index() {
        $map = array('status' => 1);
        $list = $this->lists("Video",$map);
        int_to_string($list,array(
            'status' => array(0=>"未审核",1=>"已发布"),
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
            unset($data['id']);
            if($data['recommend'] == 0) {
                unset($data['carousel_image']);
            }
            $data['create_user'] = $_SESSION['think']['user_auth']['id'];
            $filmModel = new VideoModel();
            $info = $filmModel->validate(true)->save($data);
            if($info) {
                return $this->success('添加成功',Url('Video/index'));
            }else{
                return $this->get_update_error_msg($filmModel->getError());
            }
        }else {
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
            $data['update_time'] = time();
            $data['update_user'] = $_SESSION['think']['user_auth']['id'];
            $filmModel = new VideoModel();
            $info = $filmModel->validate(true)->save($data,['id'=>$data['id']]);
            if($info) {
                return $this->success('修改成功',Url('Video/index'));
            }else{
                return $this->get_update_error_msg($filmModel->getError());
            }
        }else {
            $this->default_pic();
            $filmModel = new VideoModel();
            $id = input('id');
            $msg = $filmModel->get($id);
            $this->assign('msg',$msg);
            return $this->fetch();
        }
    }

    /**
     * 电影删除
     */
    public function del() {
        $id = input('id');
        $filmModel = new VideoModel();
        $map = array(
            'status' => -1,
        );
        $info = $filmModel->where('id',$id)->update($map);
        if($info) {
            return $this->success("删除成功");
        }else {
            return $this->error("删除失败");
        }
    }
}