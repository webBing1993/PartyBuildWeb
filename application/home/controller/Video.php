<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:21
 */
namespace app\home\controller;
use app\home\model\Comment;
use think\Controller;
use app\home\model\Video as VideoModel;
/**
 * 趣味视频
 */
class Video extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index() {
        $Model = new VideoModel();
        $list = $Model->getIndex();
        $this->assign('list',$list);
        return $this->fetch();
    }


    /**
     * 详情页
     * @return mixed
     */
    public function detail() {
        $id = input('id');
        $Model = new VideoModel();
        $detail = $Model->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(5,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }

    /**
     * 换一批
     * $type ,$n = 1
     */
    public function more() {
        $data = input('post.');
        $Model = new VideoModel();
        $res = $Model->getIndexMore($data['type'],$data['n']);
        if($res) {
            return $this->success("获取成功","",$res);
        }else {
            return $this->error("获取失败");
        }
    }


}