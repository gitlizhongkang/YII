<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Ad;
use app\models\AdCategory;
use yii\data\Pagination;
use yii\web\UploadedFile;

class AdController extends Controller
{
	public function init(){
    	$this->enableCsrfValidation = false;
	}
	public $layout=false;
	//广告列表
	public function actionIndex(){
		$arr=Yii::$app->request->get();
		$d_time=isset($arr['d_time'])?$arr['d_time']:'';
		$status=isset($arr['status'])?$arr['status']:'';
		$cate=isset($arr['cate'])?$arr['cate']:'';
		$where='1=1';
		if(!empty($d_time)){
			$time=time();
			if($d_time==1){
				$where.=" and deadline<'$time'";
			}else{
				$times=$time+$d_time;
				$where.=" and deadline<'$times'";
			}			
		}
		if(!empty($status)){
			if($status==1){
				$where.=" and is_display='$status'";
			}else{
				$where.=" and is_display='$status'";
			}	
		}
		if(!empty($cate)){
			if($cate==1){
				$where.=" and category_id='$cate'";
			}else{
				$where.=" and category_id='$cate'";
			}	
		}
		// echo $where;
	    $query = Ad::find()->where($where);
	    $pages = new Pagination(['totalCount' => $query->count(),'pageSize'=> 3]);
	    $data['ad'] = $query->orderBy('show_order DESC')->offset($pages->offset)
	        ->limit($pages->limit)
	        ->all();
	    $data['pages']=$pages;
	    // print_r($pages);die;
		$data['adcategory']=Adcategory::find()->all();
	    return $this->render('ad.html',$data);
	}
	//删除广告
	public function actionAdDelete(){
		$id=Yii::$app->request->get('ids');
		$res=Ad::deleteall('ad_id in('.$id.')');
		if($res){
			echo 1;
			return $this->redirect(['/ad/index']);
		}else{
			echo 0;
			return $this->redirect(['/ad/index']);
		}
	}
	//修改广告
	public function actionUpdateAd(){
		$id=Yii::$app->request->get('id');
		$res=Ad::find()->where(['ad_id'=>$id])->asArray()->one();
		// print_r($res);die;
		$res['starttime']=date('Y-m-d',$res['starttime']);
		$res['deadline']=date('Y-m-d',$res['deadline']);
		$res1=Adcategory::find()->all();
		// print_r($res1);die;
		return  $this->render('update_ad.html',['res'=>$res,'res1'=>$res1]);
	}
	//修改广告入库
	public function actionUpdateAdDo(){
		$id=Yii::$app->request->get('id');
		$arr=Yii::$app->request->post();
		$res=Ad::find()->where(['ad_id'=>$id])->one();
		$arr['starttime']=strtotime($arr['starttime']);
		$arr['deadline']=strtotime($arr['deadline']);
		$res->setAttributes($arr);
		if($res->save()){
			// echo '<script>alert("修改成功！！！");</script>';
			return $this->redirect(['/ad/index']);
		}else{
			// echo '<script>alert("修改失败！！！");</script>';
			return $this->redirect(['/ad/update-ad']);
		}
	}
	//添加广告
	public function actionAdd(){
		$data['model']=new Ad;
		$data['adcategory']=Adcategory::find()->all();
 		return $this->render('add_ad.html',$data);
	}
	//添加广告 入库 上传logo
	public function actionAdDo(){
		$arr=Yii::$app->request->post();
		unset($arr['Ad']);
		$model = new Ad();
		//图片上传
        $imginfo=$model->img_url = UploadedFile::getInstances($model, 'img_url');
        //获取上传文件信息
        $img_name=$imginfo[0]->name;
        $img_path='uploads/'.$img_name;
        $arr['img_url']=$imginfo[0];
        if($model->upload($arr)){
        	$arr['starttime']=strtotime($arr['starttime']);
			$arr['deadline']=strtotime($arr['deadline']);
			$arr['addtime']=time();
			$arr['img_url']=$img_path;
			$category=new AdCategory;
			$re=$category->selectName($arr['category_id']);
			$arr['categoryname']=$re['categoryname'];
        	$model->setAttributes($arr);
        	if($model->save()){
        		return $this->redirect(['/ad/index']);
        	}else{
        		var_dump($model->errors);
        		// 打印错误信息;
        	}
        }else{
        	echo '上传失败';
        }       
	}
	//广告位列表展示
	public function actionPosition(){
		$data['adcategory']=Adcategory::find()->all();
		return $this->render('ad_position.html',$data);
	}
	//删除广告位
	public function actionCateDel(){
		$id=Yii::$app->request->get('ids');
		$res=AdCategory::deleteall('category_id in('.$id.')');
		if($res){
			echo 1;
			return $this->redirect(['/ad/position']);
		}else{
			echo 0;
			return $this->redirect(['/ad/position']);
		}
	}
	//添加广告位
	public function actionAddCate(){
		return $this->render('add_adcate.html');
	}
	//添加广告位入库
	public function actionAddCateDo(){
		$arr=Yii::$app->request->post();
		$model = new AdCategory();
		$model->setAttributes($arr);
		$model->save();
		return $this->redirect(['/ad/position']);
	}

}