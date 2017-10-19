<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/30
 * Time: 9:15
 */

namespace app\home\model;


use think\Model;

/**
 * Class Redfilm
 * @package app\home\model
 * 红色电影
 */
class Redfilm extends Model {
    /**
     * 获取主页列表
     */
    public function getIndexList() {
        $map = array(
            'status' => 1
        );
        $order = array('recommend desc,create_time desc');
        $res = $this->where($map)->order($order)->limit(6)->select();
        return $res;
    }

    /**
     * 获取主页
     */
    public function getIndex() {
        $filmModel = new Redfilm();
        $bookModel = new Redbook();
        $musicModel = new  Redmusic();
        $map = array(
            'status' => 1
        );
        $order = array('create_time desc');
        $one = $filmModel->where($map)->order($order)->limit(12)->select();
        $t1 = $filmModel->where($map)->count();
        $two = $bookModel->where($map)->order($order)->limit(12)->select();
        $t2 = $bookModel->where($map)->count();
        $three = $musicModel->where($map)->order($order)->limit(12)->select();
        $t3 = $musicModel->where($map)->count();
        $res = array(
            'one' => $one,
            't1' => $t1,
            'two' => $two,
            't2' => $t2,
            'three' => $three,
            't3' => $t3
        );
        return $res;
    }
    
    /**
     * 获取分页
     */
    public function getPage($type,$p) {
        $filmModel = new Redfilm();
        $bookModel = new Redbook();
        $musicModel = new  Redmusic();
        $length  = ($p-1)*12;
        $map = array(
            'status' => 1
        );
        $order = array("create_time desc");
        if($type == 1) {
            $map['type'] = 1;
            $res = $filmModel->where($map)->order($order)->limit($length,12)->select();
            foreach ($res as $value) {
                $pic = Picture::get($value['front_cover']);
                $value['path'] = $pic['path'];
                $value['time'] = date("Y-m-d",$value['create_time']);
            }
        }elseif($type == 2) {
            $map['type'] = 2;
            $res = $bookModel->where($map)->order($order)->limit($length,12)->select();
            foreach ($res as $value) {
                $pic = Picture::get($value['front_cover']);
                $value['path'] = $pic['path'];
                $value['time'] = date("Y-m-d",$value['create_time']);
            }
        }else {
            $map['type'] = 3;
            $res = $musicModel->where($map)->order($order)->limit($length,12)->select();
            foreach ($res as $value) {
                $pic = Picture::get($value['front_cover']);
                $value['path'] = $pic['path'];
                $value['time'] = date("Y-m-d",$value['create_time']);
            }
        }
        return $res;
    }
}