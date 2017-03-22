<?php
use yii\helpers\Url;
$session=\Yii::$app->session;
$user=$session->get('user');
?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <script id="allmobilize" charset="utf-8" src="style/js/allmobilize.min.js"></script>
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="alternate" media="handheld"  />
        <!-- end 云适配 -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>拉勾网-最专业的互联网招聘平台</title>
        <meta property="qc:admins" content="23635710066417756375" />
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="baidu-site-verification" content="QIQ6KC1oZ6" />

        <!-- <div class="web_root"  style="display:none">h</div> -->
        <script type="text/javascript">
            var ctx = "h";
            console.log(1);
        </script>
        <link rel="Shortcut Icon" href="h/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="style/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="style/css/external.min.css"/>
        <link rel="stylesheet" type="text/css" href="style/css/popup.css"/>
        <script src="style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="style/js/jquery.lib.min.js"></script>
        <script src="style/js/ajaxfileupload.js" type="text/javascript"></script>
        <script type="text/javascript" src="style/js/additional-methods.js"></script>
        <!--[if lte IE 8]>
        <script type="text/javascript" src="style/js/excanvas.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var youdao_conv_id = 271546;
        </script>
        <script type="text/javascript" src="style/js/conv.js"></script>
        <script src="style/js/ajaxCross.json" charset="UTF-8"></script>
    </head>
<body>
<<<<<<< HEAD
    <!--<link href="service/css/lrtk.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="service/js/lrtk.js"></script>
    <div id='cs_box'>
        <span class='cs_title'>在线咨询</span>
        <span class='cs_close'>x</span>
        <div class='cs_img'></div>
        <span class='cs_info'>有什么可以帮到你</span>
        <div class='cs_btn'>点击咨询</div>
    </div>
    <script type="text/javascript">
        myEvent(window,'load',function(){
            cs_box.set({
                img_path : 'service/images/xixi.jpg',   //设置图片路径
                qq : '632179652',   //设置QQ号码
            });
        });
    </script>-->
<div id="body">
    <div id="header">
        <div class="wrapper">
            <a href="index.html" class="logo">
                <img src="style/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
            </a>
            <ul class="reset" id="navheader">
                <li class="current"><a href="index.html">首页</a></li>
                <li ><a href="companylist.html" >公司</a></li>
                <li ><a href="#" target="_blank">论坛</a></li>
                <li ><a href="jianli.html" rel="nofollow">我的简历</a></li>
                <li ><a href="create.html" rel="nofollow">发布职位</a></li>
            </ul>
            <?php if(!empty($user)){ ?>
                <dl class="collapsible_menu">
                    <dt>
                        <span><?=$user['email']?></span>
                        <span class="red dn" id="noticeDot-0"></span>
                        <i></i>
                    </dt>
                    <?php if($user['type']==0){ ?>
                        <dd><a rel="nofollow" href="person">个人中心</a></dd>
                    <?php }else{ ?>
                        <dd><a rel="nofollow" href="">企业中心</a></dd>
                    <?php } ?>
=======
<link href="service/css/lrtk.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="service/js/lrtk.js"></script>
<div id='cs_box'>
    <span class='cs_title'>在线咨询</span>
    <span class='cs_close'>x</span>
    <div class='cs_img'></div>
    <span class='cs_info'>有什么可以帮到你</span>
    <div class='cs_btn'>点击咨询</div>
</div>
<script type="text/javascript">
    myEvent(window,'load',function(){
        cs_box.set({
            img_path : 'service/images/xixi.jpg',   //设置图片路径
            qq : '632179652',   //设置QQ号码
        });
    });
</script>
<div id="body">
	<div id="header">
    	<div class="wrapper">
    		<a href="index.html" class="logo">
    			<img src="style/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
    		</a>
    		<ul class="reset" id="navheader">
    			<li class="current"><a href="index.html">首页</a></li>
    			<li ><a href="<?=Url::to(['index/company-list'])?>" >公司</a></li>
    			<li ><a href="#" target="_blank">论坛</a></li>
    			<li ><a href="jianli.html" rel="nofollow">我的简历</a></li>
	    		<li ><a href="create.html" rel="nofollow">发布职位</a></li>
	    	</ul>
            <?php if(!empty($user)){ ?>
             <dl class="collapsible_menu">
                <dt>
                    <span><?=$user['email']?></span> 
                    <span class="red dn" id="noticeDot-0"></span>
                    <i></i>
                </dt>
                <?php if($user['type']==0){ ?>
                    <dd><a rel="nofollow" href="person">个人中心</a></dd>
               <?php }else{ ?>
                    <dd><a rel="nofollow" href="<?=Url::to(['company/index'])?>">企业中心</a></dd>
                <?php } ?>
>>>>>>> 828e1ae08b72b46c61888a1a6d09448a0b615d19
                    <dd class="logout"><a rel="nofollow" href="<?=Url::to(['register/logout'])?>">退出</a></dd>
                </dl>
            <?php }else{ ?>
                <ul class="loginTop">
                    <li><a href="<?=Url::to(['register/login'])?>" rel="nofollow">登录</a></li>
                    <li>|</li>
                    <li><a href="<?=Url::to(['register/index'])?>" rel="nofollow">注册</a></li>
                </ul>
            <?php }?>
        </div>
    </div>
<?php echo $content; ?>