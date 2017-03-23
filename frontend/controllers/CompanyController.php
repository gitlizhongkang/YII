<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Resume;
use backend\models\Jobs;
use app\models\ResumeJob;

class CompanyController extends Controller
{
	public $layout='/header';
	public function actionGongsi(){
		
		return $this->render('gongsi.html');
	}
}