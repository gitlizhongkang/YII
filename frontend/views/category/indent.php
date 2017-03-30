<div class="content">
<title>{#$title#}</title>
<link rel="shortcut icon" href="{#$QISHI.site_dir#}favicon.ico" />
<link href="cas/css/user_common.css" rel="stylesheet" type="text/css" />
<link href="cas/css/user_company.css" rel="stylesheet" type="text/css" />
<script src="cas/js/jquery.js" type="text/javascript" language="javascript"></script>
<script src="cas/js/jquery.validate.min.js" type='text/javascript' language="javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
	//计算获得积分数量
	$("#amount").keyup(function(){	
		if((/^(\+|-)?\d+$/.test($(this).val())) && $(this).val()>={#$QISHI.payment_min#})
		{
		$("#count").css("display","");	
		$("#show_val").html("充值金额为<strong style=\"color:#003399\">&nbsp;&nbsp;"+$(this).val()+"&nbsp;&nbsp;</strong>元，可获得：&nbsp;&nbsp;<span style=\"color: #009900; font-size:22px; font-style:italic\">"+$(this).val()*{#$QISHI.payment_rate#}+"</span>&nbsp;&nbsp;{#$QISHI.points_quantifier#}{#$QISHI.points_byname#}");   
		}
		else
		{
		$("#count").css("display","none");	
		}	
	});	
})
//验证
$(document).ready(function() {
 $("#Form1").validate({
 //debug: true,
// onsubmit:false,
//onfocusout :true,
	rules:{
		amount:{
			required: true,
			digits:true,
			min:{#$QISHI.payment_min#}
		},
		payment_name:{
			required: true
		}
	},
    messages: {
		amount: {
			required: "请输入充值金额",
			digits: "金额必须是整数",
			min: jQuery.format("单笔金额不能低于{0}元")
		},
		payment_name:{
			required: "请选择支付方式"
		}
	},
  errorPlacement: function(error, element) {
    if ( element.is(":radio") )
        error.appendTo( $("#pay_er"));
    else if ( element.is(":checkbox") )
        error.appendTo ( element.next());
    else
        error.appendTo(element.parent());
	}
    });
});
</script>
</head>

<body {#if $QISHI.body_bgimg#}style="background:url({#$QISHI.site_domain#}{#$QISHI.site_dir#}data/{#$QISHI.updir_images#}/{#$QISHI.body_bgimg#}) repeat-x center 38px;"{#/if#}>

<div class="page_location link_bk">当前位置：<a href="{#$QISHI.site_dir#}">首页</a> > <a href="{#$userindexurl#}">会员中心</a> > 充值订单</div>

<div class="usermain">
  <div class="leftmenu  com link_bk">
  	
  </div>
  <div class="rightmain">
  
 	<div class="bbox1 link_bk my_account intrgration" style="padding-top:0;">
		<div class="topnav">
			<div class="titleH1">
				<div class="h1-title">充值/订单</div>
			</div>

			<div class="navs">
        
        <a href="index.php?r=category/indent" class="se">积分充值</a>


        <a href="index.php?r=category/order_list">我的订单</a>
				<div class="clear"></div>
			</div>
		</div>


<div class="balance margin-common">
<?php foreach ($arr as $key => $value): ?>

    <div class="bal_text" style="margin-bottom:0;">您的账户剩余<span><?= $value['points']?></span>积分&nbsp;&nbsp;&nbsp;&nbsp;
<?php endforeach ?>
    <a target="_blank" href="company_service.php?act=j_account&detail=1">[积分明细]</a>&nbsp;&nbsp;<a target="_blank" href="company_service.php?act=j_account">[积分消费规则]</a></div>
</div>


  		<div class="bar">
  			<div class="bar_step1">
  				<p>填写订单</p>
  			</div>
  			<div class="bar_step2 hui">
  				<p>确认订单</p>
  			</div>
  			<div class="bar_step3 hui">
  				<p>提交订单</p>
  			</div>
  		</div>
  		<form id="Form1" name="Form1" method="post" action="?act=order_add_save"  >
  		<div class="intrgration_box margin-common">
  			<table>
<tbody>
	<tr>
		<td height="30" width="100">充值金额：</td>
		<td width="140"><input type="text" name="amount" id="amount" maxlength="8" class="input_text_200"/>&nbsp;元</td>
    <td> （单笔金额不能低于1元）&nbsp; 1元 = 1点积分</td>
	</tr>
	<tr id="count" style="display:none;">
		<td></td>
		<td colspan="2"><span id="show_val"></span></td>
	</tr>
</tbody>
  			</table>
  			<table>
  				<tbody>
              <td height="30" width="100">支付方式：</td>
            <?php foreach ($data as $key => $value): ?>
            <tr>
            <td></td>
              <td width="150"><input type="radio" name="payment_name" value="<?= $value['typename']?>" id="payment_name" />&nbsp;&nbsp;<img src="logo/<?= $value['typename']?>.gif" alt="" width="88" height="30"/></td>
              <td> <p>(<?= $value['p_introduction']?>)</p></td>
            </tr>
             <?php endforeach ?>
  				</tbody> 
  			</table>  
			<table>
				<tr>
					<td height="30" width="100">&nbsp;</td>
					<td width="150"><div id="pay_er"> </td> 
				</tr>
			</table> 
  			<input class="but130lan intrgration_but" type="submit" style="margin-top:0;" name="submit" value="充值"/>
  		</div>
  		</form>
  	</div>
  </div>
  <div class="clear"></div>
</div>
</div>
</body>
</html>