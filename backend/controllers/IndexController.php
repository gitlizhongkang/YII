<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class IndexController extends Controller
{
	public function actionIndex(){
		$session=Yii::$app->session;
		$admin_name=$session->get('admin_name');
		return $this->render('index.html',['admin_name'=>$admin_name]);	
	}
	public function actionMain(){
		$session=Yii::$app->session;
		$admin_name=$session->get('admin_name');
		return $this->render('main.html',['admin_name'=>$admin_name]);	
	}
}