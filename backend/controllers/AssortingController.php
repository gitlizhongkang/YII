<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * 分类
 */
class AssortingController extends Controller
{
	public $layout=false;

// 无限极分类，递归
    public function tree($cat_info,$parentid = 0,$leave=0)
    {
        static $tree = array();
        foreach($cat_info as $key=>$val)
        {
            if($val['parentid'] == $parentid)
            {
                $val['leave'] = $leave;
                
                $tree[] = $val;
                $this->tree($cat_info,$val['id'],$leave+1);
            }
        }
        return $tree;
    }
/**
 * 职业分类
 */
    public function actionJob()
	{
     $cat_info = (new \yii\db\Query())
        ->select('*')
        ->from('lg_jobs_category')
        ->all();
    $job_job = $this->tree($cat_info);
    // foreach ($re as $key => $value)
    // {
    //     echo str_repeat("--",$value['leave']).$value['categoryname']."<br>";
    // }die;
    return $this->render('job.html',['job_job'=>$job_job]);
	}
//职业 添加子分类
    public function actionJobadd()
    {
        return $this->render('jobadd.html');
    }
/**
 * 地区分类
 */
    public function actionDistrict()
    {
         $cat_info = (new \yii\db\Query())
            ->select('*')
            ->from('lg_district')
            ->all();
        $district = $this->tree($cat_info);
        return $this->render('district.html',['district'=>$district]);
    }
/** 
 * * 行业分类
 */
    public function actionCraft()
    {
         $cat_info = (new \yii\db\Query())
            ->select('*')
            ->from('lg_major')
            ->all();
        $craft = $this->tree($cat_info);
        return $this->render('craft.html',['craft'=>$craft]);
    }
/** 
 * * 其他分类
 */
    public function actionRests()
    {
         $rests = (new \yii\db\Query())
            ->select('*')
            ->from('lg_group')
            ->all();
          
        return $this->render('rests.html',['rests'=>$rests]);
    }


}
