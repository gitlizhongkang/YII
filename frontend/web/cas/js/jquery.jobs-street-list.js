function jobslist()
{
	var key=$('#key').val();
	if (key)
	{
		key_arr=key.split(" ");
		for (x in key_arr)
		{
		if (key_arr[x]) $('.striking').highlight(key_arr[x]);
		}
	}
	// $(".list:odd").css("background-color","#F4F5FB");
	$(".titsub").hover(	function()	{$(this).addClass("titsub_h");},function(){$(this).removeClass("titsub_h");});
	function setlistbg()
	{
			$(".li_left_check input[type='checkbox']").each(function(i){
				if ($(this).attr("checked"))
				{
					$(this).parent().parent().addClass("seclect");
				}
				else
				{
					$(this).parent().parent().removeClass("seclect");
				}
			}); 
	 }
 	//ȫѡ��ѡ
	$("input[name='selectall']").unbind().click(function(){$("#infolists :checkbox").attr('checked',$(this).is(':checked'))});
	//���ѡ������¼���ʽ
	$("#formjobslist input[type='checkbox']").click(function(){setlistbg();});
	//����
	$(function(){
	var _wrap=$('#jobs_list_tip ul');
	var _interval=3000;
	var _moving;
	_wrap.hover(function(){
	clearInterval(_moving);
	},function(){
	_moving=setInterval(function(){
	var _field=_wrap.find('li:first');
	var _h=_field.height();
	_field.animate({marginTop:-_h+'px'},300,function(){
	_field.css('marginTop',0).appendTo(_wrap);
	})
	},_interval)
	}).trigger('mouseleave');
	});
}
// ����ְλ
function apply_jobs(ajaxurl)
{
	$(".deliver").click(function()
	{
		var sltlength='';
		sltlength=$("#infolists .list input:checked").length;
		if (sltlength==0)
		{
			var myDialog = dialog();
			myDialog.content("��ѡ��ְλ");
	        myDialog.title('ϵͳ��ʾ');
	        myDialog.width('300');
	        myDialog.showModal();
		}
		else
		{
			var jidArr=new Array();
			$("#infolists .list :checkbox[checked]").each(function(index){jidArr[index]=$(this).val();});
			var url_=ajaxurl+"user/user_apply_jobs.php?id="+jidArr.join("-")+"&act=app";
			var myDialog = dialog();
			myDialog.title('����ְλ');
			myDialog.content("������...");
			myDialog.width('500');
			myDialog.showModal();
			$.get(url_, function(data){
				myDialog.content(data);
				/* �ر� */
				$(".DialogClose").live('click',function() {
					myDialog.close().remove();
				});
			});
		}
	});
	//��������ְλ
	$(".app_jobs").unbind().click(function(){
		var url_=ajaxurl+"user/user_apply_jobs.php?id="+$(this).attr("jobs_id")+"&act=app";
		var myDialog = dialog();
		myDialog.title('����ְλ');
		myDialog.content("������...");
		myDialog.width('500');
		myDialog.showModal();
		$.get(url_, function(data){
			myDialog.content(data);
			/* �ر� */
			$(".DialogClose").live('click',function() {
				myDialog.close().remove();
			});
		});
	});
}
// �ղ�ְλ
function favorites(ajaxurl)
{	
	$(".collecter").click(function()
	{
		var sltlength='';
		sltlength=$("#infolists .list input:checked").length;
		if (sltlength==0)
		{
			var myDialog = dialog();
			myDialog.content("��ѡ��ְλ");
	        myDialog.title('ϵͳ��ʾ');
	        myDialog.width('300');
	        myDialog.showModal();
		}
		else
		{
			var jidArr=new Array();
			$("#infolists .list :checkbox[checked]").each(function(index){jidArr[index]=$(this).val();});
			var myDialog = dialog();
			var url_=ajaxurl+"user/user_favorites_job.php?id="+jidArr.join("-")+"&act=add";
		    $.get(url_, function(data){
		        myDialog.content(data);
		        myDialog.title('�����ղ�');
		        myDialog.width('500');
		        myDialog.showModal();
		        /* �ر� */
		        $(".DialogClose").live('click',function() {
		          myDialog.close().remove();
		        });
		    });
		}
	});
	// �����ղ�ְλ
	$(".add_favorites").unbind().click(function(){
		var myDialog = dialog();
		var url_=ajaxurl+"user/user_favorites_job.php?id="+$(this).attr("jobs_id")+"&act=add";
	    $.get(url_, function(data){
	        myDialog.content(data);
	        myDialog.title('�����ղ�');
	        myDialog.width('500');
	        myDialog.showModal();
	        /* �ر� */
	        $(".DialogClose").live('click',function() {
	          myDialog.close().remove();
	        });
	    });
	});
}
// һЩjs�ļ���
function allaround(dir) {
	// �����ĸ
	var letterArray = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"],
		letterHtm = '';
	$.each(letterArray, function(index, val) {
		letterHtm += '<a class="st" href="javascript:;" code="'+val+'">'+val+'</a>';
	});
	$("#street_letter").html(letterHtm);
	// �����ĸ����
	$("#street_letter a").die().live('click', function(event) {
		$("#key").val('');
		$("#street_letter a").removeClass("select");
		$(this).addClass("select");
		var x = $(this).attr('code');
		$.get(dir+"plus/ajax_street.php", {"act":"alphabet","x":x},
			function (data,textStatus)
			{	
				$("#show_street").html(data);
			}
		);	
	});
	// �ؼ��ּ���
	$("#sosub").die().live('click', function() {
		var str=$("#key").val();
		if (str!='') {
			$("#street_letter a").removeClass("select");
			$.get(dir+"plus/ajax_street.php", {"act":"key","key":str},
				function (data,textStatus)
				{	
					$("#show_street").html(data);
				}
			);
		} else {
			alert("����������ؼ���");
			$("#key").focus();
		}
	});
	// ѡ����
	$(".fl-content-li").die().live('click',function() {
		var type = $(this).attr('type'),
			code = $(this).attr('code');
		if ($(this).hasClass('select')) {
			$(this).removeClass('select');
			$("#"+type).val('');
		} else {
			$(this).addClass('select').siblings('.fl-content-li').removeClass('select');
			$("#"+type).val(code);
		}
		search_location(dir);
	});
}
// ������ת
function search_location(dir) {
	generateBackground();
	var listype = $("#searcnbtn").attr('detype');
	var sort=$("input[name=sort]").val();
	var page=$("input[name=page]").val();
	var streetid=$("input[name=streetid]").val();
	var inforow=$("input[name=inforow]").val();
	$.get(dir+"plus/ajax_search_location.php", {"act":listype,"sort":sort,"page":page,"streetid":streetid,"inforow":inforow},
		function (data,textStatus)
		 {	
			 window.location.href=data;
		 },"text"
	);
}
// ���ڼ���
function generateBackground() {
	var backgroundHtm = '<div id="bonfire-pageloader"><div class="bonfire-pageloader-icon"></div></div>';
	var html = jQuery('html');
	html.append(backgroundHtm);
	jQuery(window).resize(function(){
		 resizenow();
	});
	function resizenow() {
		var browserwidth = jQuery(window).width();
		var browserheight = jQuery(window).height();
		jQuery('.bonfire-pageloader-icon').css('right', ((browserwidth - jQuery(".bonfire-pageloader-icon").width())/2)).css('top', ((browserheight - jQuery(".bonfire-pageloader-icon").height())/2));
	};
	resizenow();
}