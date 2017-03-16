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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'click',
            'audit',
            'display',
            'title',
            'name',
            'photo',
            'sex',
            'height',
            'birthday',
            'tel',
            'email:email',
            'residence',
            'birthland',
            'marriage',
            'nature',
            'experience',
            'education',
            'major',
            'intention_jobs_id',
            'wage',
            'good_at',
            'specialty',
            'addtime:datetime',
            'refreshtime:datetime',
        ],
    ]) ?>

</div>
