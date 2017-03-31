<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="container">
    <div class="sidebar">
        <a class="btn_create" href="<?= \yii\helpers\Url::to(['resume/create'])?>">创建新简历</a>
        <dl class="company_center_aside">
            <dt>简历管理</dt>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['resume/index'])?>">我的简历</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['resume/use'])?>">已投简历</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/collect'])?>">收藏的职位</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/order'])?>">订阅职位</a>
            </dd>
        </dl>
        <dl class="company_center_aside">
            <dt>账号管理</dt>
            <dd class="current">
                <a href="<?= \yii\helpers\Url::to(['user/index'])?>">基本资料</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/photo'])?>">我的头像</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/safe'])?>">账号安全</a>
            </dd>
        </dl>
    </div>
    <!-- end .sidebar -->
    <div class="content">
        <dl class="company_center_content">
            <dt>
            <h1>
                <em></em>
                我的资料
            </h1>
            </dt>
            <dd>
                <?php
                $form = ActiveForm::begin([
                    'id' => 'jobForm',
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ],
                ]) ?>
                <table class="btm">
                    <tbody>
                    <tr>
                        <td width="25"><span class="redstar">*</span></td>
                        <td width="85">姓名</td>
                        <td>
                            <?= $form->field($model, 'name')->textInput()->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>性别</td>
                        <td>
                            <?= $form->field($model, 'sex')->radioList(['0' => '女', '1' => '男'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>身高</td>
                        <td>
                            <?= $form->field($model, 'height')->textInput()->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>出生年分</td>
                        <td>
                            <?= $form->field($model, 'birthday')->dropDownList($year,['prompt'=>'请选择','style'=>'width: 100px;height: 40px;border: solid 2px #f2f2f2'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>婚姻</td>
                        <td>
                            <?= $form->field($model, 'marriage')->radioList(['2' => '未婚', '3' => '已婚'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>籍贯</td>
                        <td>
                            <?= $form->field($model, 'province_id')->dropDownList($province,['prompt'=>'请选择','style'=>'width: 100px;height: 40px;border: solid 2px #f2f2f2'])->label(false) ?>
                            <?= $form->field($model, 'city_id')->dropDownList($city,['prompt'=>'请选择','style'=>'width: 100px;height: 40px;border: solid 2px #f2f2f2'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>现居地</td>
                        <td>
                            <?= $form->field($model,'residence')->textInput()->label(false)?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>学历</td>
                        <td>
                            <?= $form->field($model,'education')->dropDownList(['大专'=>'大专','本科'=>'本科','硕士'=>'硕士','博士'=>'博士','博士以上'=>'博士以上'], ['prompt'=>'请选择','style'=>'width: 100px;height: 40px;border: solid 2px #f2f2f2'])->label(false)?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="redstar">*</span></td>
                        <td>经验</td>
                        <td>
                            <?= $form->field($model,'experience')->dropDownList(['实习'=>'实习','1-2年'=>'1-2年','3-5年'=>'3-5年','6-10年'=>'6-10年','10年以上'=>'10年以上'], ['prompt'=>'请选择','style'=>'width: 100px;height: 40px;border: solid 2px #f2f2f2'])->label(false)?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
            </dd>
        </dl>
    </div>
    <!-- end .content -->
    <script src="style/js/job_list.min.js" type="text/javascript"></script>
    <div class="clear"></div>
    <input type="hidden" value="74fb1ce14ebf4e2495270b0fbad64704" id="resubmitToken">
    <a rel="nofollow" title="回到顶部" id="backtop"></a>
</div><!-- end #container -->
</div><!-- end #body -->


<script src="style/js/core.min.js" type="text/javascript"></script>
<script src="style/js/popup.min.js" type="text/javascript"></script>
<script src="style/js/tongji.js" type="text/javascript"></script>
<!--  -->
<script src="style/js/analytics01.js" type="text/javascript"></script><script type="text/javascript" src="style/js/h.js"></script>
<script type="text/javascript">
    $(function(){
        $('#noticeDot-1').hide();
        $('#noticeTip a.closeNT').click(function(){
            $(this).parent().hide();
        });
    });
    var index = Math.floor(Math.random() * 2);
    var ipArray = new Array('42.62.79.226','42.62.79.227');
    var url = "ws://" + ipArray[index] + ":18080/wsServlet?code=314873";
    var CallCenter = {
        init:function(url){
            var _websocket = new WebSocket(url);
            _websocket.onopen = function(evt) {
                console.log("Connected to WebSocket server.");
            };
            _websocket.onclose = function(evt) {
                console.log("Disconnected");
            };
            _websocket.onmessage = function(evt) {
                //alert(evt.data);
                var notice = jQuery.parseJSON(evt.data);
                if(notice.status[0] == 0){
                    $('#noticeDot-0').hide();
                    $('#noticeTip').hide();
                    $('#noticeNo').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }else{
                    $('#noticeDot-0').show();
                    $('#noticeTip strong').text(notice.status[0]);
                    $('#noticeTip').show();
                    $('#noticeNo').text('('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text(' ('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }
                $('#noticeDot-1').hide();
            };
            _websocket.onerror = function(evt) {
                console.log('Error occured: ' + evt);
            };
        }
    };
    CallCenter.init(url);
</script>

<div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div></body></html>