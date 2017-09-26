<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2016/4/20
 * Time: 13:47
 */

namespace app\home\controller;
use think\Controller;


/**
 * 党建主页
 */
class Index extends Controller {
    public function index(){

        return $this->fetch();
    }
}