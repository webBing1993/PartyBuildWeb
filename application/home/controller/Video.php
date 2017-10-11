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


}