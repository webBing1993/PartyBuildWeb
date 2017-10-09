<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 17:06
 */
namespace app\home\controller;
use app\home\model\Comment;
use think\Controller;
use app\home\model\News as NewsModel;
/**
 * 新闻聚焦
 */
class News extends Base {
    /**
     * 首页
     * @return mixed
     */
    public function index(){
        $Model = new NewsModel;
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
        $Model = new NewsModel;
        $detail = $Model->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(1,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }

    /**
     * 总纲
     */
    public function general(){

        return $this->fetch();
    }

}