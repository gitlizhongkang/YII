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
            [
                'attribute'=>'head_ic',
                'value'=>$model->head_ic,
                'format' => ['image', ['width'=>'60', 'height'=>'40']],
            ],
            ['attribute'=>'last_login_time', 'format'=>['date', 'php:Y-m-d H:i:s']],
            'last_login_ip',
            'userinfo.name',
            'userinfo.sex',
            [
                'attribute'=>'sex',
                'value'=>function($model) {
                    if(isset($model->getRelatedRecords()['userinfo']))
                    return $model->getRelatedRecords()['userinfo']->sex == 0 ? '女' : '男';
                }
            ],
            'userinfo.birthday',
            'userinfo.birthland',
            'userinfo.residence',
            'userinfo.education',
            'userinfo.experience',
            [
                'attribute'=>'marriage',
                'value'=>function($model) {
                    if(isset($model->getRelatedRecords()['userinfo']))
                    return $model->getRelatedRecords()['userinfo']->marriage == 0 ? '未婚' : '已婚';
                }
            ],
            ['attribute'=>'userinfo.reg_time', 'format'=>['date', 'php:Y-m-d H:i:s']],
        ],
    ]) ?>

    联查 地区
</div>
