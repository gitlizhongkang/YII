<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'account',
            'password',
            'tel',
            'email:email',
            'head_ic',
            'last_login_time:datetime',
            'last_login_ip',
        ],
    ]) ?>

    <?php
    if($model->getRelatedRecords()['userinfo'])
    {
        echo DetailView::widget([
            'model' => $model->getRelatedRecords()['userinfo'],
            'attributes' => [
                'user_id',
                'name',
                'sex',
                'birthday',
                'birthland',
                'residence',
                'education',
                'experience',
                'marriage',
                'reg_time',
            ],
        ]);
    }
    ?>

</div>
