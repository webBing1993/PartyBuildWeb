<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:14
 */
namespace app\home\controller;
use think\Controller;
/**
 * 先锋引领
 */
class Pioneer extends Controller
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