<?php
namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "lg_company".
 *
 * @property string $id
 * @property string $companyname
 * @property string $nature
 * @property string $trade
 * @property string $province
 * @property string $city
 * @property string $street
 * @property string $scale
 * @property string $registered
 * @property string $currency
 * @property string $address
 * @property string $contact
 * @property string $telphone
 * @property string $landline_tel
 * @property string $email
 * @property string $website
 * @property string $logo
 * @property string $contents
 * @property integer $audit
 * @property integer $map_open
 * @property string $map_x
 * @property string $map_y
 * @property integer $addtime
 * @property integer $refreshtime
 * @property integer $click
 * @property integer $user_status
 * @property integer $contact_show
 * @property integer $ telephone_show
 * @property integer $address_show
 * @property integer $email_show
 * @property integer $resume_processing
 * @property string $certificate_img
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyname', 'trade'], 'required'],
            [['contents'], 'string'],
            [['audit', 'map_open', 'addtime', 'refreshtime', 'click', 'user_status', 'contact_show', ' telephone_show', 'address_show', 'email_show', 'resume_processing'], 'integer'],
            [['companyname'], 'string', 'max' => 60],
            [['nature', 'trade', 'province', 'city', 'street', 'scale', 'registered', 'currency', 'address', 'contact', 'telphone', 'landline_tel', 'email', 'website', 'logo', 'map_x', 'map_y', 'certificate_img'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyname' => 'Companyname',
            'nature' => 'Nature',
            'trade' => 'Trade',
            'province' => 'Province',
            'city' => 'City',
            'street' => 'Street',
            'scale' => 'Scale',
            'registered' => 'Registered',
            'currency' => 'Currency',
            'address' => 'Address',
            'contact' => 'Contact',
            'telphone' => 'Telphone',
            'landline_tel' => 'Landline Tel',
            'email' => 'Email',
            'website' => 'Website',
            'logo' => 'Logo',
            'contents' => 'Contents',
            'audit' => 'Audit',
            'map_open' => 'Map Open',
            'map_x' => 'Map X',
            'map_y' => 'Map Y',
            'addtime' => 'Addtime',
            'refreshtime' => 'Refreshtime',
            'click' => 'Click',
            'user_status' => 'User Status',
            'contact_show' => 'Contact Show',
            ' telephone_show' => 'Telephone Show',
            'address_show' => 'Address Show',
            'email_show' => 'Email Show',
            'resume_processing' => 'Resume Processing',
            'certificate_img' => 'Certificate Img',
        ];
    }
    public function getList($where)
    {
        $arr=Company::find()->where($where);
        $pages = new Pagination(['totalCount' => $arr->count(),'pageSize'=>2]);
        $list=Company::find()->where($where)->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages']=$pages;
        $info['list']=$list;
        return $info;
    }
    //修改认证
    public function setAudit($id,$audit)
    {
        $data =Company::find()->where(['id'=>$id])->one();
        $data->audit= $audit;
        return $data->save();
    }

}
