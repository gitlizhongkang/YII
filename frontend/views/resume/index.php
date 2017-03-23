
<div id="container">
    <div class="sidebar">
        <a class="btn_create" href="<?= \yii\helpers\Url::to(['create'])?>">创建新简历</a>
        <dl class="company_center_aside">
            <dt>简历管理</dt>
            <dd class="current">
                <a href="<?= \yii\helpers\Url::to(['index'])?>">我的简历</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['use'])?>">已投简历</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['index'])?>">收藏的职位</a>
            </dd>
            <dd>
                <a href="<?= \yii\helpers\Url::to(['index'])?>">订阅职位</a>
            </dd>
        </dl>
        <dl class="company_center_aside">
            <dt>账号管理</dt>
            <dd>
                <a href="#">基本资料</a>
            </dd>
            <dd>
                <a href="#">我的头像</a>
            </dd>
            <dd>
                <a href="#">账号安全</a>
            </dd>
        </dl>
    </div>
    <!-- end .sidebar -->

    <div class="content">
        <dl class="company_center_content">
            <dt>
            <h1><em></em>我的简历</h1>
            </dt>
            <dd>
                <div class="filter_actions">
                    <a id="resumeRefuseAll" href="javascript:;"></a>
                </div>
                <ul class="reset resumeLists">
                    <?php foreach ($resume as $key => $val){ ?>
                        <li class="onlineResume" style="border: dotted 1px #cfc7bb">
                            <div class="resumeShow">
                                <a target="_blank" href="<?= \yii\helpers\Url::to(['view','rid'=>$val['id']]) ?>">
                                    <img src="<?= $val['photo'] ?>">
                                </a>
                                <div class="resumeIntro">
                                    <h3 class="unread">
                                        <a target="_blank" href="<?= \yii\helpers\Url::to(['view','rid'=>$val['id']]) ?>">
                                            <?= $val['title'] ?>
                                        </a>
                                    </h3>
                                    <span class="fr">刷新时间：<?= date('y-m-d H时',$val['refreshtime']) ?></span>
                                    <br>
                                    <span class="fr">点击量：<?= $val['click'] ?></span>
                                    <div>
                                    <span>
                                        <?= $val['name'] ?>/
                                        <?= $val['sex'] == 1 ? '男' : '女' ?>/
                                        <?= $val['education'] . '/' . $val['experience'] . '/' . $val['major'] ?>
                                    </span><br>
                                        <span><?= '现居地：' . $val['residence'] ?></span>
                                    </div>
                                    <div class="jdpublisher">
                                        <span><?= $val['categoryname'] . '/' . $val['wage'] ?></span>
                                    </div>
                                </div>
                                <div class="links">
                                    <a data-deliverid="1686182"  href="javascript:void(0)">修改简历</a>
                                    <a data-deliverid="1686182"  href="javascript:void(0)">删除简历</a>
                                    <a data-deliverid="1686182"  href="javascript:void(0)">投递</a>
                                </div>
                            </div>
                            <div class="contactInfo">
                                <span class="c9">电话：</span><?= $val['tel'] ?>&nbsp;&nbsp;&nbsp;
                                <span class="c9">邮箱：</span><a href="mailto:<?= $val['email'] ?>"><?= $val['email'] ?></a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
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