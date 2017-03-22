<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Company;
use backend\models\Jobs;
use backend\models\Members;
use backend\models\Members_charge_log;
use backend\models\Order;
use yii\data\Pagination;

class OrderController extends Controller
{
    public $layout=false;
    public function init(){
        $this->enableCsrfValidation = false;
    }
    //企业列表
    public function actionOrderList()
    {
        $audit=Yii::$app->request->get("audit");
        $time=Yii::$app->request->get("time");
        $type=Yii::$app->request->get("type");
        $where="1=1";
        if($audit!=''){
            $where.=" and is_paid=$audit";
        }
        if($time!=''){
            $now_time=time();
            $addtime=$time*24*3600;
            $where.=" and $now_time-lg_order.addtime<=$addtime";
        }
        if($type!=''){
            $where.=" and pay_type=$type";
        }
        $model=new Order;
        $orderList=$model->getList($where);
        return $this->render("order_list.html",['orderList'=>$orderList['list'],'pages'=>$orderList['pages'],'audit'=>$audit,'time'=>$time,'type'=>$type]);
    }
    //删除订单
    public function actionDelOrder()
    {
        $id=Yii::$app->request->get("id");
        $model=new Order;
        $res= $model->del($id);
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"order/order-list"),
            ),
        ));
    }
    //设置订单
    public function actionOrderSet()
    {
        $id=Yii::$app->request->get("id");
        $status=Yii::$app->request->get("status");
        $model=new Order;
        $list=$model->check($id);
       if($status==1){
          return $this->render("order_set.html",array("list"=>$list));
       }
       if($status==2){
           return $this->render("order_show.html",array("list"=>$list));
       }
    }
    public function actionNoteSet()
    {
        $id=Yii::$app->request->post("id");
        $notes=Yii::$app->request->post("notes");
        $res=Order::find()->where(array("id"=>$id))->one();
        $res->notes=$notes;
        $res->save();
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"order/order-list"),
            ),
        ));
    }
    public function actionDoSet()
    {
        $points=Yii::$app->request->post("points");
        $id=Yii::$app->request->post("id");
        $uid=Yii::$app->request->post("uid");
        $notes=Yii::$app->request->post("notes");
        $amount=Yii::$app->request->post("amount");
       $res=Order::find()->where(array("id"=>$id))->one();
       $res->is_paid='2';
       $res->payment_time=time();
       $res->notes=$notes;
       $res->save();
       if($res){
           $list=Members::find()->where(array("uid"=>$uid))->asArray()->one();
           $new_points=$list['points']+$points;
           $sql="update lg_members set points=$new_points where uid=$uid";
           $res1=\Yii::$app->db->createCommand($sql)->query();
           if($res1){
               $order_list=Order::find()->where(array("id"=>$id))->asArray()->one();
               $session=Yii::$app->session;
               $admin=$session->get('admin_name');
               $now=date("Y-m-d,H:i:s",time());
               $messg="操作人：".$admin.",说明：确认收款。收款金额：".$order_list['amount']." $now"."通过：".$order_list['payment_name']." 成功充值".$order_list['amount'] ."元，(+".$points.")，(剩余:".$new_points."),订单:".$order_list['oid'];
              $data=array(
                  'log_uid'=>$uid,
                  'log_username'=>$list['username'],
                  'log_addtime'=>time(),
                  'log_value'=>$messg,
                  'log_amount'=>$points,
                  'log_ismoney'=>2,
              );
              $model=new Members_charge_log;
              $result=$model->add($data);
             if($result) {
                    $msg="操作成功";
             }else{
                    $msg="操作失败";
             }
           }
       }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"order/order-list"),
            ),
        ));
    }
}