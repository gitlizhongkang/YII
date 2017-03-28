function allaround(dir,getstr){
	var checkedstr = "";
	fillTag("#divTagCate"); // ��ҵ�������
	// �ָ���ҵѡ������
	if(getstr) {
		if(getstr[0]) {
			var recoverTradArray = getstr[0].split(",");
			$.each(recoverTradArray, function(index, val) {
				 $("#tagList a").each(function() {
					if(val == $(this).attr('cln')) {
						$(this).addClass('selectedcolor');
					}
				});
			});
			copyTradItem();
			var a_cn = new Array();
			$("#tagAcq a").each(function(index) {
				var checkText = $(this).attr('title');
				a_cn[index]=checkText;
			});
			$("#tagText").html(a_cn.join(","));
			$("#tagText").css("color","#4095ef");
			$("#jobsTag").css("border-color","#4095ef");
			checkedstr += '<a href="javascript:;" ty="tag" class="cnt"><span>'+$("#tagText").html()+'</span><i class="del"></i></a>';
		}
	}
	/* ��ҵ�б�����ʾ����ѡ */
	$("#tagList li a").unbind().live('click', function() {
		// �ж�ѡ��������Ƿ񳬳�
		if($("#tagList .selectedcolor").length >= 5) {
			$("#tagropcontent").show(0).delay(3000).fadeOut("slow");
		} else {
			$(this).addClass('selectedcolor');
			copyTradItem(); // ����ҵ��ѡ�Ŀ���
		}
	});
	// ��ҵȷ��ѡ��
	$("#tagSure").unbind().click(function() {
		var a_cn=new Array();
		var a_id=new Array();
		$("#tagAcq a").each(function(index) {
			var checkID = $(this).attr('rel');
			var checkText = $(this).attr('title');
			a_id[index]=checkID;
			a_cn[index]=checkText;
		});
		if (a_cn.length > 0) {
			$("#tagText").html(a_cn.join(","));
			$("#tagText").css("color","#4095ef");
			$("#jobsTag").css("border-color","#4095ef");
			$("#tag_cn").val(a_cn.join(","));
			$("#tag").val(a_id.join(","));
		} else {
			$("#tagText").html("��ѡ���ǩ");
			$("#tagText").css("color","#cccccc");
			$("#jobsTag").css("border-color","#cccccc");
			$("#tag_cn").val("");
			$("#tag").val("");
		}
		$("#divTagCate").hide();
	});
	fillJobs("#divJobCate"); // ְλ�������
	// �ָ�ְλѡ������
	if(getstr) {
		if(getstr[1]) {
			var recoverJobArray = getstr[1].split(",");
			$.each(recoverJobArray, function(index, val) {
				 var demojobArray = val.split(".");
				 if(demojobArray[2] == "0") { // ���������������0 ��ֻѡ���ڶ���
				 	$(".jobcatebox p a").each(function() {
				 		if(demojobArray[1] == $(this).attr("rcoid")) {
				 			$(this).addClass('selectedcolor');
				 		}
				 	});
				 } else {
				 	$(".jobcatebox .subcate a").each(function() {
				 		if(demojobArray[2] == $(this).attr("rcoid")) {
				 			$(this).addClass('selectedcolor');
				 		}
				 	});
				 }
			});
			copyJobItem();
			var a_cn=new Array();
			$("#jobAcq a").each(function(index) {
				var checkText = $(this).attr('title');
				a_cn[index]=checkText;
			});
			$("#jobText").html(a_cn.join(","));
			$("#jobText").css("color","#4095ef");
			$("#jobsSort").css("border-color","#4095ef");
			checkedstr += '<a href="javascript:;" ty="jobs_id" class="cnt"><span>'+$("#jobText").html()+'</span><i class="del"></i></a>';
		}
	}
	/* ְλ�б�����ʾ����ѡ */
	$("#divJobCate li p a").unbind().live('click', function() {
		// �ж�ѡ��������Ƿ񳬳�
		if($("#divJobCate .selectedcolor").length >= 5) {
			$("#jobdropcontent").show(0).delay(3000).fadeOut("slow");
		} else {
			$(this).addClass('selectedcolor');
			copyJobItem(); // ��ְλ��ѡ�Ŀ���
		}
	});
	$("#divJobCate .subcate a").unbind().live('click', function() {
		// �ж�ѡ��������Ƿ񳬳�
		if($("#divJobCate .selectedcolor").length >= 5) {
			$("#jobdropcontent").show(0).delay(3000).fadeOut("slow");
		} else {
			if($(this).attr("p") == "qb") {
				$(this).parent().prev().find('font a').addClass('selectedcolor');
				$(this).parent().find('a').removeClass('selectedcolor');
			} else {
				$(this).parent().prev().find('font a').removeClass('selectedcolor');
				$(this).addClass('selectedcolor');
			}
			copyJobItem(); // ��ְλ��ѡ�Ŀ���
		}
	});
	// ְλȷ��ѡ��
	$("#jobSure").unbind().click(function() {
		var a_cn=new Array();
		var a_id=new Array();
		$("#jobAcq a").each(function(index) {
			// ���ѡ����Ƕ������ཫ������������0
			var chid = new Array();
			if($(this).attr('pid')) {
				chid = $(this).attr('pid').split(".");
				if(chid.length < 3) {
					chid.push(0);
				}
			}
			var checkID = chid.join(".");
			var checkText = $(this).attr('title');
			a_id[index]=checkID;
			a_cn[index]=checkText;
		});
		if (a_cn.length > 0) {
			$("#jobText").html(a_cn.join(","));
			$("#jobText").css("color","#4095ef");
			$("#jobsSort").css("border-color","#4095ef");
			$("#jobs_cn").val(a_cn.join(","));
			$("#jobs_id").val(a_id.join(","));
		} else {
			$("#jobText").html("��ѡ��ְλ���");
			$("#jobText").css("color","#cccccc");
			$("#jobsSort").css("border-color","#cccccc");
			$("#jobs_cn").val("");
			$("#jobs_id").val("");
		}
		$("#divJobCate").hide();
	});
	fillCity("#divCityCate"); // �����������
	// �ָ�����ѡ������
	if(getstr) {
		if(getstr[2]) {
			var recoverCityArray = getstr[2].split(",");
			$.each(recoverCityArray, function(index, val) {
				 var democityArray = val.split(".");
				 if(democityArray[1] == 0) { // ����ڶ�������Ϊ 0 ˵��ѡ�����һ������
				 	$(".citycatebox p a").each(function() {
				 		if(democityArray[0] == $(this).attr("rcoid")) {
				 			$(this).addClass('selectedcolor');
				 		}
				 	});
				 } else { // ѡ����Ƕ�������
				 	$(".citycatebox .subcate a").each(function() {
				 		if(democityArray[1] == $(this).attr("rcoid")) {
				 			$(this).addClass('selectedcolor');
				 		}
				 	});
				 }
			});
			copyCityItem();
			var a_cn=new Array();
			$("#cityAcq a").each(function(index) {
				var checkText = $(this).attr('title');
				a_cn[index]=checkText;
			});
			$("#cityText").html(a_cn.join(","));
			$("#cityText").css("color","#4095ef");
			$("#jobsCity").css("border-color","#4095ef");
			checkedstr += '<a href="javascript:;" ty="district_id" class="cnt"><span>'+$("#cityText").html()+'</span><i class="del"></i></a>';
		}
	}
	/* �����б�����ʾ����ѡ */
	$("#divCityCate li p a").unbind().live('click', function(){
		// �ж�ѡ��������Ƿ񳬳�
		if($("#divCityCate .selectedcolor").length >= 5) {
			$("#citydropcontent").show(0).delay(3000).fadeOut("slow");
		} else {
			$(this).addClass('selectedcolor');
			copyCityItem(); // ��������ѡ�Ŀ���
		}
	});
	$("#divCityCate .subcate a").unbind().live('click', function() {
		// �ж�ѡ��������Ƿ񳬳�
		if($("#divCityCate .selectedcolor").length >= 5) {
			$("#citydropcontent").show(0).delay(3000).fadeOut("slow");
		} else {
			if($(this).attr("p") == "qb") {
				$(this).parent().prev().find('font a').addClass('selectedcolor');
				$(this).parent().find('a').removeClass('selectedcolor');
			} else {
				$(this).parent().prev().find('font a').removeClass('selectedcolor');
				$(this).addClass('selectedcolor');
			}
			copyCityItem(); // ��������ѡ�Ŀ���
		}
	});
	// ����ȷ��ѡ��
	$("#citySure").unbind().click(function() {
		var a_cn=new Array();
		var a_id=new Array();
		$("#cityAcq a").each(function(index) {
			// ���ѡ�����һ���������ڶ��������� 0
			var chid = new Array();
			if($(this).attr('pid')) {
				chid = $(this).attr('pid').split(".");
				if(chid.length < 2) {
					chid.push(0);
				}
			}
			var checkID = chid.join(".");
			var checkText = $(this).attr('title');
			a_id[index]=checkID;
			a_cn[index]=checkText;
		});
		if (a_cn.length > 0) {
			$("#cityText").html(a_cn.join(","));
			$("#cityText").css("color","#4095ef");
			$("#jobsCity").css("border-color","#4095ef");
			$("#district_cn").val(a_cn.join(","));
			$("#district_id").val(a_id.join(","));
		} else {
			$("#cityText").html("��ѡ���������");
			$("#cityText").css("color","#cccccc");
			$("#jobsCity").css("border-color","#cccccc");
			$("#district_cn").val("");
			$("#district_id").val("");
		}
		$("#divCityCate").hide();
	});
	// ����ؼ���������
	$("#searckey").focus(function() {
		if($(this).val() == "������ؼ���") {
			$(this).val('');
		}
	}).blur(function() {
		if($(this).val() == "") {
			$(this).val('������ؼ���');
		}
	});
	// �ؼ�����ʾ����ѡ��
	if($("#searckey").attr("data")) {
		checkedstr += '<a href="javascript:;" ty="key" class="cnt"><span>'+$("#searckey").attr("data")+'</span><i class="del"></i></a>';
	}
	// ���������ť
	$("#btnsearch").unbind().click(function() {
		search_location();
	});
	// ��������ѡ��ĵ��
	$("#searoptions .opt").click(function(){
		var opt=$(this).attr('id');
		opt=opt.split("-");
		$("#searckeybox input[name="+opt[0]+"]").val(opt[1]);
		search_location();
	});
	// ְλ�б�ҳ��ѡ����������ʾ
	if(checkedstr != "") {
		$("#showselected").html(checkedstr);
		$("#jobselected").show();
	}
	$("#showselected .cnt").click(function(){
		var opt=$(this).attr('ty');
		$("#searckeybox input[name="+opt+"]").val('');
		setTimeout(function() {
			search_location();
		}, 1);
	});
	$("#clearallopt").click(function(){
		$("#searckeybox input[type='hidden']").val('');
		$("#searckeybox input[name='key']").val('');
		setTimeout(function() {
			search_location();
		}, 1);
	});
	// ������ת
	function search_location() {
		var key=$("#searckeybox input[name=key]").val();
		if($("#searckeybox input[name=key]").val() == "������ؼ���") {
			key = '';
		}
		var tag=$("#searckeybox input[name=tag]").val();
		var jobcategory=$("#searckeybox input[name=jobs_id]").val();
		var citycategory=$("#searckeybox input[name=district_id]").val();
		var sort_1=$("#searckeybox input[name=sort]").val();
		var page=$("#searckeybox input[name=page]").val();
		$.get(dir+"plus/ajax_search_location.php", {"act":"QS_resumetag","key":key,"tag":tag,"jobcategory":jobcategory,"citycategory":citycategory,"sort":sort_1,"page":page},
			function (data,textStatus)
			 {	
				 window.location.href=data;
			 },"text"
		);
	}
}
/*
 * 74cms ְλ����ҳ�� ��ҵ���ݵ����
|   @param: fillID      -- �����ID
*/
function fillTag(fillID){
	var tradli = '';
	$.each(QS_resumetag, function(index, val) {
		if(val) {
			var trads = val.split(",");
		 	tradli += '<li><a title="'+trads[1]+'" cln="'+trads[0]+'" href="javascript:;">'+trads[1]+'</a></li>';
		}
	});
	$(fillID+" ul").html(tradli);
}
/*
 * 74cms ְλ����ҳ�� ������ҵ��ѡ
*/
function copyTradItem() {
	var tradacqhtm = '';
	$("#tagList .selectedcolor").each(function() {
		tradacqhtm += '<a href="javascript:;" rel="'+$(this).attr('cln')+'" title="'+$(this).attr('title')+'"><div class="text">'+$(this).attr('title')+'</div><div class="close" id="c-'+$(this).attr('cln')+'"></div></a>';
	});
	$("#tagAcq").html(tradacqhtm);
	// ��ѡ��Ŀ�󶨵���¼�
	$("#tagAcq a").unbind().click(function() {
		var selval = $(this).attr('title');
		$("#tagList .selectedcolor").each(function() {
			if ($(this).attr('title') == selval) {
				$(this).removeClass('selectedcolor');
				copyTradItem();
			}
		});
	});
	// ���
	$("#tagEmpty").unbind().click(function() {
		$("#tagAcq").html("");
		$("#tagList .selectedcolor").each(function() {
			$(this).removeClass('selectedcolor');
		});
	});
}
/*
 * 74cms ְλ����ҳ�� ְλ���ݵ����
|   @param: fillID      -- �����ID
*/
function fillJobs(fillID){
	var jobstr = '';
	$.each(QS_jobs_parent, function(pindex, pval) {
		if(pval) {
			jobstr += '<tr>';
			var jobs = pval.split(",");
		 	jobstr += '<th>'+jobs[1]+'</th>';
		 	jobstr += '<td><ul class="jobcatelist">';
		 	var sjobsArray = QS_jobs[jobs[0]].split("|");
		 	$.each(sjobsArray, function(sindex, sval) {
		 		if(sval) {
		 			var sjobs = sval.split(",");
			 		jobstr += '<li>';
			 		jobstr += '<p><font><a rcoid="'+sjobs[0]+'" pid="'+jobs[0]+'.'+sjobs[0]+'" title="'+sjobs[1]+'" href="javascript:;">'+sjobs[1]+'</a></font></p>';
			 		if(QS_jobs[sjobs[0]]) {
			 			jobstr += '<div class="subcate" style="display:none;">';
			 			var cjobsArray = QS_jobs[sjobs[0]].split("|");
			 			jobstr += '<a p="qb" href="javascript:;">����</a>';
				 		$.each(cjobsArray, function(cindex, cval) {
				 			if(cval) {
					 			var cjobs = cval.split(",");
					 			jobstr += '<a rcoid="'+cjobs[0]+'" title="'+cjobs[1]+'" pid="'+jobs[0]+'.'+sjobs[0]+'.'+cjobs[0]+'" href="javascript:;">'+cjobs[1]+'</a>';
				 			}
				 		});
			 			jobstr += '</div>';
			 		}
			 		jobstr += '</li>';
		 		}
		 	});
		 	jobstr += '</ul></td>';
			jobstr += '</tr>';
		}
	});
	$(fillID+" tbody").html(jobstr);
	$(".jobcatelist li").each(function() {
		if($(this).find('.subcate').length <= 0) {
			$(this).find('font').css("background","none");
		}
	});
}
/*
 * 74cms ְλ����ҳ�� �������ݵ����
|   @param: fillID      -- �����ID
*/
function fillCity(fillID){
	var citystr = '';
	citystr += '<tr>';
	citystr += '<td><ul class="jobcatelist">';
	$.each(QS_city_parent, function(pindex, pval) {
		if(pval) {
			var citys = pval.split(",");
	 		citystr += '<li>';
	 		citystr += '<p><font><a rcoid="'+citys[0]+'" pid="'+citys[0]+'" title="'+citys[1]+'" href="javascript:;">'+citys[1]+'</a></font></p>';
	 		if(QS_city[citys[0]]) {
	 			citystr += '<div class="subcate" style="display:none;">';
	 			var ccitysArray = QS_city[citys[0]].split("|");
	 			citystr += '<a p="qb" href="javascript:;">����</a>';
		 		$.each(ccitysArray, function(cindex, cval) {
		 			if(cval) {
			 			var ccitys = cval.split(",");
			 			citystr += '<a rcoid="'+ccitys[0]+'" title="'+ccitys[1]+'" pid="'+citys[0]+'.'+ccitys[0]+'" href="javascript:;">'+ccitys[1]+'</a>';
		 			}
		 		});
	 			citystr += '</div>';
	 		}
	 		citystr += '</li>';
		}
	});
	citystr += '</ul></td>';
	citystr += '</tr>';
	$(fillID+" tbody").html(citystr);
	$(".jobcatelist li").each(function() {
		if($(this).find('.subcate').length <= 0) {
			$(this).find('font').css("background","none");
		}
	});
}
/*
 * 74cms ְλ����ҳ�� ����������ѡ
*/
function copyCityItem() {
	var cityacqhtm = '';
	$("#divCityCate .selectedcolor").each(function() {
		cityacqhtm += '<a pid="'+$(this).attr('pid')+'" href="javascript:;" title="'+$(this).attr('title')+'"><div class="text">'+$(this).attr('title')+'</div><div class="close"></div></a>';
	});
	$("#cityAcq").html(cityacqhtm);
	// ��ѡ��Ŀ�󶨵���¼�
	$("#cityAcq a").unbind().click(function() {
		var selval = $(this).attr('title');
		$("#divCityCate .selectedcolor").each(function() {
			if ($(this).attr('title') == selval) {
				$(this).removeClass('selectedcolor');
				copyCityItem();
			}
		});
	});
	// ���
	$("#cityEmpty").unbind().click(function() {
		$("#cityAcq").html("");
		$("#divCityCate .selectedcolor").each(function() {
			$(this).removeClass('selectedcolor');
		});
	});
}
/*
 * 74cms ְλ����ҳ�� ����ְλ��ѡ
*/
function copyJobItem() {
	var jobacqhtm = '';
	$("#divJobCate .selectedcolor").each(function() {
		jobacqhtm += '<a pid="'+$(this).attr('pid')+'" href="javascript:;" title="'+$(this).attr('title')+'"><div class="text">'+$(this).attr('title')+'</div><div class="close"></div></a>';
	});
	$("#jobAcq").html(jobacqhtm);
	// ��ѡ��Ŀ�󶨵���¼�
	$("#jobAcq a").unbind().click(function() {
		var selval = $(this).attr('title');
		$("#divJobCate .selectedcolor").each(function() {
			if ($(this).attr('title') == selval) {
				$(this).removeClass('selectedcolor');
				copyJobItem();
			}
		});
	});
	// ���
	$("#jobEmpty").unbind().click(function() {
		$("#jobAcq").html("");
		$("#divJobCate .selectedcolor").each(function() {
			$(this).removeClass('selectedcolor');
		});
	});
}