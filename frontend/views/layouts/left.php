<?php
use yii\helpers\Url;
$session=\Yii::$app->session;
$user=$session->get('user');
?>
<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb"><head>
</script><script type="text/javascript" async="" src="style/js/conversion.js"></script><script src="style/js/allmobilize.min.js" charset="utf-8" id="allmobilize"></script><style type="text/css"></style>
<meta content="no-siteapp" http-equiv="Cache-Control">
<link  media="handheld" rel="alternate">
<!-- end 云适配 -->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title></title>
<meta content="23635710066417756375" property="qc:admins">
<meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
<meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
<meta content="QIQ6KC1oZ6" name="baidu-site-verification">

<!-- <div class="web_root"  style="display:none">http://www.lagou.com</div> -->
<script type="text/javascript">
var ctx = "http://www.lagou.com";
console.log(1);
</script>
<link href="http://www.lagou.com/images/favicon.ico" rel="Shortcut Icon">
<link href="style/css/style.css" type="text/css" rel="stylesheet">
<link href="style/css/external.min.css" type="text/css" rel="stylesheet">
<link href="style/css/popup.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="style/js/jquery.1.10.1.min.js"></script>
<script src="style/js/jquery.lib.min.js" type="text/javascript"></script>
<script type="text/javascript" src="style/js/ajaxfileupload.js"></script>
    <script src="style/js/additional-methods.js" type="text/javascript"></script></head>
<div id="body">
	<div id="header">
    	<div class="wrapper">
    		<a href="index.html" class="logo">
    			<img src="style/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
    		</a>
    		<ul class="reset" id="navheader">
    			<li class="current"><a href="<?=Url::to(['index/index'])?>">首页</a></li>
                <li ><a href="<?=Url::to(['index/company-list'])?>" >公司</a></li>
                <li ><a href="<?=Url::to(['list/index'])?>" target="_blank">招聘中心</a></li>
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
    </div><!-- endhead -->
   <div id="container">
    <div class="sidebar">
        <a class="btn_create" href="<?=Url::to(['job/index'])?>">发布新职位</a>
        <dl class="company_center_aside">
			<dt>我收到的简历</dt>
			<dd><a href="<?= Url::to(['resu/index1']) ?>">待处理简历</a> </dd>
			<dd><a href="<?= Url::to(['resu/index2']) ?>">待定简历</a></dd>
			<dd><a href="<?= Url::to(['resu/index3']) ?>">已通知面试简历</a></dd>
			<dd><a href="<?= Url::to(['resu/index4']) ?>">不合适简历</a></dd>
		</dl>
		<dl class="company_center_aside">
			<dt>我发布的职位</dt>
			<dd><a href="<?=Url::to(['job/job','type'=>'1'])?>">有效职位</a></dd>
            <dd><a href="<?=Url::to(['job/job','type'=>'2'])?>">已下线职位</a></dd>
		</dl>
        <dl class="company_center_aside">
            <dt>会员服务</dt>
            <dd><a href="<?=Url::to(['category/account'])?>">我的账户</a></dd>
            <dd><a href="<?=Url::to(['category/advert'])?>">增值服务</a></dd>
            <dd><a href="<?=Url::to(['category/indent'])?>">充值订单</a></dd>
        </dl>
    	<div class="subscribe_side mt20">
			<div class="f14">想收到更多更好的简历？</div>
			<div class="f18 mb10">就用拉勾招聘加速助手 </div>
			<div>咨询：<a class="f16" href="mailto:jessica@lagou.com">jessica@lagou.com</a></div>
			<div class="f18 ti2em">010-57286512</div>
	    </div>
	<div class="subscribe_side mt20">
    <div class="f14">加入互联网HR交流群</div>
    <div class="f18 mb10">跟同行聊聊</div>
    <div class="f24">338167634</div>
</div>            
</div><!-- end .sidebar -->
<?php echo $content; ?>
            <div class="clear"></div>
            <!-- <input type="hidden" value="c29d4a7c35314180bf3be5eb3f00048f" id="resubmitToken"> -->
            <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
        </div><!-- end #container -->
    </div><!-- end #body -->
    <div id="footer">
        <div class="wrapper">
            <a rel="nofollow" target="_blank" href="<?=Url::to(['index/about'])?>">联系我们</a>
            <a target="_blank" href="http://www.lagou.com/af/zhaopin.html">互联网公司导航</a>
            <a rel="nofollow" target="_blank" href="http://e.weibo.com/lagou720">拉勾微博</a>
            <a rel="nofollow" href="javascript:void(0)" class="footer_qr">拉勾微信<i></i></a>
            <div class="copyright">&copy;2013-2014 Lagou <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action" target="_blank">京ICP备14023790号-2</a></div>
        </div>
    </div>
    