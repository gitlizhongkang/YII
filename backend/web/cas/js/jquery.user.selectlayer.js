//ְλ������ѡ�񵯳��㺯��(�����ڴ�������ҳ��)
function OpenCategoryLayer(click_obj,showid,input,input_cn,input_txt,QSarr,strlen)
{
	$(click_obj).click(function()
	{
			$(this).blur();
			$(this).parent("div").before("<div class=\"menu_bg_layer\"></div>");
			$(".menu_bg_layer").height($(document).height());
			$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute",left:"0", top:"0","z-index":"0","background-color":"#000000"});
			$(".menu_bg_layer").css("opacity",0);
			$(showid+" .OpenFloatBoxBg").css("opacity", 0.2);
			$(showid).show();			
			$(showid+" .OpenFloatBox").css({"left":($(document).width()-$(showid+" .OpenFloatBox").width())/2,"top":"120"});
			SetBoxBg(showid);
			$(showid+" .item").unbind("hover").hover(
				function(){
				$(this).find(".titem").addClass("titemhover");				
				var strclass=QSarr[$(this).attr("id")];
				var pid=$(this).attr("id");
				if (strclass)
				{
					//�������������ѡ�񶥼�����
					$(this).find(".titem :checkbox").attr({'checked':false,"disabled":"disabled"});
					//
					$(this).find(".sitem").css("display","block");
					if ($(this).find(".sitem").html()=="")
					{
					$(this).find(".sitem").html(MakeLi(strclass,pid));//����LI
					}
					$(showid+" .OpenFloatBox label").unbind().click(function()
					{
						if ($(this).attr("title"))
						{
							if ($(this).find(":checkbox").attr('checked'))
							{
							$(this).next().find(":checkbox").attr('checked',true);
							}
						}
						else
						{
							if ($(this).parent().find(":checkbox[checked]").length>0)
							{
								$(this).parent().prev().find(":checkbox").attr('checked',false);
							}
						}
						CopyItem(showid);
					});
				}
				//
				$(showid+" .OpenFloatBox label").unbind().click(function()
					{
						if ($(this).attr("title"))
						{
							if ($(this).find(":checkbox").attr('checked'))
							{
							$(this).next().find(":checkbox").attr('checked',true);
							}
						}
						else
						{
							if ($(this).parent().find(":checkbox[checked]").length>0)
							{
								$(this).parent().prev().find(":checkbox").attr('checked',false);
							}
						}
						CopyItem(showid);
					});
				//
				},
				function(){
				$(this).find(".titem").removeClass("titemhover");
				$(this).find(".sitem").css("display","none");
				}
			);
			$(showid+" .OpenFloatBox .DialogClose").unbind().hover(function(){$(this).addClass("spanhover")},function(){$(this).removeClass("spanhover")});
			$(showid+" .DialogClose").click(function(){DialogClose(showid);});
			//ȷ��ѡ��
			$(showid+" .Set").unbind().click(function()
			{
					SetInput(showid,input_cn,input,strlen);
			});	
			//�ر�
			function DialogClose(showid)
			{
				$(".menu_bg_layer").hide();
				$(showid).hide();
			}
			//���ñ�
			function SetInput(showid,input_cn,input,strlen)
			{
					var a_cn=new Array();
					var a_id=new Array();
					var i=0;
					if ($(showid+" .OpenFloatBox .selecteditem :checkbox[checked]").length>8)
					{
						alert("���ܳ���8��ѡ��");
						return false;
					}
					$(showid+" .OpenFloatBox .selecteditem :checkbox[checked]").each(function(index)
					{
					    a_cn[index]=$(this).attr("title");	
						if ($(this).attr("class")=="b")
						{
								a_id[i]=$(this).val()+".0";							
						}
						else
						{							
							a_id[i]=$(this).attr("id")+"."+$(this).val();
						}
							i++;
					});
					$(input_cn).val(a_cn.join(","));
					$(input_txt).html(a_cn.join(","));
					$(input).val(a_id.join("-"));
					DialogClose(showid);
					 //��֤���е�һ����Ҫ��֤�ı�Ԫ�ء� 
					$("#Form1").validate().element("#intention_jobs");
			}
		
	});	
}
//������Ӱ
function SetBoxBg(showid)
{
				var FloatBoxWidth=$(showid+" .OpenFloatBox").width();
				var FloatBoxHeight=$(showid+" .OpenFloatBox").height();
				var FloatBoxLeft=$(showid+" .OpenFloatBox").offset().left;
				var FloatBoxTop=$(showid+" .OpenFloatBox").offset().top;
				$(showid+" .OpenFloatBoxBg").css({display:"block",width:(FloatBoxWidth+12)+"px",height:(FloatBoxHeight+12)+"px"});
				$(showid+" .OpenFloatBoxBg").css({left:(FloatBoxLeft-5)+"px",top:(FloatBoxTop-5)+"px"});
}
//����С��
function MakeLi(val,pid)
{
			if (val=="")return false;
			arr=val.split("|");
			var htmlstr='';
				for (x in arr)
				{
				 var v=arr[x].split(",");
				htmlstr+="<label><input type=\"checkbox\" value=\""+v[0]+"\" title=\""+v[1]+"\" class=\"s\" id=\""+pid+"\"/>"+v[1]+"</label><br/>";
				}
			return htmlstr; 
}
//����
function CopyItem(showid)
{
					var htmlstr='&nbsp;&nbsp;&nbsp;�Ѿ�ѡ����ࣺ<span class=\"empty\">[�����ѡ]</span><br/>';
					$(showid+" .item :checkbox[checked][class='b']").each(function(index){
					htmlstr+="<label><input class=\"b\"  type=\"checkbox\" value=\""+$(this).attr("value")+"\" title=\""+$(this).attr("title")+"\" checked/>"+$(this).attr("title")+"</label>";
					})
					$(showid+" .item :checkbox[checked][class='s']").each(function(index){
					 if ($(this).parent().parent().prev().find(":checkbox").attr('checked')==false)
					 {						 
					htmlstr+="<label><input class=\"s\"  type=\"checkbox\" id=\""+$(this).attr("id")+"\" value=\""+$(this).attr("value")+"\" title=\""+$(this).attr("title")+"\" checked/>"+$(this).attr("title")+"</label>";
					 }
					})
					htmlstr+="<div class=\"clear\"></div>";
					$(showid+" .selecteditem").html(htmlstr);
					if ($(showid+" .item :checkbox[checked]").length>0)
					{
						$(showid+" .selecteditem").css("display","block");
					}
					else
					{
						$(showid+" .selecteditem").css("display","none");
					}
					//��ѡ��Ŀ��click
					$(showid+" .selecteditem :checkbox").unbind().click(function()
					{
						var selval=$(this).val();
							$(showid+" .item :checkbox[checked]").each(function()
							{
								if ($(this).val()==selval)
								{
									$(this).attr("checked",false);
									if ($(this).attr("class")=="b")
									{
										$(this).parent().next().find(":checkbox").attr("checked",false);
									}									
									//���¿�¡
									CopyItem(showid);
								}	
							})
					});
					$(showid+" .OpenFloatBox .item label :checkbox").parent().css("color","");
					$(showid+" .OpenFloatBox .item label :checkbox[checked]").parent().css("color","#FF6600");
					$(showid+" .OpenFloatBox .sitem :checkbox[checked]").each(function(index){
					 	$(this).parent().parent().prev().css("color","#FF6600");
					});
					SetBoxBg(showid);
					//���
					$(showid+" .selecteditem .empty").unbind().click(function()
					{
							$(showid+" .selecteditem").css("display","none");
							$(showid+" .selecteditem").html("");
							$(showid+" :checkbox[checked]").parent().css("color","");
							$(showid+" :checkbox[checked]").parent().parent().prev().css("color","");
							$(showid+" :checkbox[checked]").attr('checked',false);							
							SetBoxBg(showid);
					});	
}
//��ȡ�ַ�
function limit(objString,num)
{
	if (num==0)
	{
		return objString;
	}
	var objLength =objString.length;
	if(objLength > num){ 
	return objString.substring(0,num) + "...";
	} 
	return objString;
}
//ģ��select
function showmenu(menuID,showID,inputname,Form,Forminput)
{
	$(menuID).click(function(){
		$(menuID).blur();
		$(menuID).parent("div").css("position","relative");
		$(showID).slideToggle("fast");
		//���ɱ���
		$(menuID).parent("div").before("<div class=\"menu_bg_layer\"></div>");
		$(".menu_bg_layer").height($(document).height());
		$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0", "background-color": "#ffffff"});
		$(".menu_bg_layer").css("opacity","0");
		//���ɱ�������
		$(showID+" li").live("click",function(){
			$(menuID).val($(this).attr("title"));
			$(inputname).val($(this).attr("id"));
			$(".menu_bg_layer").hide();
			$(showID).hide();
			$(menuID).parent("div").css("position","");	
			$(this).css("background-color","");			
					if (Form && Forminput)
					{
					$(Form).validate().element(Forminput);
					}
		});

				$(".menu_bg_layer").click(function(){
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(menuID).parent("div").css("position","");
				});
		$(showID+" li").unbind("hover").hover(
		function()
		{
		$(this).css("background-color","#DAECF5");
		},
		function()
		{
		$(this).css("background-color","");

		}
		);
	});
}
//����ҵ(�˺������޴���������д������ҵ)
function OpentradeLayer(click_obj,input,input_cn,input_txt,showid,strlen)
{
	$(click_obj).click(function()
	{
			$(this).blur();
			$(this).parent("div").before("<div class=\"menu_bg_layer\"></div>");
			$(".menu_bg_layer").height($(document).height());
			$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute",left:"0", top:"0","z-index":"0","background-color":"#000000"});
			//$(".menu_bg_layer").css("opacity",10);
			$(showid+" .OpenFloatBoxBg").css("opacity", 0.2);
			$(showid).show();	
			// $(showid+" .OpenFloatBox").css({"left":($(document).width()-$(showid+" .OpenFloatBox").width())/2,"top":"150"});
			SetBoxBg(showid);
			$(showid+"  label").hover(function()	{$(this).css("background-color","#E3F0FF");},function(){	$(this).css("background-color","");});
				$(showid+"  label").unbind().click(function(){
						if ($(showid+" .content :checkbox[checked]").length>5)
						{
							alert("���ܳ���5��ѡ��");
							$(this).attr("checked",false);
							return false;
						}
						else
						{
						$(showid+"  :checkbox").parent().css("color","");
						$(showid+"  :checkbox[checked]").parent().css("color","#009900");
						}
						
				});
		
	});
	//ȷ��ѡ��
	$(showid+" .Set").click(function()
	{
			var a_cn=new Array();
			var a_id=new Array();
			$(showid+" :checkbox[checked]").each(function(index){
			a_cn[index]=$(this).attr("title");
			a_id[index]=$(this).attr("value");
			});
			$(input_cn).val(limit(a_cn.join(","),strlen));
			$(input_txt).html(limit(a_cn.join("+"),strlen));
			if ($(input_cn).val()=="")$(input_cn).val("");
			$(input).val(a_id.join(","));
			 DialogClose(showid);
			 //��֤���е�һ����Ҫ��֤�ı�Ԫ��
			 $("#Form1").validate().element(input_cn); 
	});
	//������Ӱ
	function SetBoxBg(showid)
	{
				var FloatBoxWidth=$(showid+" .OpenFloatBox").width();
				var FloatBoxHeight=$(showid+" .OpenFloatBox").height();
				var FloatBoxLeft=$(showid+" .OpenFloatBox").offset().left;
				var FloatBoxTop=$(showid+" .OpenFloatBox").offset().top;
				$(showid+" .OpenFloatBoxBg").css({display:"block",width:(FloatBoxWidth+12)+"px",height:(FloatBoxHeight+12)+"px"});
				$(showid+" .OpenFloatBoxBg").css({left:(FloatBoxLeft-5)+"px",top:(FloatBoxTop-5)+"px"});
	}
	//�ر�
	$(showid+" .OpenFloatBox .DialogClose").hover(function(){$(this).addClass("spanhover")},function(){$(this).removeClass("spanhover")});
	$(showid+" .DialogClose").click(function(){DialogClose(showid);});
	function DialogClose(showid)
	{
		$(".menu_bg_layer").hide();
		$(showid).hide();
	}
	
}
function showtaglayer(menuID,showID,inputname,inputname1,strlen,get)
{
	if (get)
	{
		arr=get.split("|");
		tcn=new Array();
		for(var i=0;i<arr.length;i++)
		{
			 var tid=arr[i].split(",");
			$(showID+" :checkbox[id="+tid[0]+"]").attr("checked",true);
			tcn[i]=tid[1];
		}
		$(inputname).val(limit(tcn.join(","),strlen));
		$(showID+"  :checkbox").parent().css("color","");
		$(showID+"  :checkbox[checked]").parent().css("color","#FF3300");
	}
	$(menuID).click(function(){
		$(menuID).blur();
		$(menuID).parent("div").css("position","relative");
		$(showID).slideToggle("fast");
		//���ɱ���
		$(menuID).parent("div").before("<div class=\"menu_bg_layer\"></div>");
		$(".menu_bg_layer").height($(document).height());
		$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0"});
		$(showID+"  label").unbind().click(function(){
						if ($(showID+" :checkbox[checked]").length>5)
						{
							alert("���ܳ���5��ѡ��");
							$(this).attr("checked",false);
							return false;
						}
						else
						{
						$(showID+"  :checkbox").parent().css("color","");
						$(showID+"  :checkbox[checked]").parent().css("color","#FF3300");
						}
		});
		//ȷ��ѡ��
		$(showID+" .Set").click(function()
		{
				var a_cn=new Array();
				var a_id=new Array();
				$(showID+" :checkbox[checked]").each(function(i){
				a_cn[i]=$(this).attr("title");
				a_id[i]=$(this).attr("value");
				});
				$(inputname).val(limit(a_cn.join(","),strlen));
				$(inputname1).val(limit(a_id.join("|"),0));
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(menuID).parent("div").css("position","");
		});			
		$(".menu_bg_layer").click(function(){
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(menuID).parent("div").css("position","");
				});
	});
}
function showtaglayer_new(menuID,showID,inputname,inputname1,strlen,get)
{
	if (get)
	{
		arr=get.split("|");
		tcn=new Array();
		for(var i=0;i<arr.length;i++)
		{
			 var tid=arr[i].split(",");
			$(showID+" :checkbox[id="+tid[0]+"]").attr("checked",true);
			tcn[i]=tid[1];
		}
		$(inputname).val(limit(tcn.join(","),strlen));
		$(showID+"  :checkbox").parent().css("color","");
		$(showID+"  :checkbox[checked]").parent().css("color","#FF3300");
	}
	$(menuID).click(function(){
		$(menuID).blur();
		$(menuID).parent("div").css("position","relative");
		$(showID).slideToggle("fast");
		//���ɱ���
		$(menuID).parent("div").before("<div class=\"menu_bg_layer\"></div>");
		$(".menu_bg_layer").height($(document).height());
		$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0"});
		$(showID+"  label").unbind().click(function(){
						// if ($(showID+" :checkbox[checked]").length>5)
						// {
						// 	alert("���ܳ���5��ѡ��");
						// 	$(this).attr("checked",false);
						// 	return false;
						// }
						// else
						// {
						$(showID+"  :checkbox").parent().css("color","");
						$(showID+"  :checkbox[checked]").parent().css("color","#FF3300");
						// }
		});
		//ȷ��ѡ��
		$(showID+" .Set").click(function()
		{
				var a_cn=new Array();
				var a_id=new Array();
				$(showID+" :checkbox[checked]").each(function(i){
				a_cn[i]=$(this).attr("title");
				a_id[i]=$(this).attr("value");
				});
				$(inputname).val(limit(a_cn.join(","),strlen));
				$(inputname1).val(limit(a_id.join("|"),0));
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(menuID).parent("div").css("position","");
		});			
		$(".menu_bg_layer").click(function(){
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(menuID).parent("div").css("position","");
				});
	});
}
//���б�(��ѡ)
function showmenulayer(menuID,showID,inputname,inputname1,arr)
{
	$(menuID).click(function(){
		$(menuID).blur();
		$(menuID).parent("div").css("position","relative");
		$(showID).slideToggle("fast");
		//���ɱ���
		$(menuID).parent("div").before("<div class=\"menu_bg_layer\"></div>");
		$(".menu_bg_layer").height($(document).height());
		$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0"});
		//���ɱ�������
		$(showID+">ul>li").click(function(){
			$(menuID).val($(this).attr("title"));
			$(inputname).val($(this).attr("id"));
			var strclass=arr[$(this).attr("id")];
			if (strclass)//�������С��
			{
				$(showID).hide();
				$(showID+"_s").show();
				var	go_back="<span class=\"go_back\">[�����ϲ����>>]</span>";
				$(showID+"_s").html(go_back+getcathtml(strclass));//����LI
				
					$(showID+"_s>ul>li").click(function(){//���С��	
						$(menuID).val($(menuID).val()+"/"+$(this).attr("title"));
						$(inputname1).val($(this).attr("id"));
						$(".menu_bg_layer").hide();	
						$(showID).hide();
						$(showID+"_s").hide();
						$(menuID).parent("div").css("position","");	
						$(this).css("background-color","");
					});
					$(".go_back").click(function(){//�����ϲ����
					$(showID).show();
					$(showID+"_s").hide();
					});
					$(".dmenu>ul>li").hover(
						function()
						{
						$(this).css("background-color","#DAECF5");
						},
						function()
						{
						$(this).css("background-color","");
						}
						);
				}
			else
			{
			$(menuID).val($(this).attr("title"));
			$(inputname).val($(this).attr("id"));
			$(".menu_bg_layer").hide();
			$(showID).hide();
			$(menuID).parent("div").css("position","");	
			$(this).css("background-color","");
			}
			$("#Form1").validate().element(inputname); //��֤���е�һ����Ҫ��֤�ı�Ԫ�ء� 			
		});

				$(".menu_bg_layer").click(function(){
					$(".menu_bg_layer").hide();
					$(showID).hide();
					$(showID+"_s").hide();
					$(menuID).parent("div").css("position","");
				});
		$(".dmenu>ul>li").hover(
		function()
		{
		$(this).css("background-color","#DAECF5");
		},
		function()
		{
		$(this).css("background-color","");
		}
		);
	});
}
function getcathtml(val)
{
	if (val=="")return false;
    arrcity=val.split("|");
	var htmlstr='<ul>';
	for(var i=0;i<arrcity.length;i++)
		{
			 var city=arrcity[i].split(",");
	htmlstr+="<li id=\""+city[0]+"\" title=\""+city[1]+"\">"+city[1]+"</li>";
		}
	htmlstr+="</ul>";
	return htmlstr; 
}
 //����(��ѡ)
function showyearbox(inputname)
{
	$(inputname).click(function(){
		var input=$(this);
		$(input).parent("div").before("<div class=\"menu_bg_layer\"></div>");
		$(".menu_bg_layer").height($(document).height());
		$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0"});
		$(input).parent("div").css("position","relative");
		
		var myDate = new Date();
		var y=myDate.getFullYear();
			 y=y+5;
		var ymin=y-65;
		htm="<div class=\"showyearbox yearlist\">";		
		htm+="<div class=\"tit\">��ѡ�����>></div>";
		htm+="<ul>";
		for (i=y;i>=ymin;i--)
		{
		htm+="<li title=\""+i+"��\">"+i+"��</li>";
		}
		htm+="<div class=\"clear\"></div>";
		htm+="</ul>";
		htm+="</div>";
		//
		htm+="<div class=\"showyearbox monthlist\">";
		htm+="<div class=\"tit\">��ѡ���·�>></div>";
		htm+="<ul>";
		for (i=1;i<=12;i++)
		{
		htm+="<li title=\""+i+"��\">"+i+"��</li>";
		}
		htm+="<div class=\"clear\"></div>";
		htm+="</ul>";
		htm+="</div>";
		$(input).blur();
		if ($(input).parent("div").find(".showyearbox").html())
		{
			$(input).parent("div").children(".showyearbox.yearlist").slideToggle("fast");
		}
		else
		{
			$(input).parent("div").append(htm);
			$(input).parent("div").children(".showyearbox.yearlist").slideToggle("fast");
		}
		//
		$(input).parent("div").children(".yearlist").find("li").unbind("click").click(function()
		{
			$(input).val($(this).attr("title"));
			$(input).parent("div").children(".yearlist").hide();
			$(input).parent("div").children(".monthlist").show();
			$(input).parent("div").children(".monthlist").find("li").unbind("click").click(function()
			{
				$(input).val($(input).val()+$(this).attr("title"));
				$(".menu_bg_layer").hide();
				$(input).parent("div").css("position","");
				$(input).parent("div").find(".showyearbox").hide();
			});	
		});	
		//
		$(".showyearbox>ul>li").hover(
		function()
		{
		$(this).css("background-color","#DAECF5");
		$(this).css("color","#ff0000");
		},
		function()
		{
		$(this).css("background-color","");
		$(this).css("color","");
		}
		);
		//
		$(".menu_bg_layer").click(function(){
					$(".menu_bg_layer").hide();
					$(input).parent("div").css("position","");
					$(input).parent("div").find(".showyearbox").hide();
					//$(inputname+"_s").hide();
					
		});
	});
}

//���Ŷ�ѡ��ѡ�и�ֵ
function getcheckboxval(menuID,showID,inputname,inputname1,get)
{
	if (get)
	{
		arr=get.split("|");
		tcn=new Array();
		for(var i=0;i<arr.length;i++)
		{
			 var tid=arr[i].split(",");
			$(showID+" :checkbox[id="+tid[0]+"]").attr("checked",true);
			tcn[i]=tid[1];
		}
		$(inputname).val(tcn.join(","));
		$(inputname1).val(get);
	}
	//ѡ�е�ѡ��
	$(showID+" label").click(function()
	{
			var a_cn=new Array();
			var a_id=new Array();
			$(showID+" :checkbox[checked]").each(function(i){
			a_cn[i]=$(this).attr("title");
			a_id[i]=$(this).attr("value");
			});
			$(inputname).val(a_cn.join(","));
			$(inputname1).val(a_id.join("|"));
			if(inputname1=="#wage_structure"){
				 $("#Form1").validate().element(inputname1); 
		    }
	});			
}

 