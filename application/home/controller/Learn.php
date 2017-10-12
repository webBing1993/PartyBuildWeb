<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:06
 */
namespace app\home\controller;
use app\home\model\Comment;
use think\Controller;
use app\home\model\Learn as LearnModel;
/**
 * 两学一做
 */
class Learn extends Base {
    /**
     * 首页
     * @return mixed
     */
    public function index(){
        $Model = new LearnModel;
        $list = $Model->getIndex();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 详情页
     * $id
     */
    public function detail(){
        $id = input('id');
        $Model = new LearnModel;
        $detail = $Model->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(3,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }
    /*
     * 答题
     * */
    public function answer()
    {

        return $this->fetch();
    }


    public function goon()
    {

        return $this->fetch();
    }


}