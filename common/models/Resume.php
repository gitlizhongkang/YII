<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\JobsCategory;

/**
 * This is the model class for table "{{%resume}}".
 *
 * @property string $id
 * @property string $uid
 * @property integer $click
 * @property integer $audit
 * @property integer $display
 * @property string $title
 * @property string $name
 * @property int $photo_id
 * @property integer $sex
 * @property string $height
 * @property integer $birthday
 * @property string $tel
 * @property string $email
 * @property string $residence
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $marriage
 * @property integer $district_id
 * @property integer $nature
 * @property string $experience
 * @property string $education
 * @property string $major
 * @property integer $intention_jobs_id
 * @property string $wage
 * @property string $good_at
 * @property string $specialty
 * @property integer $addtime
 * @property integer $refreshtime
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume}}';
    }


    /**
     * @inheritdoc
     */
    public function attributes()
    {
        // 添加关联字段到可搜索属性集合
        return array_merge(parent::attributes(), ['category.categoryname']);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['uid', 'title', 'name', 'sex', 'height', 'birthday', 'tel', 'email', 'experience', 'education', 'major', 'intention_jobs_id', 'wage', 'good_at', 'specialty', 'addtime', 'refreshtime'], 'required'],
            [['category.categoryname','uid', 'click', 'audit', 'display', 'sex', 'birthday', 'marriage', 'nature', 'intention_jobs_id', 'addtime', 'refreshtime','photo_id', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['title'], 'string', 'max' => 80],
            [['name', 'wage'], 'string', 'max' => 30],
            [[ 'tel', 'major'], 'string', 'max' => 50],
            [['height'], 'string', 'max' => 5],
            [['email'], 'string', 'max' => 60],
            [['experience', 'education','residence'], 'string', 'max' => 50],
            [['good_at'], 'string', 'max' => 250],
            [['specialty'], 'string', 'max' => 200],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'click' => 'Click',
            'audit' => 'Audit',
            'display' => 'Display',
            'title' => 'Title',
            'name' => 'Name',
            'photo_id' => 'Photo',
            'sex' => 'Sex',
            'height' => 'Height',
            'birthday' => 'Birthday',
            'tel' => 'Tel',
            'email' => 'Email',
            'residence' => 'Residence',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'district_id' => 'District ID',
            'marriage' => 'Marriage',
            'nature' => 'Nature',
            'experience' => 'Experience',
            'education' => 'Education',
            'major' => 'Major',
            'intention_jobs_id' => 'Intention Jobs',
            'wage' => 'Wage',
            'good_at' => 'Good At',
            'specialty' => 'Specialty',
            'addtime' => 'Addtime',
            'refreshtime' => 'Refreshtime',
        ];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(JobsCategory::className(), ['id' => 'intention_jobs_id']);
    }


    /**
     * Creates data provider instance with search query applied
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Resume::find()->joinWith('category');
        $query->select("lg_resume.*, lg_jobs_category.categoryname");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['category.categoryname'] = [
            'asc' => ['lg_jobs_category.categoryname' => SORT_ASC],
            'desc' => ['lg_jobs_category.categoryname' => SORT_DESC],
        ];


        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
            'click' => $this->click,
            'audit' => $this->audit,
            'display' => $this->display,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'marriage' => $this->marriage,
            'nature' => $this->nature,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'intention_jobs_id' => $this->intention_jobs_id,
            'addtime' => $this->addtime,
            'refreshtime' => $this->refreshtime,
            'photo_id', $this->photo_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'residence', $this->residence])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'wage', $this->wage])
            ->andFilterWhere(['like', 'good_at', $this->good_at])
            ->andFilterWhere(['like', 'specialty', $this->specialty])
            ->andFilterWhere(['like', 'lg_jobs_category', $this->getAttribute('category.categoryname')]);

        return $dataProvider;
    }



    /**
     * @brief 查询数据
     * @param array $condition
     * @return array|\yii\db\ActiveRecord[]
     */
    public function selectAll($condition = [])
    {
        return self::find()->where($condition)->asArray()->all();
    }

    //查询一个用户的所有简历
    public function select($u_id){
        return $this->find()->where(['uid'=>$u_id])->all();
    }
}
