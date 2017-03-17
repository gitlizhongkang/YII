<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use backend\models\JobCategory;

class IndexController extends Controller
{
	public $layout='/header';

	public function actionIndex()
	{
		$ad=new Ad;
		$data['lun']=$ad->show1();
		$data['middle']=$ad->show2();		
		return $this->render('index.html',$data);
	}

}