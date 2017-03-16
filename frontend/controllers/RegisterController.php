<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class RegisterController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		if(Yii::$app->request->isPost){
			$arr=Yii::$app->request->post();
			if($arr['type']==0){

			}elseif($arr['type']==1){

			}
		}else{
			return $this->render('register.html');
		}		
	}
}