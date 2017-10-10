<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:17
 */
namespace app\home\controller;
use think\Controller;
use app\home\model\Lead as LeadModel;
/**
 * 党员风采
 */
class Lead extends Base {
    /**
     * 首页
     * @return mixed
     */
    public function index() {
        $Model = new LeadModel;
        $list = $Model->getIndex();
        $this->assign('list',$list);
        return $this->fetch();
    }


}