<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $account
 * @property string $password
 * @property string $tel
 * @property string $email
 * @property string $head_ic
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class User extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel_audit','email_audit','last_login_time','status'], 'integer'],
            [['account', 'email'], 'string', 'max' => 50],
            [['last_login_ip'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 11],
            //[['head_ic'], 'string', 'max' => 100],
            //[['userinfo.name', 'userinfo.sex'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => 'Account',
            'password' => 'Password',
            'tel' => 'Tel',
            'tel_audit' =>'Tel_audit',
            'email' => 'Email',
            'email_audit' => 'Email_audit',
            'head_ic' => 'Head Ic',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc 上传
     */
    public function upload()
    {
        if ($this->validate() && isset($this->head_ic)) {
            $file = 'uploads/' . $this->head_ic->baseName . '.' . $this->head_ic->extension;
            $this->head_ic->saveAs($file);
            return $file;
        } else {
            return false;
        }
    }


    /**user id关联userinfo user_id模型
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();//->joinWith('userinfo')
        //$query->select("lg_user.*, lg_user_info.name,lg_user_info.sex");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*$dataProvider->sort->attributes['userinfo.name'] = [
            'asc' => ['lg_user_info.name' => SORT_ASC],
            'desc' => ['lg_user_info.name' => SORT_DESC],
        ];*/


        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'last_login_time' => $this->last_login_time,
            'status' => $this->status,
            'tel_audit' => $this->tel_audit,
            'email_audit' => $this->email_audit,
            //'lg_user_info.sex' => $this->getAttribute('userinfo.sex'),
        ]);
        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'head_ic', $this->head_ic])
            ->andFilterWhere(['like', 'last_login_ip', $this->last_login_ip])
            //->andFilterWhere(['like', 'lg_user_info.name', $this->getAttribute('userinfo.name')])
        ;

        return $dataProvider;
    }
     //添加
    public function add($arr){
        $this->setAttributes($arr);
        $this->save($arr);
        return $this->attributes['id'];
    }
    //验证邮箱
    public function checkEmail($email){
        return $this->find()->where(['email'=>$email])->one();
    }
}
