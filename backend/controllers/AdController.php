<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use app\models\AdCategory;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
				$where.=" and deadline<'$times' and deadline>'$time'";
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
		$ad=new Ad;		
		if($ad->deleteAd($id)){
			echo 1;
		}else{
			echo 0;
		}
	}
	//修改广告
	public function actionUpdateAd(){
		$id=Yii::$app->request->get('id');
		$ad=new Ad;	
		$res=$ad->selectOne($id);
		$res['starttime']=date('Y-m-d',$res['starttime']);
		$res['deadline']=date('Y-m-d',$res['deadline']);
		$res1=$ad->select();	
		return  $this->render('update_ad.html',['res'=>$res,'res1'=>$res1,'model'=>$ad]);
	}
	//修改广告入库
	public function actionUpdateAdDo(){
		$arr=Yii::$app->request->post();
		unset($arr['Ad']);
		$ad=new Ad;	
		$imginfo=$ad->img_url = UploadedFile::getInstances($ad, 'img_url');
        //获取上传文件信息
        if(!empty($imginfo)){
        	$img_name=$imginfo[0]->name;
        	$img_path='uploads/'.$img_name;
        	$arr['img_url']=$imginfo[0];
        	if($ad->upload($arr)){
        		$arr['img_url']=$img_path;
        	}else{
        		echo '<script>alert("上传失败！！！");location.href="'.Url::to(['ad/update-do']).'"</script>';
        	} 
        }      
    	$arr['starttime']=strtotime($arr['starttime']);
		$arr['deadline']=strtotime($arr['deadline']);
		$arr['addtime']=time();			
		$category=new AdCategory;
		$re=$category->selectName($arr['category_id']);
		$arr['categoryname']=$re['categoryname'];
		$id=$arr['id'];
		unset($arr['id']);
    	if($ad->updateAd($id,$arr)){
    		echo '<script>alert("修改成功！！！");location.href="'.Url::to(['ad/index']).'"</script>';
    	}else{
    		echo '<script>alert("修改失败！！！");location.href="'.Url::to(['ad/update-do']).'"</script>';
    	}
	}
	//添加广告
	public function actionAdd(){
		$data['model']=new Ad;
		$model=new AdCategory;
		$data['adcategory']=$model->select();
 		return $this->render('add_ad.html',$data);
	}
	//添加广告 入库 上传logo
	public function actionAdDo(){
		$arr=Yii::$app->request->post();
		unset($arr['Ad']);
		$model = new Ad;
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
        	if($model->add($arr)){
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
		$model = new AdCategory();
		$data['adcategory']=$model->select();
		return $this->render('ad_position.html',$data);
	}
	//删除广告位
	public function actionCateDel(){
		$id=Yii::$app->request->get('ids');
		$model = new AdCategory();
		if($model->deleteCate($id)){
			echo 1;
		}else{
			echo 0;
		}
	}
	//修改广告位
	public function actionCateUpdate(){
		$id=Yii::$app->request->get('id');
		$model = new AdCategory();
		$data['res']=$model->selectName($id);
		return $this->render('update_adcate.html',$data);
	}	
	//修改广告位  入库
	public function actionCateUpdateDo(){
		$id=Yii::$app->request->get('id');
		$arr=Yii::$app->request->post();
		$model = new AdCategory();
		if($model->updateCate($id,$arr)){
			echo '<script>alert("修改成功！！！");location.href="'.Url::to(['ad/position']).'"</script>';
		}else{
			echo '<script>alert("修改失败！！！");location.href="'.Url::to(['ad/cate-update']).'"</script>';
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
		$model->add($arr);
		return $this->redirect(['/ad/position']);
	}

}