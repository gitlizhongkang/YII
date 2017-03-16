<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use backend\models\JobCategory;

class IndexController extends Controller
{
	public $layout='/header';
<<<<<<< HEAD
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

	public function actionIndex(){
		$time=time();
		$data['lun']=Ad::find()->where(['>','deadline',$time])->andWhere(['category_id'=>1])->all();
		$data['middle']=Ad::find()->where(['>','deadline',$time])->andWhere(['category_id'=>2])->all();
		// print_r($data['middle']);die;

	$cat_info = (new \yii\db\Query())
        ->select('*')
        ->from('lg_jobs_category')
        ->all();
    $job_job = $this->tree($cat_info);
    // foreach ($re as $key => $value)
    // {
    //     echo str_repeat("--",$value['leave']).$value['categoryname']."<br>";
    // }die;

=======
	public function actionIndex(){		
		$ad=new Ad;
		$data['lun']=$ad->show1();
		$data['middle']=$ad->show2();		
>>>>>>> cd4732f09b9318004147a949b886278be77223ee
		return $this->render('index.html',$data);
	}

}