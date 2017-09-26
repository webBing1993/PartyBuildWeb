<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 13:43
 */
namespace app\home\controller;
use think\Controller;
/**
 * 联系我们
 */
class Contact extends Controller
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