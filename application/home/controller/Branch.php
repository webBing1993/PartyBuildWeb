<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:10
 */
namespace app\home\controller;
use app\home\model\Comment;
use think\Controller;
use app\home\model\Branch as BranchModel;
/**
 * 支部建设
 */
class Branch extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index() {
        $Model = new BranchModel();
        if(IS_POST) {
            $data = input('post.');
            $res = $Model->getPage($data['type'],$data['p']);
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
     * 详情页
     * @return mixed
     */
    public function detail() {
        $id = input('id');
        $Model = new BranchModel;
        $detail = $Model->getDetail($id);
        $this->assign('detail',$detail);

        //获取 评论
        $commentModel = new Comment();
        $comment = $commentModel->getComment(4,$id,0);
        $this->assign('comment',$comment);
        return $this->fetch();
    }

}