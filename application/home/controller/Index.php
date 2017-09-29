<?php
/**
 * Created by PhpStorm.
 * User: Lxx<779219930@qq.com>
 * Date: 2016/4/20
 * Time: 13:47
 */

namespace app\home\controller;
use app\home\model\Branch;
use app\home\model\Lead;
use app\home\model\Learn;
use app\home\model\News;
use app\home\model\Special;
use app\home\model\Today;
use think\Controller;


/**
 * 党建主页
 */
class Index extends Controller {
    public function index(){
        //党史上的今天
        $toadyModel = new Today();
        $today = $toadyModel->getIndexTag();
        $this->assign('today',$today);
        
        //新闻聚焦
        $newsModel = new News();
        $news = $newsModel->getIndexList();
        $this->assign('news',$news);
        
        //支部建设
        $branchModel = new Branch();
        $branch = $branchModel->getIndexList();
        $this->assign('branch',$branch);
        
        //红色专题
        $specialModel = new Special();
        $special = $specialModel->getIndexList();
        $this->assign('special',$special);

        //两学一做
        $learnModel = new Learn();
        $learn = $learnModel->getIndexList();
        $this->assign('learn',$learn);

        //党员风采
        $leadModel = new Lead();
        $lead = $leadModel->getIndexList();
        $this->assign('lead',$lead);
        return $this->fetch();
    }
}