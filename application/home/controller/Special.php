<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 17:59
 */
namespace app\home\controller;
use think\Controller;

/**
 * 红色专题
 */
class Special extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {

        return $this->fetch();
    }


}