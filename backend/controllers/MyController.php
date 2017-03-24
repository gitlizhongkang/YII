<?php
namespace backend\controllers;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use common\models\User;
use app\models\AuthAssignment;
use app\models\AuthItemChild;
class MyController extends Controller
{
	public function beforeAction($action)
	{
	   if(parent::beforeAction($action)){
            $controllerId=$action->controller->id;

            //获取控制器名称
            $actionId=$action->id;
            //获取方法名称
            $nodeName=$controllerId.'/'.$actionId; //abc_index
            //$user=\Yii::$app->user->identity;
            //验证是否登录
            $session=Yii::$app->session;
            if(!$session->get('admin_name')){
                $this->redirect(['/']);
            }
            if($this->can($nodeName)){
                return true;
            }else{
                throw new ForbiddenHttpException('对不起，您还没获此操作的权限');
            }
        }else{
            return false;
        } 
	}
    public function can($nodeName){
        $admin_id=Yii::$app->session->get('admin_id');
        $model= new AuthAssignment;
        $power=$model->getPower($admin_id);
        foreach ($power as $key => $value) {
            $powers[]=$power[$key]['child'];
        }
        if(in_array($nodeName, $powers)){
            return 1;
        }else{
            return 0;
        }
    } 
}