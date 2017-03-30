<div class="content">
<link rel="stylesheet" href="css/user_common.css" />
<link rel="stylesheet" href="css/user_company.css" />
<link rel="stylesheet" href="css/ui-dialog.css" />
<script src="js/jquery.js"></script>
<script src="js/dialog-min.js"></script>
<script src="js/dialog-min-common.js" type="text/javascript" language="javascript"></script>
<script>
	$(document).ready(function() {
		// 顶部筛选
		$('.data-filter').on('click', function(e){
			$(this).find('.filter-down').toggle();
			// 动态设置下拉列表宽度
			var fWidth = $(this).find('.filter-span').outerWidth(true) - 2;
			$(this).find(".filter-down").width(fWidth);
			// 点击其他位置收起下拉
			$(document).one("click",function(){
				$('.filter-down').hide();
			});
			e.stopPropagation();
			//点击下拉时收起其他下拉
			$(".data-filter").not($(this)).find('.filter-down').hide();
		});
		$('.name-link').on('click', function(){
			var order_id =  $(this).attr('order_id');
			var myDialog = dialog();
			jQuery.ajax({
			    url: "{#$QISHI.site_dir#}user/company/company_ajax.php?act=order_detail&order_id="+order_id,
			    success: function (data) {
			        myDialog.content(data);
			        myDialog.title('订单详情');
			        myDialog.width('400');
			    	myDialog.showModal();
			    	/* 关闭 */
			    	$(".DialogClose").live('click',function() {
			    		myDialog.close().remove();
			    	});
			    }
			});
		});
		// 删除弹出
		delete_dialog('.ctrl-del','#form1');
	});
</script>
</head>
<body {#if $QISHI.body_bgimg#}style="background:url({#$QISHI.site_domain#}{#$QISHI.site_dir#}data/{#$QISHI.updir_images#}/{#$QISHI.body_bgimg#}) repeat-x center 38px;"{#/if#}>

<div class="page_location link_bk">当前位置：<a href="{#$QISHI.site_dir#}">首页</a> > <a href="{#$userindexurl#}">会员中心</a> > 充值订单</div>
	<div class="usermain">
		<div class="leftmenu com link_bk">

		</div>
		<div class="rightmain">
			<div class="bbox1 my_account">
				<div class="topnav get_resume">
					<div class="titleH1"><div class="h1-title">充值/订单</div></div>
					<div class="navs link_bk">
						
						<a href="index.php?r=category/indent">积分充值</a>
						<a href="index.php?r=category/order_list" class="se">我的订单</a>
				    
						<div class="clear"></div>
					</div>
				</div>
<div class="company-data-list">
	<div class="c-data-top order-list clearfix">
		<div class="item f-left top-item1">订单号</div>
		<div class="item f-left top-item2">
			<div class="data-filter span4">
				<span class="filter-span">
				订单状态<i class="filter-icon"></i></span>
				<ul class="filter-down">
					<li><a href="company_service.php?act=order_list&pay_type={#$smarty.get.pay_type#}&is_paid=">全部</a></li>
					<li><a href="company_service.php?act=order_list&pay_type={#$smarty.get.pay_type#}&is_paid=2">已支付</a></li>
					<li><a href="company_service.php?act=order_list&pay_type={#$smarty.get.pay_type#}&is_paid=1">未完成</a></li>
				</ul>
			</div>
		</div>
						<div class="item f-left top-item3">
							<div class="data-filter span4">
								<span class="filter-span">广告介绍<i class="filter-icon"></i></span>
<ul class="filter-down">
	<li><a href="company_service.php?act=order_list&pay_type=0&is_paid={#$smarty.get.is_paid#}">全部订单</a></li>
	<li><a href="company_service.php?act=order_list&pay_type=1&is_paid={#$smarty.get.is_paid#}">套餐订单</a></li>
	<li><a href="company_service.php?act=order_list&pay_type=2&is_paid={#$smarty.get.is_paid#}">广告订单</a></li>
	<li><a href="company_service.php?act=order_list&pay_type=3&is_paid={#$smarty.get.is_paid#}">短信订单</a></li>
	<li><a href="company_service.php?act=order_list&pay_type=4&is_paid={#$smarty.get.is_paid#}">积分订单</a></li>
</ul>
							</div>
						</div>
						<div class="item f-left top-item4">金额</div>
						<div class="item f-left top-item5">操作</div>
					</div>
	<?php foreach ($order as $key => $value): ?>
<div class="c-data-row">
	<div class="c-data-content order-list clearfix">
		<div class="c-item f-left content1">
			<div><a href="javascript:;" order_id="{#$payment[payment].id#}" class="name-link underline"><?= $value['oid']?></a></div>
			<p>创建时间:<?=date('Y-m-d H:i:s', $value['addtime']); ?></p>
		</div>
		<div class="c-item f-left content2">
			<span class="order-not-done">
	<?php
	if ($value['is_paid'] == 1)
	{
		echo "未完成";
	}else{ 
		echo "<span style='color:#4CA51F'>";
		echo "已支付";
		echo "</span>";
	}
	?>

</span>
			
		</div>
		<div class="c-item f-left content3"><?= $value['notes']?></div>
		<div class="c-item f-left content4"><span class="order-money">￥<?= $value['amount']?></span></div>
		<div class="c-item f-left content5">

<?php
	if ($value['is_paid'] == 1)
	{
		echo '<a href="?act=payment&order_id={#$payment[payment].id#}" class="data-ctrl underline order-info">';
		echo '支付';
		echo"</a>&nbsp";
		echo '<a url="?act=order_del&id={#$payment[payment].id#}" href="javascript:;" class="data-ctrl underline ctrl-del">';
		echo '取消';
		echo '</a>';
	}else{
		echo '<span class="order-done">';
		echo '支付';
		echo '</span>&nbsp;<span class="order-done">';
		echo '取消';
		echo '</span>';
	}	
?>


		</div>
	</div>
</div>
<?php endforeach ?>
						<table border="0" align="center" cellpadding="0" cellspacing="0" class="link_bk">
							<tr>
								<td height="50" align="center"> <div class="page link_bk"></div></td>
							</tr>
						</table>
					
						<div class="emptytip">没有找到对应的订单信息！</div>
				
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	</div>
</body>
</html>