<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class RegisterController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		return $this->render('register.html');
	}
}