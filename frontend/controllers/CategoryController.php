<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\AdCategory;
use frontend\models\Pay;
use frontend\models\Order;
use frontend\models\Points;
use frontend\models\members;

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
        $data = Pay::select();
        $arr = Points::select();
        $category_name = Yii::$app->request->get('category_name');
        return $this->render('advert_add.html',['category_name'=>$category_name,'data'=>$data,'arr'=>$arr]);
    }
//我的账户
    public function actionAccount()
    {
        $members = new members;
        $session=Yii::$app->session;
        $userinfo=$session->get('user');

        $info = $members::find()
            ->where(['log_uid'=>$userinfo])
            ->all();
        $arr = Points::select();
        return $this->render('account.html',['arr'=>$arr,'info'=>$info]);
    }
//充值订单
    public function actionIndent()
    {
        $data = Pay::select();
        $arr = Points::select();
        return $this->render('indent',['data'=>$data,'arr'=>$arr]);
    }
    public function actionOrder_list()
    {
        $order = Order::select();
        return $this->render('order_list',['order'=>$order]);
    }
//填写订单
    public function actionAdd()
    {
        $Order = new Order();
        $session=Yii::$app->session;
        $userinfo=$session->get('user');
        $uid=$userinfo['uid'];
        $arr=Yii::$app->request->post();
        $arr['uid']=$uid;
        $arr['oid']='K-'. rand() . -rand();
        return $this->render('addq',['arr'=>$arr]);
    }
//确认订单
    public function actionAddq()
    {
        $Order = new Order();
        $arr=Yii::$app->request->post();
        $Order->uid= $arr['uid'];
        $Order->pay_type= '4';
        $Order->is_paid= '2';
        $Order->oid= $arr['oid'];
        $Order->amount= $arr['show_m'];
        $Order->payment_name= 'fifen';
        $Order->addtime= time();
        $Order->notes= $arr['guanggao'];
        $Order->week= $arr['week'];
        $Order->save();
        $order = Order::select();
        return $this->render('order_list',['order'=>$order]);
    }

}