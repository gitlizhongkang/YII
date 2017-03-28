<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\AdCategory;
use frontend\models\Pay; 
use frontend\models\Points;

class CategoryController extends Controller
{
    public $layout='left';
//广告		
	public function actionAdvert()
	{
        $data = AdCategory::Category();
		return $this->render('advert.html',['data'=>$data]);
	}
//购买广告
    public function actionAdvert_add()
    {
        $category_id = Yii::$app->request->post('category_id');
        return $this->render('advert_add.html');
    }
//我的账户
    public function actionAccount()
    {
        return $this->render('account.html');
    }
//充值订单
    public function actionIndent()
    {
        $data = Pay::select();
        $arr = Points::select();
        return $this->render('indent',['data'=>$data,'arr'=>$arr]);
    }

}