<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = 'Create Resume';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
