<!DOCTYPE HTML>
<html><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>简历预览-我的简历-拉勾网-最专业的互联网招聘平台</title>
    <meta content="23635710066417756375" property="qc:admins">
    <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
    <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">

    <meta content="QIQ6KC1oZ6" name="baidu-site-verification">

    <!-- <div class="web_root"  style="display:none">h</div> -->
    </script><script type="text/javascript">
        var ctx = "h";
        console.log(1);
    </script>
    <link href="h/images/favicon.ico" rel="Shortcut Icon">
    <link href="style/css/style.css" type="text/css" rel="stylesheet">
    <link href="style/css/colorbox.min.css" type="text/css" rel="stylesheet">
    <link href="style/css/popup.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="style/js/jquery.1.10.1.min.js"></script>

    <script src="style/js/jquery.colorbox-min.js" type="text/javascript"></script>
    <script>
        $(function(){
            $("body").on("click","a.btn_s",function(){
                $.colorbox.close();
                parent.jQuery.colorbox.close();
            });
            $(".inline").colorbox({
                inline:true
            });
        });
    </script>
    <script src="style/js/ajaxCross.json" charset="UTF-8"></script></head>

<body>
<div id="previewWrapper">
    <div class="preview_header">
        <h1><?=$resume['title']?></h1>
        <a title="下载简历" class="inline cboxElement" href="#downloadOnlineResume">下载该简历</a>
    </div><!--end .preview_header-->

    <div class="preview_content">
        <div class="profile_box" id="basicInfo">
            <h2>基本信息</h2>
            <div class="basicShow">
                   <span>
                        <?= $resume['name']?> |
                       <?= $resume['sex'] == 1 ? '男' : '女' ?> |
                       <?= $resume['height'] ?> |
                       <?= date('Y',time()) - $resume['birthday'] ?>岁 |
                       <?= $resume['marriage'] == 1 ? '已婚': '未婚'?>
                       <br>
                        籍贯：<?= $resume['province_id'] . $resume['city_id'] . $resume['district_id'] ?>
                       <br>
                       <?= $resume['education'] ?>学历 |
                       <?= $resume['experience'] ?>工作经验
                        <br>
                       <?= $resume['tel'] ?> |
                       <?= $resume['email'] ?>
                    </span>
                <div class="m_portrait">
                    <div></div>
                    <img width="120" height="120" alt="<?= $resume['name']?>" src="<?= $resume['photo']?>">
                </div>
            </div><!--end .basicShow-->
        </div><!--end #basicInfo-->

        <div class="profile_box" id="expectJob">
            <h2>期望工作</h2>
            <div class="expectShow">
                地点：<?= $resume['residence'] ?>，<br>
                工作性质：<?php
                if($resume['nature'] == 1) {
                    echo '全职';
                }else if($resume['nature'] == 2){
                    echo '兼职';
                }else{
                    echo '实习';
                }
                    ?>，<br>
                职位：<?= $resume['intention_jobs'] ?>，<br>
                薪资：<?= $resume['wage'] ?>
            </div><!--end .expectShow-->
        </div><!--end #expectJob-->

        <div class="profile_box" id="workExperience">
            <h2>工作经历</h2>
            <div class="experienceShow">
                <ul class="wlist clearfix">
                    <li class="clear">
                        <span class="c9"><?= $resume['startYear'] ?>.<?= $resume['startMonth'] ?>-<?= $resume['endYear'] ?></span>
                        <div>
                            <img width="56" height="56" src="style/images/logo_default.png">
                            <h3><?= $resume['positionName'] ?></h3>
                            <h4><?= $resume['companyName'] ?></h4>
                        </div>
                    </li>
                </ul>
            </div><!--end .experienceShow-->
        </div><!--end #workExperience-->

        <div class="profile_box" id="projectExperience">
            <h2>项目经验</h2>
            <div class="projectShow">
                <ul class="plist clearfix">
                    <li class="noborder">
                        <div class="projectList">
                            <div class="f16 mb10">
                                <?= $resume['projectName'] ?><span class="c9">（<?= $resume['startYear_p'] ?>.<?= $resume['startMonth_p'] ?>-<?= $resume['endYear_p'] ?>）</span>
                            </div>
                            <div class="dl1"></div>
                        </div>
                    </li>
                </ul>
            </div><!--end .projectShow-->
        </div><!--end #projectExperience-->


        <div class="profile_box" id="selfDescription">
            <h2>自我描述</h2>
            <div class="descriptionShow">
                <?= $resume['specialty'] ?>
            </div><!--end .descriptionShow-->
        </div><!--end #selfDescription-->

    </div><!--end .preview_content-->
</div><!--end #previewWrapper-->

<!-------------------------------------弹窗lightbox ----------------------------------------->
<div style="display:none;">
    <!-- 下载简历 -->
    <div class="popup" id="downloadOnlineResume">
        <table width="100%">
            <tbody><tr>
                <td class="c5 f18">请选择下载简历格式：</td>
            </tr>
            <tr>
                <td>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=1">word格式</a>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=2">html格式</a>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=3">pdf格式</a>
                </td>
            </tr>
            </tbody></table>
    </div><!--/#downloadOnlineResume-->
</div>
<!------------------------------------- end ----------------------------------------->




<div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div></body></html>