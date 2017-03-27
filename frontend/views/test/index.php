<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>
<?php $form = ActiveForm::begin(); ?>


1111111111
<?=Captcha::widget([
    'name'=>'verifyCode',
    'captchaAction'=>'test/captcha',
    'imageOptions'=>[
        'id'=>'verifyCode',
        'title'=>'换一个',
        'alt'=>'换一个',
        'style'=>'cursor:pointer;margin-top:10px; height: 22px;'],
    'template'=>'{image}{input}']);
?>

22222222222
<?= $form->field($verify, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    'captchaAction'=>'test/captcha',
]) ?>



<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
