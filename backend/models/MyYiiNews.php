<?php
namespace backend\models;

use Yii;

class MyYiiNews extends \yii\db\ActiveRecord
{



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
    return $job_job;
    }

}