<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
	// $this->layout=false;
	public function actionIndex(){
		return $this->renderpartial('login.html');
	}

}