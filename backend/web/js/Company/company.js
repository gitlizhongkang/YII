$(function(){
    $("#fail").click(function(){
        $("#reason").show();
    });
    $("#wait").click(function(){
        $("#reason").hide();
    });
    $("#success").click(function(){
        $("#reason").hide();
    });
    //全选
    $("#chk").click(function() {
        if($(this).is(":checked")){
            $("#form1 :checkbox").prop('checked',true);
            $(this).parent("label").css("color","#009900");
        }else{
            $("#form1 :checkbox").prop('checked',false);
            $(this).parent("label").css("color","#990000");
        }
    })
    //认证企业 刷新 删除
    $("#ButAudit,#ButDel").mouseover(function(){
        $(this).css("background-color","gold");
    })
    $("#ButAudit,#ButDel").mouseout(function(){
        $(this).css("background-color","");
    })
    $("#ButAudit,#ButDel").click(function(){
        if($("#form1 :checkbox").is(":checked")==false){
           alert("请先选择");
        }else{
            var oc="#"+$(this).attr("oc");
            $("#mask").css("height",$(document).height());
            $("#mask").css("width",$(document).width());
            $("#mask").show();
            var width=420+"px";
            var height="auto"+"px";
            $(oc).css({display:"block",left:(($(document).width())/2-(parseInt(width)/2))+"px",top:($(document).scrollTop()+120)+"px",width:width,height:height,opacity:1,position: "absolute"});
            $(oc).show().css("z-index" ,"100");
        }
    })
    //取消遮罩层
    $("input[type=reset]").click(function(){
        $("#mask").hide();
        var name="#"+$(this).attr("name");
        $(name).hide();
    })
    //认证企业
    $("input[name=set_audit]").click(function(){
       var reason="";
        var ids=0;
       for(var i=0;i<$("input[id=y_id]").length;i++){
           if($("input[id=y_id]").eq(i).is(":checked")==true){
              ids++;
           }
       }
      if(ids>1){
           alert("请选择一个即可");
           return;
      }
      var id=$("input[id=y_id]:checked").val();
      var audit=$("input[name=audit]:checked").val();
      if(audit==3){
          reason=$("textarea[name=reason]").val();
      }
     location.href=url+"&id="+id+"&audit="+audit+"&reason="+reason;
    })
    //删除功能
    $("input[name=delete]").click(function(){
        var ids="";
        for(var i=0;i<$("input[id=y_id]").length;i++){
            if($("input[id=y_id]").eq(i).is(":checked")==true){
                ids+=","+$("input[id=y_id]").eq(i).val();
            }
        };
        ids=ids.substr(1);
         location.href=del_url+"&id="+ids;
    })
})