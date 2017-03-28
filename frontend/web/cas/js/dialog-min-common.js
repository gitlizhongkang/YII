/* ��js �з�����Ҫ���� dialog-min.js*/
/*
  delete_dialog  ɾ����ʾ������ 
  @ className  �����¼��� class �� .ctrl-del 
    ����ɾ�� ����url ���� ɾ������
    ����ɾ�� ����act ���� ���ύ��ַ
  @ form   ����ɾ���ύ����,��id #form1
*/
function delete_dialog(className,form)
{
   $(''+className+'').on('click', function(e)
   {
    var url=$(this).attr('url');
    var act=$(this).attr('act');
    var myDialog=dialog();
    myDialog.title('ϵͳ��ʾ');
    myDialog.content('<div class="del-dialog"><div class="tip-block"><span class="del-tips-text">ɾ�����޷��ָ�����ȷ��Ҫɾ����</span></div></div><div class="center-btn-wrap"><input type="button" value="ȷ��" class="btn-65-30blue btn-big-font DialogSubmit" /><input type="button" value="ȡ��" class="btn-65-30grey btn-big-font DialogClose" /></div>');
    myDialog.width('300');
    myDialog.showModal();
    /* �ر� */
    $(".DialogClose").live('click',function() {
      myDialog.close().remove();
    });
    // ȷ��
    $(".DialogSubmit").click(function() 
    {
      if(url)
      {
        window.location.href=url;
      }else{
        $(""+form+"").attr("action",act);
        $(""+form+"").submit();
      }
    });
  });
}
/*
  inviteJob_dialog �������뵯����
  @className  �����¼��� class ���� resume_id���� Ϊ���� id
  @url ����ajax ��php ��ַ
  @utype ��Ա����
*/
function inviteJob_dialog(className,url)
{
  $(''+className+'').live('click', function(){
    var id=$(this).attr("resume_id");
    var tsTimeStamp= new Date().getTime();
    var url_=url+"?id="+id+"&act=invited&t="+tsTimeStamp;
    var myDialog = dialog();
    myDialog.title('��������');
    myDialog.content("������...");
    myDialog.width('500');
    myDialog.showModal();
    jQuery.ajax({
        url: url_,
        success: function (data) {
            myDialog.content(data);
            /* �ر� */
            $(".DialogClose").live('click',function() {
              myDialog.close().remove();
            });
            /* ������� */
            $(".DialogSubmit").click(function() 
            {
              var jobsid= $("#jobsid").val();
              if(jobsid=="")
              {
                dialog({
                    title: 'ϵͳ��ʾ',
                    content: "δѡ��ְλ��",
                    width:300
                }).show();
              }
              var pms_notice=$("#pms_notice").attr("checked");
              if(pms_notice) pms_notice=1;else pms_notice=0;
              var sms_notice=$("#sms_notice").attr("checked");
              if(sms_notice) sms_notice=1;else sms_notice=0;
              var interview_time =$("#interview_time").val();
              var notes = $("#notes").val();
              if(interview_time=="")
              {
                dialog({
                    title: 'ϵͳ��ʾ',
                    content: "����ʱ�䲻��Ϊ�գ�",
                    width:300
                }).show();
              }

              var current_time = new Date();
              current_time.setHours(0);
              current_time.setMinutes(0);
              current_time.setSeconds(0);
              current_time.setMilliseconds(0);
              current_time = Date.parse(current_time);
              var in_time = Date.parse(new Date(interview_time.replace("-", "/").replace("-", "/")));
              if(in_time<current_time)
              {
                dialog({
                    title: 'ϵͳ��ʾ',
                    content: "����ʱ�䲻��С�ڵ�ǰʱ�䣡",
                    width:300
                }).show();
              }
              // ���� ����
              if(jobsid!="" && interview_time!="" && (in_time>=current_time))
              {
                myDialog.content("�����ύ...");
                $.get(url, {"jobs_id": jobsid,"id":id,"notes":notes,"pms_notice":pms_notice,"sms_notice":sms_notice,"interview_time":interview_time,"time":tsTimeStamp,"act":"invited_save"},
                function (rdata)
                {
                  myDialog.content(rdata);
                });
              }
            });
        }
    });
  });
}
/*
  companySendToEmail_dialog  ��ҵ��Ա���� �������͵�����
  @className  �����¼��� class ���� ���� resume_idΪ����id,uidΪ����uid
  @url �����ʼ�php��ַ
*/
function companySendToEmail_dialog(className,url)
{
  $(''+className+'').on('click', function(){
      var resume_id =$(this).attr("resume_id");
      var uid=$(this).attr('uid');
      var myDialog = dialog();
      myDialog.content('<div class="send-mail-dialog dialog-block"><div class="dialog-item clearfix"><div class="d-type f-left">�������䣺</div><div class="d-content f-left"><input type="text" class="edit-text" placeholder="ֻ������һ�������ַ" id="SendToEmail"/></div></div><div class="dialog-item clearfix"><div class="d-type f-left">&nbsp;</div><div class="d-content f-left"><input type="button" value="����" class="btn-65-30blue btn-big-font DialogSubmit" /><input type="button" value="ȡ��" class="btn-65-30grey btn-big-font DialogClose" /></div></div></div>');
      myDialog.title('���͵�����');
      myDialog.width('350');
      myDialog.showModal();
      $(".DialogClose").live('click',function() {
        myDialog.close().remove();
      });
      $(".DialogSubmit").click(function() 
      {
        var email= $("#SendToEmail").val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        isok= reg.test(email);
        if(isok)
        {
          myDialog.content("���ڷ�����..");  
          $.get(url+'?act=sendtoemail&uid='+uid+'&resume_id='+resume_id+'&email='+email+'', function(data) {
            if(data==1)
            {
              myDialog.content("�ü����Ѿ����͵��������䣡");
            }
            else
            {
              myDialog.content(data);
            }
          });
        }
        else
        {
          dialog({
                    title: 'ϵͳ��ʾ',
                    content: "��������ȷ�����䣡",
                    width:300
                }).show();
        }
      });
    })
}
/*
  ��ҵ�ƹ� ������
*/
function set_promotion_dialog(className)
{
  $(''+className+'').on('click', function(){
    var catid = $(this).attr("catid");
    var jobid = $(this).attr("jobid");
    var url="company_ajax.php?act=set_promotion&catid="+catid+"&jobid="+jobid;
    var myDialog = dialog();
    myDialog.title('ְλ�ƹ�');
    myDialog.content("������...");
    myDialog.width('490');
    myDialog.showModal();
    jQuery.ajax({
        url: url,
        success: function (data) {
            myDialog.content(data);
            /* �ر� */
            $(".DialogClose").live('click',function() {
              myDialog.close().remove();
            });
            /* ������� */
            $(".DialogSubmit").click(function() 
            {
              $(this).val("�ύ��..");
              $(this).attr("disabled","1");
              var jobid = $("#jobid").val();
              var catid = $("#catid").val();
              var days = $("#days").val();
              var pro_name = $("#pro_name").val();
              var val = $("#val").val();
              $.post("company_ajax.php?act=promotion_add_save",{jobid:jobid,catid:catid,days:days,val:val,pro_name:pro_name},
                function(result)
                {
                  myDialog.content(result);
                  setTimeout(function () {
                      myDialog.close().remove();
                       window.location.reload();
                  }, 2000);
                });
            });
        }
    });
  })
}
/*
  ��ҵ������ϵ��ʽ ������
*/
function downResume_dialog(className,url,resume_id)
{
  $(''+className+'').on('click', function(){
    var id=resume_id;
    var tsTimeStamp= new Date().getTime();
    var url_=url+"?id="+id+"&act=download&t="+tsTimeStamp;
    var myDialog = dialog();
    myDialog.title('������ϵ��ʽ');
    myDialog.content("������...");
    myDialog.width('475');
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
/* �ղؼ��� ����*/
function favoritesResume_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var myDialog = dialog();
    myDialog.title('�����˲ſ�');
    myDialog.content("������...");
    myDialog.width('500');
    myDialog.showModal();
    $.get(url, function(data){
        myDialog.content(data);
        /* �ر� */
        $(".DialogClose").live('click',function() {
          myDialog.close().remove();
        });
    });
  });
}
/* �ٱ����� ����*/
function reportResume_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var resume_id = $(this).attr("resume_id");
    var fullname = $(this).attr("fullname");
    var resume_addtime = $(this).attr("resume_addtime");
    var url_=url+"?act=report&resume_id="+resume_id+"&full_name="+fullname+"&resume_addtime="+resume_addtime;
    var myDialog = dialog();
    myDialog.title('�ٱ�����');
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
/*
  ��������ְλ 
*/
function applyJob_dialog(className,url,is_jobshow)
{
    if(!is_jobshow){is_jobshow=0;}
    $(''+className+'').on('click', function(){
      var jobs_id = $(this).attr("jobs_id");
      var url_=url+"?id="+jobs_id+"&act=app&is_jobshow="+is_jobshow;
      var myDialog = dialog();
      myDialog.title('����ְλ');
      myDialog.content("������...");
      myDialog.width('700');
      myDialog.showModal();
      $.get(url_, function(data){
          myDialog.content(data);
  // ����ѡ��
  $('.quick-drop').live('click', function(e) {
    $(this).find('.quick-drop-list').slideToggle('fast');
    $(this).toggleClass('has-drop');
    $(document).one('click', function() {
      $('.quick-drop-list').stop().slideUp('fast');
      $('.quick-drop').removeClass('has-drop');
    })
    e.stopPropagation();
    $(".quick-drop").not($(this)).removeClass('has-drop').find('.quick-drop-list').hide();
  });
  $('.quick-drop-list').on('click', function(e) {
    e.stopPropagation();
  })
  $('.quick-drop-list a').on('click', function() {
    $(this).parents('.quick-drop-list').prevUntil().find('span').css('color', '#666').text($(this).html());
    $(this).parents('.quick-drop-list').hide().prev('input').val($(this).attr('id'));
    $(this).parents('.quick-drop-list').hide().prev('input').attr('data', $(this).attr('title'));
    $('.quick-drop').removeClass('has-drop');
  })
  // ��������ѡ��
  allaround();
  // ���������������
  city_filldata("#city_list", QS_city_parent, QS_city, "#result-list-city", "#aui_outer_city", "#city_result_show", "#district", "{#$QISHI.site_dir#}");
  // ����ְλ�������
  job_filldata("#job_list", QS_jobs_parent, QS_jobs, "#result-list-job", "#aui_outer_job", "#job_result_show", "#intention_jobs_id", "{#$QISHI.site_dir#}");
  // ������ҵ�������
  trade_filldata("#trad_list", QS_trade, "#aui_outer", "#result-list-trade", "#trade_result_show", "#trade", "{#$QISHI.site_dir#}");
  // �Ա�
  $('input[name=sex]').on('change', function() {
    if ($(this).prop('checked')) {
      $(this).parent().addClass('check').siblings().removeClass('check');
    };
  });
  function updateP(num, time) {
    if(num == time) {
      $('#codeBtn').val('���·���').prop('disabled', false).removeClass('disabled');
    }else{
      var printnr = time - num;
      $('#codeBtn').val(printnr +"�����·���");
    }
  }
  function showTime(time){
    $('#codeBtn').prop('disabled', true).addClass('disabled');

    for (var i = 0; i <= time; i++) {
      window.setTimeout("updateP("+ i +","+time+")", i*1000);
    };
  };
          /* �ر� */
          $(".DialogClose").live('click',function() {
            myDialog.close().remove();
          });
      });
    });
}
/*
  ���� �ղ�ְλ  
*/
function favoritesJob_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var myDialog = dialog();
    $.get(url, function(data){
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
/*
  ���� �ٱ�ְλ 
*/
function reportJob_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var jobs_id = $(this).attr("jobs_id");
    var jobs_name = $(this).attr("jobs_name");
    var jobs_addtime = $(this).attr("jobs_addtime");
    var url_=url+'?act=report&jobs_id='+jobs_id+'&jobs_name='+jobs_name+'&jobs_addtime='+jobs_addtime;
    var myDialog = dialog();
    myDialog.title('�ٱ�ְλ');
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
/*
  ������֤ ������
*/
function auditEmail_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var myDialog = dialog();
    myDialog.title('������֤');
    myDialog.content("������...");
    myDialog.width('500');
    myDialog.showModal();
    $.get(url, function(data){
        myDialog.content(data);
        /* �ر� */
        $(".DialogClose").live('click',function() {
          myDialog.close().remove();
        });
    });
  });
}
// ��֤ �ֻ����� 
function auditMobile_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var myDialog = dialog();
    myDialog.title('�ֻ���֤');
    myDialog.content("������...");
    myDialog.width('500');
    myDialog.showModal();
    $.get(url, function(data){
        myDialog.content(data);
        /* �ر� */
        $(".DialogClose").live('click',function() {
          myDialog.close().remove();
        });

    });
  });
}
/* �޸��ֻ� ��֤��� */
function editMobile_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var myDialog = dialog();
    myDialog.title('��֤���');
    myDialog.content("������...");
    myDialog.width('500');
    myDialog.showModal();
    var ajax_url_ = url.split(".");
    var ajax_url =ajax_url_[0];
    $.get(url, function(data){
        myDialog.content(data);
        /* �ر� */
        $(".DialogClose").live('click',function() {
          myDialog.close().remove();
        });
        // ��֤����
        $("#postverify").live('click', function(){
          if($("#mobile_verifycode").val()=='')
          {
            dialog({
              title: 'ϵͳ��ʾ',
              content: '����дЧ����',
              width:'300px'
            }).showModal();
          }
          else
          {
            $.post("../../plus/ajax_verify_old_mobile.php", {"verifycode": $("#mobile_verifycode").val(),"send_key": $("#send_key").val(),"time":new Date().getTime(),"act":"verify_code"},
            function (data_v,textStatus)
            {
              if (data_v=="success")
              { 
                  myDialog.close().remove();
                  
                  var d = dialog();
                  d.title('�����֤');
                  d.content("������...");
                  d.width('500');
                  d.showModal();
                  $.get(ajax_url+'.php?act=edit_mobile', function(rst){
                  d.content(rst);
                });
              }
              else
              {
                dialog({
                title: 'ϵͳ��ʾ',
                content: '��֤����д����',
                width:'300px'
                }).showModal();
              }
            })   
          }
        });
    });
  });
}
// ��Ƹ�� ����Ԥ�� ����
function boothjobfair_dialog(className,url,id)
{
  $(''+className+'').on('click', function(){
    if(!id)
    {
      var jobfair_id = $(this).attr("jobfair_id");
      var url_=url+'?act=booth&id='+jobfair_id;
    }
    else
    {
      var url_=url+'?act=booth&id='+id;
    }
    var myDialog = dialog();
    $.get(url_, function(data){
        myDialog.content(data);
        myDialog.title('��ܰ��ʾ');
        myDialog.width('400');
        myDialog.showModal();
        /* �ر� */
        $(".DialogClose").live('click',function() {
          myDialog.close().remove();
        });
    });
  });
}
// ��Ƹ�� ��ͼ��λ ����
function jobfairmap_dialog(className,url)
{
  $(''+className+'').on('click', function(){
    var map_x = $(this).attr("map_x");
    var map_y = $(this).attr("map_y"); 
    var map_zoom = $(this).attr("map_zoom"); 
    var title = $(this).attr("title_"); 
    var address = $(this).attr("address"); 
    var url_=url+"&map_x="+map_x+"&map_y="+map_y+"&map_zoom="+map_zoom+"&companyname="+title+"&address="+address;
    var myDialog = dialog();
    $.get(url_, function(data){
        myDialog.content(data);
        myDialog.title('��ͼ��λ');
        myDialog.width('660');
        myDialog.showModal();
        /* �ر� */
        $(".ui-dialog-close").live('click',function() {
          myDialog.close().remove();
          window.location.reload();
        });
    });
  });
}