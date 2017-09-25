<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 18:21
 */
namespace app\home\controller;
use think\Controller;
/**
 * 两学一做
 */
class Interest extends Controller
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