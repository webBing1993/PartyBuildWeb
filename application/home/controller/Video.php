<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:21
 */
namespace app\home\controller;
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
     * 换一批
     * $type ,$n = 1
     */
    public function more() {
        $data = input('post.');
        $Model = new VideoModel();
        $res = $Model->getIndexMore($data['type'],$data['n']);
        if($res) {
            $this->success("获取成功","",$res);
        }else {
            $this->error("获取失败");
        }
    }


}