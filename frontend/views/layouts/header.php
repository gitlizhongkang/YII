<?php
use yii\helpers\Url;
$session=\Yii::$app->session;
$user=$session->get('user');
?>
<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb">
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
</head>
<body>
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