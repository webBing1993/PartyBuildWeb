<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:14
 */
namespace app\home\controller;
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

        }else {
            $list = $Model->getIndex();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }


    /*
     *  书籍详情页
     * */
    public function bookdetail()
    {

        return $this->fetch();
    }

}