<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 17:59
 */
namespace app\home\controller;
use app\home\model\Comment;
use app\home\model\SpecialDetail;
use think\Controller;
use app\home\model\Special as SpecialModel;

/**
 * 红色专题
 */
class Special extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index() {
        $Model = new SpecialModel();
        if(IS_POST) {
            $data = input('post.');
            $res = $Model->getPage($data['id'],$data['p']);
            if($res) {
                return $this->success("获取成功","",$res);
            }else {
                return $this->error("获取失败");
            }
        }else {
            $list = $Model->getIndex();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }


    /**
     * 详细页
     * @return mixed
     */
    public function detail() {
        //获取专题列表
        $SpecialModel = new SpecialModel();
        $list = $SpecialModel->getSpecialList();
        $this->assign('list',$list);
        
        $id = input('id');
        $DetailModel = new SpecialDetail();
        $detail = $DetailModel->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(2,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }

}