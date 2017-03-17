<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\JobsCategory;

/**
 * 分类
 */
class AssortingController extends Controller
{
	public $layout=false;

/**
 * 职业分类
 */
public function actionJob()
{
    
    $common = new \common\models\JobsCategory;
    $job_job = $common->select();
    // echo str_repeat("--",$value['leave']).$value['categoryname']."<br>";
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
        $common = new \common\models\District;
        $district = $common->district();
        return $this->render('district.html',['district'=>$district]);
    }

/** 
 * * 行业分类
 */
    public function actionCraft()
    {
        $common = new \common\models\Major;
        $craft = $common->Craft();
        return $this->render('craft.html',['craft'=>$craft]);
    }
 /** 
 * * 其他分类
 */
    public function actionRests()
    {
         $common = new \common\models\Group;
         $rests = $common->rests(); 
        return $this->render('rests.html',['rests'=>$rests]);
    }
 /** 
 * * 其他查看
 */
    public function actionRestsshow()
    {
        $arr=Yii::$app->request->get();
        $restsk = (new \yii\db\Query())
            ->select('*')
            ->from('lg_category')
            ->where(array('c_alias'=>$arr['tj']))
            ->all();
        return $this->render('restsshow.html',['restsk'=>$restsk]);
    }
}
