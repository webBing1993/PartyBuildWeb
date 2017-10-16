<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2017/10/16
 * Time: 11:32
 */

namespace app\home\controller;
use app\home\model\Answers;
use app\home\model\Question;

/**
 * Class Question
 * @package app\home\controller
 * 每日一课
 */
class Lesson extends Base {
    /*
     * 每日一课 页面
     */
    public function answer(){
        $arr = Question::all(['type'=>0]);
        foreach($arr as $value){
            $ids[] = $value->id;
        }
        //随机获取单选的题目
        $num = 5;//题目数目
        $data=array();
        while(true){
            if(count($data) == $num){
                break;
            }
            $index = mt_rand(0,count($ids)-1);
            $res = $ids[$index];
            if(!in_array($res,$data)){
                $data[] = $res;
            }
        }
        foreach($data as $value){
            $question[] = Question::get($value);
        }
        $this->assign('question',$question);
        return $this->fetch();
    }
    /*
     * 每日一课 提交
     */
    public function commit(){
        // 获取用户提交数据
        $data = input('post.');
        $arr = $data['arr'];
        $question = array();
        $status = array();
        $options = array();
        $Right = array();
        $score = 0;
        foreach($arr as $key => $value){
            $Question = Question::get($value[0]);
            switch($Question->value){
                case 1:
                    $right = "A";
                    break;
                case 2:
                    $right = "B";
                    break;
                case 3:
                    $right = "C";
                    break;
                case 4:
                    $right = "D";
                    break;

            }
            $Right[$key+1] = $right;
            $question[$key] = $value[0];
            $options[$key] = $value[1];
            // 判断 题目的对错
            if($value[1] == $Question->value){
                $status[$key] = 1;
                $score ++;
            }else{
                $status[$key] = 0;
            }
        }
        //将获取的数据进行json格式转化
        $questions = json_encode($question);
        $rights = json_encode($options);
        $status = json_encode($status);
        //  存储 表
        $Answers = new Answers();
        $data = array(
            'question_id' => $questions,
            'value' => $rights,
            'status' => $status,
            'score' => $score,
            'create_time' => time(),
        );
        $res = $Answers->save($data);
        if($res){
            return $this->success('提交成功',array('id' =>$res,'score'=>$score,'right'=>$Right));
        }else{
            return $this->error('提交失败');
        }
    }
    /*
     * 每日一课  查看详情
     */
    public function goon(){
        $id = input('id');
        $Answers = Answers::get($id);
        $Qid = json_decode($Answers->question_id);
        $rights = json_decode($Answers->value);
        $re = array();
        foreach($Qid as $key => $value){
            $re[$key] = Question::get($value);
            $re[$key]['right'] = $rights[$key];
        }
        $this->assign('question',$re);
        $this->assign('score',$Answers['score']);
        return $this->fetch();
    }
}