<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\MyYiNews;
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
        $model = new
    return $this->render('index.html',['job_job'=>$job_job]);
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
