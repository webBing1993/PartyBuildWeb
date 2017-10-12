<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:10
 */
namespace app\home\controller;
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
        $list = $Model->getIndex();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 详情页
     * @return mixed
     */
    public function detail()
    {

        return $this->fetch();
    }

}