<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\JobsCategory;
use backend\models\Jobs;

class IndexController extends Controller
{
	public $layout='/header';
	//前台首页		
	public function actionIndex()
	{
		$cache=Yii::$app->cache;
		//缓存
		$ad=new Ad;
		$data['lun']=$ad->show1();
		$data['middle']=$ad->show2();
		// print_r($data['lun']);die;		
		//查询广告
		if(!empty($cache->get('jobCate'))){
			$data['jobCate']=$cache->get('jobCate');
		}else{
			$jobCate= new JobsCategory;
			$res=$jobCate->select1();
			//查询职位分类
			$data['jobCate']=$this->get_job($res);
			//重新排序
			$cache->set('jobCate',$data['jobCate']);
			//存入缓存
		}				
		$jobs=new Jobs;
		$data['jobs']=$jobs->select();
		//最热职位
		$data['new']=$jobs->select1();
		//最新职位
		return $this->render('index.html',$data);
	}
	//职位分类重新排序
	public function get_job($job)
    {
        foreach ($job as $k => $v) {
            if($v['parentid']==0){
                $arr[$v['categoryname']] = array();
                foreach ($job as $k1 => $v1) {
                    if ($v['id'] == $v1['parentid']) {
                        $arr[$v['categoryname']][$v1['categoryname']] = array();
                        foreach ($job as $k2 => $v2) {
                            if ($v1['id'] == $v2['parentid']) {
                                $arr[$v['categoryname']][$v1['categoryname']][] = $v2['categoryname'];
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }
}