$(function(){
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
})