<?php
namespace frontend\controllers;

use Codeception\Lib\Di;
use common\models\District;
use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\JobsCategory;

use common\models\Category;
use common\models\Hots;
use backend\models\Company;
use yii\data\Pagination;
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
			$data['jobCate']=$jobCate->select1();
			//查询职位分类
			$cache->set('jobCate',$data['jobCate']);
			//存入缓存
		}				
		$jobs=new Jobs;
		$data['jobs']=$jobs->select();
		//最热职位
		$data['new']=$jobs->select1();
		//最新职位
        $HotsModel=new Hots;
        $data['hots']=$HotsModel->GetRankList();
         //热搜
        if(!empty($cache->get('num'))){
            $data['num']=$cache->get('num');
        }else{
            $model=new Company;
            $date['count_companys']=$model->find()->select('count(id) as num')->asArray()->one();
            $date['count_jobs']=$jobs->find()->select('count(id) as num')->asArray()->one();
            // 值$value 在缓存中最多保留30秒
            $cache->set('num', $date,3600);//存入缓存
            $data['num']=$date; 
            //查询职位分类
        }
		return $this->render('index.html',$data);
	}
	public function actionCompanyList()
    {
        $province_id=Yii::$app->request->get("province_id");
        $scale_id=Yii::$app->request->get("scale_id");
        $trade_id=Yii::$app->request->get("trade_id");
        $where="audit=1";
        if($province_id!=''){
            $where.=" and city='$province_id'";
        }
        if($scale_id!=''){
            $where.=" and scale_id=$scale_id";
        }
        if($trade_id!=''){
            $where.=" and trade_id=$trade_id";
        }
        $data['provincelist']=District::find()->where("parentid = 0")->asArray()->all();
        $data['scalelist']=Category::find()->where("c_alias = 'QS_scale'")->asArray()->all();
        $data['tradelist']=Category::find()->where("c_alias = 'QS_trade'")->asArray()->all();
        $model=new Company;
        $list=$model->getList1($where);
        $data['companylist']=$list['list'];
        $data['pages']=$list['pages'];
        $data['province_id']=$province_id;
        $data['scale_id']=$scale_id;
        $data['trade_id']=$trade_id;
        return $this->render("companylist.html",$data);
    }
	//职位分类重新排序
	public function get_job($job)
    {
        foreach ($job as $k => $v)
        {
            if($v['parentid']==0)
            {
                $arr[$v['categoryname']] = array();
            }
                foreach ($job as $k1 => $v1) 
                {
                    if ($v['id'] == $v1['parentid']) 
                    {
                        $arr[$v['categoryname']][$v1['categoryname']] = array();
                        foreach ($job as $k2 => $v2)
                         {
                            if ($v1['id'] == $v2['parentid']) 
                            {
                                $arr[$v['categoryname']][$v1['categoryname']][] = $v2['categoryname'];
                            }
                        }
                    }
                }
            }
 
        return $arr;
    }
    public function actionAbout(){
        return $this->render('about.html');
    }
}