<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\captcha\Captcha;
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
                <a href="<?= \yii\helpers\Url::to(['resume/index'])?>">收藏的职位</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['resume/index'])?>">订阅职位</a>
            </dd>
        </dl>
        <dl class="company_center_aside">
            <dt>账号管理</dt>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/index'])?>">基本资料</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['user/photo'])?>">我的头像</a>
            </dd>
            <dd class="current">
                <a href="<?= \yii\helpers\Url::to(['user/safe'])?>">账号安全</a>
            </dd>
        </dl>
    </div>
    <!-- end .sidebar -->
    <div class="content user_modifyContent">
        <dl class="c_section">
            <dt>
            <h2><em></em>账户设置</h2>
            </dt>
            <dd>
                <div class="delivery_tabs">
                    <ul class="reset">
                        <li>
                            <a id="rel">账号绑定</a>
                        </li>
                        <li>
                            <a id="pwd">修改密码</a>
                        </li>
                    </ul>
                </div>
            </dd>
            <dd>
                <form id="updatePswForm" style="display: none" method="post" action="<?=Url::to(['user/safe'])?>">
                <table class="savePassword">
                        <tbody>
                        <tr>
                            <td>当前登录账号</td>
                            <td class="c7"><?=Yii::$app->session->get('user')['email']?></td>
                        </tr>
                        <tr>
                            <td class="label">当前密码</td>
                            <td>
                                <input type="password" maxlength="16" id="oldpassword" name="oldpassword" style="background-image: url(style/images/img/0CQnd2Jos49xUAAAAASUVORK5CYII=quot); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;">
                                <span id="updatePwd_beError" style="display:none;" class="error">
            				</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">新密码</td>
                            <td><input type="password" maxlength="16" id="newpassword" name="password" style="background-image: url(style/images/img/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=quot); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;"></td>
                        </tr>
                        <tr>
                            <td class="label">确认密码</td>
                            <td><input type="password" maxlength="16" id="comfirmpassword" name="comfirmpassword" style="background-image: url(style/images/img/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=quot); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="保 存"></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </dd>
            <dd>
                <form id="relationForm">
                    <table class="savePassword">
                        <tr>
                            <td>登录账号</td>
                            <td class="c7"><?= $model->account?></td>
                        </tr>
                        <tr>
                            <td>登录邮箱</td>
                            <td class="c7">
                                <?= $model->email?>
                                <?= $model->email_audit == 1 ? "<span style='color: blue'>已绑定</span>" : "<a id=email style='color: red'>未绑定</a>" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>登录手机</td>
                            <td class="c7">
                                <?= $model->tel?>
                                <?= $model->tel_audit == 1 ? "<span style='color: blue'>已绑定</span>" : "<a id=tel style='color: red'>未绑定</a>" ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </dd>
        </dl>
    </div>
    <div id="box1" style="width: 100%;height:100%;left:0;top:0;z-index:100;background:#F5F5F5;opacity:0.7;position: absolute;display: none"></div>
    <div id="box2" style="top:25%;left:35%;height:40%;width:30%;z-index:101;background:#F1F1F1;border-radius:10px;box-shadow:2px 2px 2px 2px #00b38a;position: absolute;display: none;">
        <div id="xxx"><span style="background: red;border:#d02c21 solid 2px;border-radius:4px;padding: 1px 12px;position: absolute;top:5%;right:8%;">X</span></div>
        <div style="margin: 10%;border:#E1E1E1 dotted 5px">
            <table style="padding: 10px 20px">
                <tr>
                    <td>邮箱账号</td>
                    <td><input type="text" id="relEmail" style="width: 80%"></td>
                </tr>
                <tr>
                    <td>验证码</td>
                    <td>
                        <input type="text" id="verifyCode" style="width: 30%">
                        <!--验证码生成器-->
                        <!--生成的验证码重新刷新，可以使用该图片的url加上refresh参数，
                        然后会返回一个json数据，其中有一个url的属性，调用该url即可获取新验证码，
                        /index.php?r=feedback/captchafeedback&refresh=1-->
                        <?=Captcha::widget([
                            'name'=>'verifyCode',
                            'captchaAction'=>'user/captcha',
                            'imageOptions'=>[
                                'alt'=>'换一个',
                                'style'=>'cursor:pointer;'],
                            'template'=>'{image}']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button class="send" style="margin: 20px">确认发送</button></td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        $('#pwd').click(function () {
            $('#updatePswForm').show('slow');
            $('#relationForm').hide();
        });
        $('#rel').click(function () {
            $('#updatePswForm').hide();
            $('#relationForm').show('slow');
        });

        $('#xxx').click(function () {
            $('#box1').hide();
            $('#box2').hide('slow');
        });
        $('#email').click(function () {
            $('#box1').show();
            $('#box2').show('slow');
        });
        $('#tel').click(function () {
            $('#box1').show();
            $('#box2').show('slow');
        });

        //发送邮件
        $('.send').click(function () {
            var email = $('#relEmail').val();
            var verifyCode = $('#verifyCode').val();
            var url = "<?= Url::to(['user/send']) ?>";
            //alert(url);return false;
            $.post(url,{email:email,verifyCode:verifyCode},function (map) {
                if(map.done == 0)
                {
                    alert(map.msg)
                }
                else
                {
                    alert(map.msg);
                    window.location.reload();
                }
            })
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
<div id="footer">
    <div class="wrapper">
        <a rel="nofollow" target="_blank" href="about.html">联系我们</a>
        <a target="_blank" href="http://www.lagou.com/af/zhaopin.html">互联网公司导航</a>
        <a rel="nofollow" target="_blank" href="http://e.weibo.com/lagou720">拉勾微博</a>
        <a rel="nofollow" href="javascript:void(0)" class="footer_qr">拉勾微信<i></i></a>
        <div class="copyright">&copy;2013-2014 Lagou <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action" target="_blank">京ICP备14023790号-2</a></div>
    </div>
</div>

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