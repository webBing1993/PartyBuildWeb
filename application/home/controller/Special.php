<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 17:59
 */
namespace app\home\controller;
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
        $list = $Model->getIndex();
        $this->assign('list',$list);
        return $this->fetch();
    }


    /**
     * 详细页
     * @return mixed
     */
    public function detail()
    {

        return $this->fetch();
    }

}