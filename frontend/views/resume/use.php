    <div id="container">
        <div class="sidebar">
            <a class="btn_create" href="<?= \yii\helpers\Url::to(['resume/create'])?>">创建新简历</a>
            <dl class="company_center_aside">
                <dt>简历管理</dt>
                <dd>
                    <a href="<?= \yii\helpers\Url::to(['resume/index'])?>">我的简历</a>
                </dd>
                <dd class="current">
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
                <dd>
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
                <h1><em></em>已投递简历状态</h1>
                <a class="d_refresh" href="javascript:;">刷新</a>
                </dt>
                <dd>
                    <div class="delivery_tabs">
                        <ul class="reset">
                            <li class="current">
                                <a href="<?= \yii\helpers\Url::to(['resume/use'])?>">全部</a>
                            </li>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['resume/use','status'=>1])?>">投递成功</a>
                            </li>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['resume/use','status'=>2])?>">被查看</a>
                            </li>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['resume/use','status'=>3])?>">不合适</a>
                            </li>
                            <li class="last">
                                <a href="<?= \yii\helpers\Url::to(['resume/use','status'=>4])?>">面试</a>
                            </li>
                        </ul>
                    </div>
                    <script>
                        $('.reset li').click(function () {
                            $(this).addClass('current').siblings().removeClass('current')
                        })
                    </script>


                    <form id="deliveryForm">
                        <?php
                        foreach ($resumeInfo as $key => $val)
                        { ?>
                        <ul class="reset my_delivery">
                            <li>
                                <div class="d_item">
                                    <h2>
                                        <a target="_blank" href="#">
                                            <em><?=$val['title']?></em>
                                            <br>
                                            <span>期望薪资:(<?=$val['wage']?>)</span>
                                        </a>
                                    </h2>
                                    <div class="clear"></div>
                                    <a title="公司名称" class="d_jobname" target="_blank" href="#">
                                        <span>公司:<?=$val['companyname']?></span>  <span>职位:[<?=$val['jobs_name']?>]</span>
                                    </a>
                                    <span class="d_time"><?=$val['add_time']?></span>
                                    <div class="clear"></div>
                                    <a class="btn_showprogress" href="javascript:;">
                                        <?php
                                        switch ($val['status'])
                                        {
                                            case 1:
                                                echo "投递成功";
                                                break;
                                            case 2:
                                                echo "被查看";
                                                break;
                                            case 3:
                                                echo "不合格";
                                                break;
                                            case 4:
                                                echo "被面试";
                                                break;
                                        }
                                        ?>
                                        <i></i></a>
                                </div>
                                <div class="progress_status	dn">
                                    <?php
                                    switch ($val['status'])
                                    {
                                        case 1:
                                            echo <<<EOF
                                        <ul class="status_steps">
										<li class="status_done status_1">1</li>
										<li class="status_line status_line_done"><span></span></li>
									</ul>
									<ul class="status_text">
										<li>投递成功</li>
									</ul>
									<ul class="status_list">
										<li class="bottom">
											<div class="list_time"><em></em>{$val['add_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功接收你的简历                               						                               					</div>
										</li>
									</ul>
EOF;
                                            break;
                                        case 2:
                                            echo <<<EOF
                                        <ul class="status_steps">
										<li class="status_done status_1">1</li>
										<li class="status_line status_line_done"><span></span></li>
										<li class="status_done"><span>2</span></li>
									</ul>
									<ul class="status_text">
										<li>投递成功</li>
										<li class="status_text_2">简历被查看</li>
									</ul>
									<ul class="status_list">
										<li class="top">
											<div class="list_time"><em></em>{$val['check_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功查看你的简历                               						                               					</div>
										</li>
										<li class="bottom">
											<div class="list_time"><em></em>{$val['add_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功接收你的简历                               						                               					</div>
										</li>
									</ul>
EOF;
                                            break;
                                        case 3:
                                            echo <<<EOF
                                    <ul class="status_steps">
										<li class="status_done status_1">1</li>
										<li class="status_line status_line_done"><span></span></li>
										<li class="status_done"><span>2</span></li>
										<li class="status_line status_line_done"><span></span></li>
										<li class="status_done"><span>3</span></li>
									</ul>
									<ul class="status_text">
										<li>投递成功</li>
										<li class="status_text_2">简历被查看</li>
										<li style="margin-left: 75px;*margin-left: 60px;" class="status_text_4">不合适</li>
									</ul>
									<ul class="status_list">
										<li class="top">
											<div class="list_time"><em></em>{$val['response_time']}</div>
											<div class="list_body">
												简历被{$val['companyname']}标记为不合适<div>您的简历已收到，但目前您的工作经历与该职位不是很匹配，因此很抱歉地通知您无法进入面试。</div>                               						                               					</div>
										</li>
										<li class="top">
											<div class="list_time"><em></em>{$val['check_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功查看你的简历                               						                               					</div>
										</li>
										<li class="bottom">
											<div class="list_time"><em></em>{$val['add_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功接收你的简历                               						                               					</div>
										</li>
									</ul>
EOF;
                                            break;
                                        case 4:
                                            echo <<<EOF
                                    <ul class="status_steps">
										<li class="status_done status_1">1</li>
										<li class="status_line status_line_done"><span></span></li>
										<li class="status_done"><span>2</span></li>
										<li class="status_line status_line_done"><span></span></li>
										<li class="status_done"><span>3</span></li>
									</ul>
									<ul class="status_text">
										<li>投递成功</li>
										<li class="status_text_2">简历被查看</li>
										<li style="margin-left: 75px;*margin-left: 60px;" class="status_text_4">面试</li>
									</ul>
									<ul class="status_list">
										<li class="top">
											<div class="list_time"><em></em>{$val['response_time']}</div>
											<div class="list_body">
												简历被{$val['companyname']}标记为面试<div>您的简历已收到，目前您的工作经历与该职位相匹配，因此很高兴地通知您将进入面试。</div>                               						                               					</div>
										</li>
										<li class="top">
											<div class="list_time"><em></em>{$val['check_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功查看你的简历                               						                               					</div>
										</li>
										<li class="bottom">
											<div class="list_time"><em></em>{$val['add_time']}</div>
											<div class="list_body">
												{$val['companyname']}已成功接收你的简历                               						                               					</div>
										</li>
									</ul>
EOF;
                                            break;
                                    }?>
                                    <a class="btn_closeprogress" href="javascript:;"></a>
                                </div>
                            </li>
                        </ul>
                        <input type="hidden" value="-1" name="tag">
                        <input type="hidden" value="" name="r">
                        <?php } ?>
                    </form>


                </dd>
            </dl>
        </div>

        <script src="style/js/delivery.js"></script>
        <script>
            $(function(){
                //location.reload(true);

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