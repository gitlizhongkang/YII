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
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/index'])?>">基本资料</a>
            </dd>
            <dd class="current">
                <a href="<?= \yii\helpers\Url::to(['user/photo'])?>">我的头像</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/safe'])?>">账号安全</a>
            </dd>
        </dl>
    </div>
    <!-- end .sidebar -->
    <div class="content_l" style="margin: 0 0 0 40px">
        <dl class="c_delivery">
            <dt>
            <h1><em></em>上传头像状态</h1>
            <a class="d_refresh" href="javascript:;">刷新</a>
            </dt>
            <dd>
                <div class="delivery_tabs">
                    <ul class="reset">
                        <li>
                            <a style="background: #00b38a;padding: 1px 12px;border:#00b38a solid 2px;border-radius: 4px" id="upload">上传</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/photo'])?>">全部</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/photo','status'=>1])?>">审核中</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/photo','status'=>2])?>">审核成功</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/photo','status'=>3])?>">审核失败</a>
                        </li>
                    </ul>
                </div>

                <script>
                    $('.reset li').click(function () {
                        $(this).addClass('current').siblings().removeClass('current')
                    })
                </script>

                <form id="deliveryForm">
                        <ul class="reset my_delivery">
                            <?php foreach ($model as $key => $val)
                            { ?>
                            <li>
                                <div class="d_item">
                                    <h2>
                                        <a target="_blank" href="#">
                                            <em>照片<?= $key + 1 ?></em>
                                        </a>
                                    </h2>
                                    <div class="clear"></div>
                                    <a title="简历照片" class="d_jobname" target="_blank" href="<?=$val['photo']?>">
                                        <span>状态:</span>
                                        <span><?php
                                            if($val['status'] == 1) {
                                                echo '审核中';
                                            } else if($val['status'] == 2) {
                                                echo '审核通过';
                                            } else {
                                                echo '审核未通过';
                                            }
                                            ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <img src="<?=$val['photo']?>" width="100" height="60">
                                    </a>
                                    <span class="d_time"></span>
                                    <div class="clear"></div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <input type="hidden" value="-1" name="tag">
                        <input type="hidden" value="" name="r">
                </form>
            </dd>
        </dl>
    </div>
    <div id="box1" style="width: 100%;height:100%;left:0;top:0;z-index:100;background:#F5F5F5;opacity:0.7;position: absolute;display: none"></div>
    <div id="box2" style="top:25%;left:35%;height:40%;width:30%;z-index:101;background:#F1F1F1;border-radius:10px;box-shadow:2px 2px 2px 2px #00b38a;position: absolute;display: none;">
        <div id="xxx"><span style="background: red;border:#d02c21 solid 2px;border-radius:4px;padding: 1px 12px;position: absolute;top:5%;right:8%;">X</span></div>
        <div style="margin: 10%;border:#E1E1E1 dotted 5px">
            <?php
            $form = ActiveForm::begin([
                'id' => 'jobForm',
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
            ]) ?>
            <table>
                <tr>
                    <td width="25"><span class="redstar">*</span></td>
                    <td width="85">上传头像</td>
                    <td>
                        <!--多文件上传-->
                        <?=$form->field($upload,'photo[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label(false) ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" style="font-size: 14px">(单个或者多个文件上传)</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <?= Html::submitButton('保存') ?>
                    </td>
                </tr>
            </table>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <script>
        $('#upload').click(function () {
            $('#box1').show();
            $('#box2').show('slow');
        });
        $('#xxx').click(function () {
            $('#box1').hide();
            $('#box2').hide('slow');
        })
    </script>


    <script src="style/js/delivery.js"></script>
    <script>
        $(function(){
            $('.Pagination').pager({
                currPage: 1,
                pageNOName: "pageNo",
                form: "deliveryForm",
                pageCount: 1,
                pageSize:  5
            });
        });
    </script>
    <div class="clear"></div>
    <input type="hidden" value="" id="resubmitToken">
    <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
</div><!-- end #container -->
</div><!-- end #body -->


<script src="style/js/core.min.js" type="text/javascript"></script>
<script src="style/js/popup.min.js" type="text/javascript"></script>

<!--  -->

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