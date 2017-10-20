<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/9/30
 * Time: 15:16
 */

namespace app\home\controller;


use app\home\model\Comment;
use app\home\model\Like;
use think\Controller;
use think\Db;

class Base extends Controller {
    /**
     * 默认图片
     * $front_pic 封面图片id：1-10
     * $list_pic 列表图片id：35-44
     * $carousel_pic 轮播图片id: 45-54
     */
    public function default_pic(){
        //随机封面图
        $a = array('1'=>'a','2'=>'b','3'=>'c','4'=>'d','5'=>'e','6'=>'f','7'=>'g','8'=>'h','9'=>'i','10'=>'j','11'=>'k','12'=>'l','13'=>'m','14'=>'n','15'=>'o');
        $front_pic = array_rand($a,1);
        return $front_pic;
    }

    /**
     * 生成游客ID
     */
    function getRandom($len = 10,$chars=null) {
        if (is_null($chars)){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000*(double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
            $str .= $chars[mt_rand(0, $lc)];
        }
        $str = "游客_".$str;
        return $str;
    }

    /**
     * 点赞，$type,$aid
     * type值：
     * 0 评论点赞
     */
    public function like(){
//        $uid = session('userId'); //点赞人
        $uid = 0;
        $type = input('type'); //获取点赞类型
        $aid = input('aid');
        switch ($type) {    //根据类别获取表明
            case 0:
                $table = "comment";
                break;
            case 1:
                $table = "news";
                break;
            case 2:
                $table = "special_detail";
                break;
            case 3:
                $table = "learn";
                break;
            case 4:
                $table = "branch";
                break;
            case 5:
                $table = "redfilm";
                break;
            case 6:
                $table = "redbook";
                break;
            case 7:
                $table = "redmusic";
                break;
            default:
                return $this->error("无该数据表");
                break;
        }
        $data = array(
            'type' => $type,
            'table' => $table,
            'aid' => $aid,
            'uid' => $uid,
        );
        $likeModel = new Like();
//        $like = $likeModel->where($data)->find();
//        if(empty($like)) {  //点赞
            $res = $likeModel->create($data);
            if($res) {
//                //点赞成功积分+1
//                WechatUser::where('userid',$uid)->setInc('score',1);
                //更新数据
                Db::name($table)->where('id',$aid)->setInc('likes');
                return $this->success("点赞成功");
            }else {
                return $this->error("点赞失败");
            }
//        }else { //取消
//            $result = $likeModel::where($data)->delete();
//            if($result) {
////                //取消成功积分-1
////                WechatUser::where('userid',$uid)->setDec('score',1);
//                Db::name($table)->where('id',$aid)->setDec('likes');
//                return $this->success("取消成功");
//            }else {
//                return $this->error("取消失败");
//            }
//        }
    }

    /**
     * 评论，$type,$aid,$content
     * type值：
     * 1 news
     */
    public function comment(){
        if(IS_POST){
//            $uid = session('userId');
            $uid = 0;
            $type = input('type');
            $aid = input('aid');
            switch ($type) {    //根据类别获取表明
                case 1:
                    $table = "news";
                    break;
                case 2:
                    $table = "special_detail";
                    break;
                case 3:
                    $table = "learn";
                    break;
                case 4:
                    $table = "branch";
                    break;
                case 5:
                    $table = "redfilm";
                    break;
                case 6:
                    $table = "redbook";
                    break;
                case 7:
                    $table = "redmusic";
                    break;
                default:
                    return $this->error("无该数据表");
                    break;
            }
            $commentModel = new Comment();
            $data = array(
                'content' => input('content'),
                'type' => $type,
                'aid' => $aid,
                'uid' => $uid,
                'table' => $table,
            );
            $res = $commentModel->create($data);
            if($res) {  //返回comment数组
//                //评论成功增加1分
//                WechatUser::where('userid',$uid)->setInc('score',1);
                //更新主表数据
                $map['id'] = $res['aid'];   //文章id
                $model = Db::name($table)->where($map)->setInc('comments');
                if($model) {
                    if($uid == 0) {
                        $nickname = $this->getRandom();
                        $header = "/home/images/grzx.png";
                    }else {
                        $user = WechatUser::where('userid',$uid)->find();    //获取用户头像和昵称
                        $nickname = ($user['nickname']) ? $user['nickname'] : $user['name'];
                        $header =  ($user['header']) ? $user['header'] : $user['avatar']; 
                    }
                    //返回用户数据
                    $jsonData = array(
                        'id' => $res['id'],
                        'time' => date("Y-m-d",time()),
                        'content' => input('content'),
                        'nickname' => $nickname,
                        'header' => $header,
                        'type' => $type,
                        'create_time' => time(),
                        'likes' => 0,
                        'status' => 1,
                    );
                    return $this->success("评论成功","",$jsonData);
                }else {
                    return $this->error("评论失败");
                }
            }else {
                return $this->error($commentModel->getError());
            }
        }
    }

    /**
     * 加载更多评论
     */
    public function morecomment(){
        $uid = session('userId');
        $len = input('length');
        $map = array(
            'type' => input('type'),
            'aid' => input('aid'),
        );
        //敏感词屏蔽
        $badword = array(
            '法轮功','法轮','FLG','六四','6.4','flg'
        );
        $badword1 = array_combine($badword,array_fill(0,count($badword),'***'));
        $comment = Comment::where($map)->order('likes desc,create_time desc')->limit($len,7)->select();
        if($comment) {
            foreach ($comment as $value) {
                $user = WechatUser::where('userid',$value['uid'])->find();
                $value['nickname'] = ($user['nickname']) ? $user['nickname'] : $user['name'];
                $value['header'] =  ($user['header']) ? $user['header'] : $user['avatar'];
                $value['time'] = date('Y-m-d',$value['create_time']);
                $value['content'] = strtr($value['content'], $badword1);
                $map1 = array(
                    'type' => 0,
                    'aid' => $value['id'],
                    'uid' => $uid,
                    'status' => 0,
                );
                $like = Like::where($map1)->find();
                ($like) ? $value['is_like'] = 1 : $value['is_like'] = 0;
            }
            return $this->success("加载成功","",$comment);
        }else{
            return $this->error("没有更多");
        }
    }
}