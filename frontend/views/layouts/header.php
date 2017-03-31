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
        <title>Follow Me</title>
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
<!-- JS效果begin -->
<script type="text/javascript"> 
var intervalId = null; 
function slideAd(id,nStayTime,sState,nMaxHth,nMinHth){ 
  this.stayTime=nStayTime*1000 || 3000; 
  this.maxHeigth=nMaxHth || 90; 
  this.minHeigth=nMinHth || 1; 
  this.state=sState || "down" ; 
  var obj = document.getElementById(id); 
  if(intervalId != null)window.clearInterval(intervalId); 
  function openBox(){ 
   var h = obj.offsetHeight; 
   obj.style.height = ((this.state == "down") ? (h + 2) : (h - 2))+"px"; 
    if(obj.offsetHeight>this.maxHeigth){ 
    window.clearInterval(intervalId); 
    intervalId=window.setInterval(closeBox,this.stayTime); 
    } 
    if (obj.offsetHeight<this.minHeigth){ 
    window.clearInterval(intervalId); 
    obj.style.display="none"; 
    } 
  } 
  function closeBox(){ 
   slideAd(id,this.stayTime,"up",nMaxHth,nMinHth); 
  } 
  intervalId = window.setInterval(openBox,10); 
} 
</script> 
<body style="margin:0;padding:0;font-size:14px;">
<div id="MyMoveAd" style="background:#ff0;height:19px;overflow:hidden;"> 
<ul> 
 <li>给满分加截图</li> 
 <li>找右侧栏的客服人员</li>
  <li>领红包~~~Can you understand</li>  
</ul> 
</div> 
<script type="text/javascript"> 
 <!-- 
 slideAd('MyMoveAd',2); 
--> 
</script> 
</body> 
<!-- JS效果end -->
<div id="body">
	<div id="header">
    	<div class="wrapper">
    		<a href="index.html" class="logo">
    			<img src="style/images/follow1.png" width="60" height="50" alt="拉勾招聘-专注互联网招聘"/>
    		</a>
    		<ul class="reset" id="navheader">
    			<li class="current"><a href="<?=Url::to(['index/index'])?>">首页</a></li>
    			<li ><a href="<?=Url::to(['index/company-list'])?>" >公司</a></li>
    			<li ><a href="<?=Url::to(['list/index'])?>">招聘中心</a></li>
	    	</ul>
            <script>
                $(document).ready(function(){
                    var kzq="<?php $kzq=isset($_GET['r'])?$_GET['r']:'index/index'; if($kzq=='index'){$kzq='index/index';} echo $kzq;?>";
                    if(kzq=='index/index'){
                        $('#navheader li').eq(0).attr('class','current').siblings().removeAttr('class');
                    }else if(kzq=='index/company-list'){
                         $('#navheader li').eq(1).attr('class','current').siblings().removeAttr('class');
                    }else if(kzq=='list'||kzq=="list/index"||kzq=="list/"){
                         $('#navheader li').eq(2).attr('class','current').siblings().removeAttr('class');
                    }
                })
            </script>
            <?php if(!empty($user)){ ?>
             <dl class="collapsible_menu">
                <dt>
                    <span><?=$user['email']?></span> 
                    <span class="red dn" id="noticeDot-0"></span>
                    <i></i>
                </dt>
                <?php if($user['type']==0){ ?>
                    <dd><a rel="nofollow" href="<?=Url::to(['resume/index'])?>">个人中心</a></dd>
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

<link href="service/css/lrtk.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="service/js/lrtk.js"></script>
<div id='cs_box'>
    <span class='cs_title'>在线咨询</span>
    <span class='cs_close'>x</span>
    <div class='cs_img'></div>
    <span class='cs_info'>Can I help you?</span>
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


    <?php echo $content; ?>
        <div id="footer">
        <div class="wrapper">
            <a href="<?=Url::to(['index/about'])?>" target="_blank" rel="nofollow">联系我们</a>
            <a href="h/af/zhaopin.html" target="_blank">互联网公司导航</a>
            <a href="http://e.weibo.com/lagou720" target="_blank" rel="nofollow">拉勾微博</a>
            <a class="footer_qr" href="javascript:void(0)" rel="nofollow">拉勾微信<i></i></a>
            <div class="copyright">&copy;2013-2014 Lagou <a target="_blank" href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备14023790号-2</a></div>
        </div>
    </div>