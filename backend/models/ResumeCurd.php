<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resume;

/**
 * ResumeCurd represents the model behind the search form about `app\models\Resume`.
 */
class ResumeCurd extends Resume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'click', 'audit', 'display', 'sex', 'birthday', 'marriage', 'nature', 'intention_jobs_id', 'wage', 'addtime', 'refreshtime'], 'integer'],
            [['title', 'name', 'photo', 'height', 'tel', 'email', 'residence', 'birthland', 'experience', 'education', 'major', 'good_at', 'specialty'], 'safe'],
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
        $query = Resume::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
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
            'intention_jobs_id' => $this->intention_jobs_id,
            'wage' => $this->wage,
            'addtime' => $this->addtime,
            'refreshtime' => $this->refreshtime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'residence', $this->residence])
            ->andFilterWhere(['like', 'birthland', $this->birthland])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'good_at', $this->good_at])
            ->andFilterWhere(['like', 'specialty', $this->specialty]);

        return $dataProvider;
    }
}
