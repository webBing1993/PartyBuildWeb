<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/10/13
 * Time: 9:43
 */

namespace app\home\model;


use think\Model;

class SpecialDetail extends  Model {
    /**
     * 获取详情页
     */
    public function getDetail($id) {
        $res = $this->get($id);
        return $res;
    }

}