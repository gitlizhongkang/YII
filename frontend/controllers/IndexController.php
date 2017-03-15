<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;

class IndexController extends Controller
{
	public $layout='/header';
	public function actionIndex(){
		$time=time();
		$data['lun']=Ad::find()->where(['>','deadline',$time])->andWhere(['category_id'=>1])->all();
		$data['middle']=Ad::find()->where(['>','deadline',$time])->andWhere(['category_id'=>2])->all();
		// print_r($data['middle']);die;
		return $this->render('index.html',$data);
	}
}