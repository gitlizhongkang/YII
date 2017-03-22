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
    //添加  删除
    $("#ButAdd,#ButDel").mouseover(function(){
        $(this).css("background-color","gold");
    })
    $("#ButAdd,#ButDel").mouseout(function(){
        $(this).css("background-color","");
    })
    $("#ButAdd,#ButDel").click(function(){
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
    //删除功能
    $("input[name=delete]").click(function(){
        var ids="";
        var del_jobs="";
        var del_company="";
        for(var i=0;i<$("input[id=y_id]").length;i++){
            if($("input[id=y_id]").eq(i).is(":checked")==true){
                ids+=","+$("input[id=y_id]").eq(i).val();
            }
        };
        ids=ids.substr(1);
        if($("#delete_company").is(":checked")==true){
            del_company=1;
        }
        if($("#delete_jobs").is(":checked")==true){
            del_jobs=1;
        }
        location.href=del_url+"&id="+ids+"&del_company="+del_company+"&del_jobs="+del_jobs;
    })
})