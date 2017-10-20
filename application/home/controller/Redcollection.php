<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:14
 */
namespace app\home\controller;
use app\home\model\Comment;
use app\home\model\Redbook;
use app\home\model\Redfilm;
use think\Controller;
/**
 * 红色珍藏
 */
class Redcollection extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index() {
        $Model = new Redfilm();
        if(IS_POST) {
            $data = input('post.');
            $res = $Model->getPage($data['type'],$data['p']);
            if($res) {
                return $this->success("加载成功","",$res);
            }else {
                return $this->error("加载失败");
            }
        }else {
            $list = $Model->getIndex();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }


    /*
     *  书籍详情页
     * */
    public function bookdetail() {
        $id = input('id');
        $Model = new Redbook();
        $detail = $Model->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(6,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }


    /*
     *  视频详情页
     * */
    public function moviedetail()
    {

        return $this->fetch();
    }

}