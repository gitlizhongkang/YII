//ȫѡ��ѡ
$("input[name='selectall']").die().live('click',function(){$("#infolists :checkbox").attr('checked',$(this).is(':checked'))});
// ����ְλ
function apply_jobs(ajaxurl)
{
	$(".deliver").click(function()
	{
		var sltlength='';
		sltlength=$("#infolists .info-list-wrap input:checked").length;
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
			$("#infolists .info-list-wrap :checkbox[checked]").each(function(index){jidArr[index]=$(this).val();});
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
		sltlength=$("#infolists .info-list-wrap input:checked").length;
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
			$("#infolists .info-list-wrap :checkbox[checked]").each(function(index){jidArr[index]=$(this).val();});
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