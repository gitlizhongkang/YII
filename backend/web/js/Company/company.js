$(function(){
    var last_href= $(".pagination a").attr("href");
    var audit="";
    var time="";
    for(var i=0;i<$(".addtime a").length;i++){
        if($(".addtime a").eq(i).attr("class")=="select"){
            time=$(".addtime a").eq(i).attr("time");
            $(".pagination a").attr("href",last_href+"&audit="+audit+"&time="+time);
        }
    }
    for(var i=0;i<$(".audit a").length;i++){
        if($(".audit a").eq(i).attr("class")=="select"){
            audit=$(".addtime a").eq(i).attr("time");
            $(".pagination a").attr("href",last_href+"&audit="+audit+"&time="+time);
        }
    }
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
    $("#ButAudit,#Butrefresh,#ButDel").mouseover(function(){
        $(this).css("background-color","gold");
    })
    $("#ButAudit,#Butrefresh,#ButDel").mouseout(function(){
        $(this).css("background-color","");
    })
    $("#ButAudit,#Butrefresh,#ButDel").click(function(){
        if($("#form1 :checkbox").is(":checked")==false){
           alert("请先选择企业");
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
       var ids=0;
       var reason="";
       for(var i=0;i<$("input[id=y_id]").length;i++){
           if($("input[id=y_id]").eq(i).is(":checked")==true){
              ids++;
           }
       }
      if(ids>1){
           alert("请选择一个企业即可");
           return;
      }
      var id=$("input[id=y_id]:checked").val();
      var audit=$("input[name=audit]:checked").val();
      if(audit==3){
          reason=$("textarea[name=reason]").val();
      }
      $.ajax({
          type:"get",
          url:url,
          data:{
              id:id,
              audit:audit,
              reason:reason,
          },
          success:function(msg){
             if(msg==1){
                alert("操作成功");
             }else{
                 alert("操作失败");
             }
          }
      })

    })
})