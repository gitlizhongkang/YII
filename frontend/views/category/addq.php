<div class="content">
<link href="css/user_common.css" rel="stylesheet" type="text/css" />
<link href="css/user_company.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js" type="text/javascript" language="javascript"></script>

</head>
<body {#if $QISHI.body_bgimg#}style="background:url({#$QISHI.site_domain#}{#$QISHI.site_dir#}data/{#$QISHI.updir_images#}/{#$QISHI.body_bgimg#}) repeat-x center 38px;"{#/if#}>


<div class="page_location link_bk">当前位置：<a href="{#$QISHI.site_dir#}">首页</a> > <a href="{#$userindexurl#}">会员中心</a> > 增值服务</div>

<div class="usermain">
  <div class="leftmenu  com link_bk">
  	 
  </div>

<div class="rightmain">
  
 	<div class="bbox1 link_bk my_account intrgration" style="padding-top:0;">
		<div class="topnav">
      <div class="titleH1"><div class="h1-title">增值服务</div></div>
      <div class="navs link_bk clearfix">
        <a href="company_service.php?act=adv_list" class="se">申请广告位</a>
      </div>
    </div>

	 	<div style="height:30px;"></div>
      
  		<!-- 确认订单 -->
  		<div class="bar">
  			<div class="bar_step2 ">
  				<p>填写订单</p>
  			</div>
  			<div class="bar_step1 hui">
  				<p class="complete">确认订单</p>
  			</div>
  			<div class="bar_step3 hui">
  				<p>提交订单</p>
  			</div>
  		</div>
<form  method="post" action="index.php?r=category/addq&<?= $arr['uid']?>" enctype="multipart/form-data" >
      <div class="intrgration_box" style="margin:0 30px">
        <table>
          <tbody>
  <tr>
    <td height="30" width="100">订单号：</td>
    <td><?= $arr['oid']?></td>
     <input type="hidden" name="oid" id='oid' value="<?= $arr['oid']?>">
     <input type="hidden" name="uid" id='uid' value="<?= $arr['uid']?>">
  </tr>
  				</tbody>
  			</table>
  			<table>
  				<tbody>
            <tr>
              <td height="30" width="100">广告位名称：</td>
  						<td width="150"><?= $arr['guanggao']?></td>
              <input type="hidden" name="guanggao" id='guanggao' value="<?= $arr['guanggao']?>">
  					</tr>
  					<tr>
  						<td height="30">展示期限：</td>
  						<td width="200"><?= $arr['week']?> 周</td>
                <input type="hidden" name="week" id='week'  value="<?= $arr['week']?>">
  					</tr>
  					<tr>
  						<td height="30">支付金额：</td>
  						<td width="200"><span><?= $arr['show_m']?></span>积分</td>
                <input type="hidden" name="show_m" id='show_m' value="<?= $arr['show_m']?>">
            </tr>
            <tr>
              <td height="30">支付方式：</td>
              <td width="200">积分</td>
            </tr>
  				</tbody>
  			</table>
        <input class="but130lan intrgration_but" type="submit" name="submit" value="确认支付">
  		</div>
  	</div>
  </div>
  <div class="clear"></div>
</div>
</div>
 </form>
</body>
</html>