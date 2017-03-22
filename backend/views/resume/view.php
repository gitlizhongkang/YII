<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-view">

    <p>
       <!--<?/*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?> -->
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uid',
            'click',
            'audit',
            'display',
            'title',
            'name',
            [
                'attribute'=>'photo_id',
                'value'=>$model->photo_id,
                'format' => ['image', ['width'=>'60', 'height'=>'40']],
            ],
            [
                'attribute'=>'sex',
                'value'=>function($model) {
                    return $model->sex == 0 ? '女' : '男';
                }
            ],
            'height',
            'birthday',
            'tel',
            'email:email',
            'residence',
            'birthland',
            [
                'attribute'=>'marriage',
                'value'=>function($model) {
                    return $model->marriage == 0 ? '未婚' : '已婚';
                }
            ],
            'nature',
            'experience',
            'education',
            'major',
            'intention_jobs_id',
            'wage',
            'good_at',
            'specialty',
            ['attribute'=>'addtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
            ['attribute'=>'refreshtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
        ],
    ]) ?>

    联查 地区 职位 照片
</div>
