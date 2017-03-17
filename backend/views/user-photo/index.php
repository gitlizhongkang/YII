<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserPhoto */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-photo-index">

    <h1>User Photos</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'         => 'yii\grid\CheckboxColumn',   //复选 全选
                'cssClass'      => '_check',
                'footer'        => '<a href="javascript:;" id="delete-all">全部删除</a>',
            ],

            'id',
            'user_id',
            'photo',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'header'=> '<a href="javascript:;">操作</a>',
            ],
        ],
        'emptyText'=>'当前没有简历',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold'],
    ]); ?>
</div>
