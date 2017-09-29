<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:06
 */
namespace app\home\controller;
use think\Controller;
/**
 * 两学一做
 */
class Learn extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {

        return $this->fetch();
    }

    /*
     * 答题
     * */
    public function answer()
    {

        return $this->fetch();
    }


    public function goon()
    {

        return $this->fetch();
    }


}