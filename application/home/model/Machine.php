<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/11/15
 * Time: 10:07
 */

namespace app\home\model;


use think\Model;

class Machine extends Model {
    /**
     * 获取一体机详情信息
     */
    public function getDetail() {
        $map = array(
            'status' => 1
        );
        $order = array("update_time desc");
        $res = $this->where($map)->order($order)->select();
        foreach ($res as $value) {
            //判断最后时间大于一小时则一体机关闭，改变状态，反之开启
            $time = time() - $value['update_time'];
            if($time > 3600) {
                $map['is_login'] = 0;
                $this->where('id',$value['id'])->update($map);
            }else {
                $map['is_login'] = 1;
                $this->where('id',$value['id'])->update($map);
            }
        }
        return $res;
    }
}