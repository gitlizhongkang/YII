<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Hots;
/**
* 
*/
class HotsController extends Controller
{
    public $layout=false;
	public function actionShow(){
		$model=new Hots;
		$data=$model->getList();
		return $this->render('show.html',['data'=>$data]);
	}
}