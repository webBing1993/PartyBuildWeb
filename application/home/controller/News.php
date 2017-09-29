<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 17:06
 */
namespace app\home\controller;
use think\Controller;

/**
 * 新闻聚焦
 */
class News extends Controller {
    /**
     * 首页
     * @return mixed
     */
    public function index(){

        return $this->fetch();
    }

    /**
     *  详情页
     */
    public function detail(){

        return $this->fetch();
    }


    /*
     *  总纲
     * */
    public function general(){

        return $this->fetch();
    }

}