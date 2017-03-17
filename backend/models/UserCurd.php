<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserCurd represents the model behind the search form about `app\models\User`.
 */
class UserCurd extends User
{

    public function attributes()
    {
        // 添加关联字段到可搜索属性集合
        return array_merge(parent::attributes(), ['userinfo.name','userinfo.sex']);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'last_login_time','status'], 'integer'],
            [['account', 'password', 'tel', 'email', 'head_ic', 'last_login_ip', 'userinfo.name', 'userinfo.sex'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->joinWith('userinfo');
        //$query->select("lg_user.*, lg_user_info.*");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['userinfo.name'] = [
            'asc' => ['lg_user_info.name' => SORT_ASC],
            'desc' => ['lg_user_info.name' => SORT_DESC],
        ];


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
            'lg_user_info.sex' => $this->getAttribute('userinfo.sex'),
        ]);
        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'head_ic', $this->head_ic])
            ->andFilterWhere(['like', 'last_login_ip', $this->last_login_ip])
            ->andFilterWhere(['like', 'userinfo.name', $this->getAttribute('userinfo.name')])
            ;

        return $dataProvider;
    }
}
