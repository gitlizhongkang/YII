<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%ad}}".
 *
 * @property string $ad_id
 * @property integer $is_display
 * @property integer $category_id
 * @property integer $type_id
 * @property string $title
 * @property string $show_order
 * @property string $addtime
 * @property string $starttime
 * @property integer $deadline
 * @property string $img_url
 * @property string $category_name
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    // public $img_url;

    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_display', 'category_id', 'show_order', 'addtime', 'starttime', 'deadline'], 'integer'],
            [['category_id',  'title', 'addtime', 'starttime', 'categoryname'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['img_url'], 'string', 'max' => 250],
            [['categoryname','text_content'], 'string', 'max' => 255],
            [['img_url'], 'file', 'extensions' => 'png, jpg, gif, jpeg', 'maxFiles' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ad_id' => 'Ad ID',
            'is_display' => 'Is Display',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'show_order' => 'Show Order',
            'addtime' => 'Addtime',
            'starttime' => 'Starttime',
            'deadline' => 'Deadline',
            'img_url' => '广告logo',
            'categoryname' => 'Category Name',
            'text_content'=>'备注',
        ];
    }
    //查询广告位
    public function select()
    {
        return $this->find()->all();
    }
    //文件上传
     public function upload($arr)
    {
        if ($this->validate($arr)) {
            foreach ($this->img_url as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    //根据id查询
    public function selectOne($ad_id)
    {
        return $this->findOne($ad_id);
    }
     //添加广告
    public function add($arr){
        $this->setAttributes($arr);
        return $this->save();
    }
    //修改广告
    public function updateAd($id,$arr){
        $res=$this->findOne($id);
        $res->setAttributes($arr);
        return $res->save();
    }
    //删除广告
    public function deleteAd($id){
        return $this->deleteall('ad_id in('.$id.')');
    }
    //广告位轮播图显示
    public function show1(){
        $time=time();
        return $this->find()->where(['>','deadline',$time])->andWhere(['<','starttime',$time])->andWhere(['categoryname'=>'首页图片轮番广告'])->andWhere(['is_display'=>1])->all();
    }
     //广告位中部格子显示
     public function show2(){
        $time=time();
       return $this->find()->where(['>','deadline',$time])->andWhere(['categoryname'=>'首页中部格子广告'])->andWhere(['is_display'=>1])->all();
    }
}
