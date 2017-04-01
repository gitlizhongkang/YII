<style>
    .border{border: 2px solid blue}
</style>
<?php $id = Yii::$app->request->get('id') ? Yii::$app->request->get('id'): null ?>
<script>
    var addUrl = "<?=\yii\helpers\Url::to(['resume/add','id'=>$id])?>";
    var updateUrl = "<?=\yii\helpers\Url::to(['resume/create'])?>";
</script>
<div id="container">
    <div class="clearfix">
        <div class="content_l">
            <div class="fl" id="resume_name">
                <div class="nameShow fl">
                    <h1><?= isset($user['title'])?$user['title']:"$user[name]的简历" ?></h1>
                    <span class="rename">重命名</span> | <a id="vie" href="javascript:;">预览</a>
                    <script>
                        $('#vie').click(function () {
                            var url = "<?=\yii\helpers\Url::to(['resume/view','id'=>Yii::$app->request->get('id')])?>";
                            window.open( url, "_blank");
                        })
                    </script>
                </div>
                <form class="fl dn" id="resumeNameForm">
                    <input type="text" value="" name="resumeName" class="nameEdit c9">
                    <input type="submit" value="保存"> | <a target="_blank" href="<?= \yii\helpers\Url::to(['view','id'=>Yii::$app->request->get('id')]) ?>">预览</a>
                </form>
            </div>

            <div class="profile_box" id="basicInfo">
                <h2>基本信息</h2>
                <?= isset($user['photo']) ? null : '<span style="color: red;">[第一步]请先确认保存此信息(此信息从个人信息获取未保存)</span>' ?>
                <span class="c_edit"></span>
                <div class="basicShow">
                    <span>
                        <?= $user['name']?> |
                        <?= $user['sex'] == 1 ? '男' : '女' ?> |
                        <?= $user['height'] ?> |
                        <?= date('Y',time()) - $user['birthday'] ?>岁 |
                        <?= $user['marriage'] == 3 ? '已婚': '未婚'?>
                        <br>
                        <?= $user['education'] ?>学历 |
                        <?= $user['experience'] ?>工作经验
                        <br>
                        <?= $user['tel'] ?>
                        <?= $user['email'] ?></span>
                    <div class="m_portrait">
                        <div></div>
                        <img width="120" height="120" src="<?= isset($user['photo']) ? $user['photo'] : 'uploads/14.jpg' ?>">
                    </div>
                </div>
                <!--end .basicShow-->

                <div class="basicEdit dn">
                    <form id="profileForm">
                        <table>
                            <tbody>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="姓名"  id="name" name="name">
                                    <input type="hidden" id="photo_id" name="photo_id" value="<?= isset($user['photo_id'])?$user['photo_id']:''?>">
                                </td>
                                <td valign="top"></td>
                                <td>
                                    <input type="hidden" name="se">
                                    <ul class="profile_radio clearfix reset">
                                        <li>
                                            男<em></em>
                                            <input type="radio" name="sex" value="1">
                                        </li>
                                        <li>
                                            女<em></em>
                                            <input type="radio" name="sex" value="0">
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="身高cm" value="<?= $user['height']?>" name="height">
                                </td>
                                <td valign="top"></td>
                                <td>
                                    <input type="hidden" name="marr">
                                    <ul class="profile_radio clearfix reset">
                                        <li>
                                            未婚<em></em>
                                            <input type="radio" name="marriage" value="2">
                                        </li>
                                        <li>
                                            已婚<em></em>
                                            <input type="radio" name="marriage" value="3">
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearEnd" value="<?= $user['birthday']?>" name="birthday">
                                        <input type="button" value="<?= $user['birthday']?>年" class="profile_select_139 profile_select_normal select_companyYearEnd">
                                        <div class="box_companyYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>2017</li>
                                                <li>2016</li>
                                                <li>2015</li>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td colspan="3">
                                    <select style="width: 100px;height: 40px;border: solid 2px #f2f2f2" name="province_id" id="userinfo-province_id">
                                        <?php
                                        foreach ($province as $key=>$val) {
                                            if($user['province_id'] == $key) {
                                                echo "<option value=$key parentid=$key selected>$val</option>";
                                            } else {
                                                echo "<option value=$key parentid=$key>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                    <select name="city_id" id="userinfo-city_id" style='width: 100px;height: 40px;border: solid 2px #f2f2f2'>
                                        <option value="" id='aa'>请选择</option>
                                        <?= !empty($city) ? "<option value=$city[id] selected>$city[categoryname]</option>" : null ?>
                                    </select>
                                    <script>
                                        //城市联动
                                        $('#userinfo-province_id').change(function()
                                        {
                                            $('#aa').nextAll().remove();
                                            var option=$('#userinfo-province_id option');
                                            for(var i=0;i<option.length;i++){
                                                if(option.eq(i).prop('selected')){
                                                    var parentid=option.eq(i).attr('parentid');
                                                }
                                            }
                                            $.ajax({
                                                type:'post',
                                                url:"<?=\yii\helpers\Url::to(['user/district'])?>",
                                                data:{
                                                    'parentid':parentid
                                                },
                                                dataType:'json',
                                                success:function(msg){
                                                    var str='';
                                                    $.each(msg,function(k,v){
                                                        str+='<option value="'+v.id+'" parentid="'+v.id+'">'+v.categoryname+'</option>';
                                                    })
                                                    $('#aa').after(str);
                                                }
                                            })
                                        })

                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="hidden" id="topDegree" name="education">
                                    <input type="button" id="select_topDegree" class="profile_select_190 profile_select_normal">
                                    <div class="boxUpDown boxUpDown_190 dn" id="box_topDegree" style="display: none;">
                                        <ul>
                                            <li>大专</li>
                                            <li>本科</li>
                                            <li>硕士</li>
                                            <li>博士</li>
                                            <li>其他</li>
                                        </ul>
                                    </div>
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="hidden" id="workyear" name="experience">
                                    <input type="button" id="select_workyear" class="profile_select_190 profile_select_normal">
                                    <div class="boxUpDown boxUpDown_190 dn" id="box_workyear" style="display: none;">
                                        <ul>
                                            <li>应届毕业生</li>
                                            <li>1-2年</li>
                                            <li>3-5年</li>
                                            <li>6-10年</li>
                                            <li>10年以上</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td colspan="3">
                                    <input type="text" placeholder="手机号码" name="tel" id="tel">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td colspan="3">
                                    <input type="text" placeholder="接收面试通知的邮箱" name="email" id="email">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <input type="submit" value="保存"  class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <script>
                        $(function(){
                            $("body").on("click","a.btn_s",function(){
                                $.colorbox.close();
                                parent.jQuery.colorbox.close();
                            });
                            $(".inline").colorbox({
                                inline:true
                            });
                            $(document).on('click','.img',function(){
                                $('.img').removeClass('border');
                                $(this).addClass('border');

                                var url = $(this).attr('src');
                                var id = $(this).attr('photo_id');
                                $('#img').attr('src',url);
                                $('#photo_id').val(id);
                            });
                            $('input[name="sex"]').click(function () {
                                var sex = $(this).val();
                                $('input[name="se"]').val(sex)
                            });
                            $('input[name="marriage"]').click(function () {
                                $('input[name="marr"]').val($(this).val())
                            })
                        });
                    </script>
                    <div class="new_portrait">
                        <div class="portraitShow dn" id="portraitShow">
                            <img width="120" height="120" id="img" src="">
                            <span><a class="inline" href="#downloadOnlineResume">选择图片</a></span>
                        </div>
                    </div>
                    <div style="display:none;">
                        <div class="popup" id="downloadOnlineResume">
                            <table width="100%">
                                <tbody>
                                <tr>
                                    <td class="c5 f18">选择审核通过的图片：</td>
                                </tr>
                                <table>
                                    <?php
                                    foreach ($photo as $key=>$val)
                                    {
                                        if($key % 3 == 0 ) {
                                            echo "<tr>";
                                        }
                                        echo "<td><img src=$val[photo] photo_id=$val[id] class='img' width='100' height='70'></td>";
                                        if(($key+1) % 3 == 0 ) {
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!--end .basicEdit-->
                <input type="hidden" id="nameVal" value="<?= $user['name'] ?>">
                <input type="hidden" id="genderVal" value="<?= $user['sex'] ?>">
                <input type="hidden" id="marriageVal" value="<?= $user['marriage'] ?>">
                <input type="hidden" id="topDegreeVal" value="<?= $user['education'] ?>">
                <input type="hidden" id="workyearVal" value="<?= $user['experience'] ?>">
                <input type="hidden" id="emailVal" value="<?= $user['email'] ?>">
                <input type="hidden" id="telVal" value="<?= $user['tel'] ?>">
            </div><!--end #basicInfo-->




            <div class="profile_box" id="expectJob">
                <h2>期望工作</h2>
                <span class="c_edit dn"></span>
                <div class="expectShow dn">
                    <span></span>
                </div><!--end .expectShow-->
                <div class="expectEdit dn">
                    <form id="expectForm">
                        <table>
                            <tbody><tr>
                                <td>
                                    <input type="hidden" id="expectCity" value="<?=isset($user['residence'])?$user['residence']:''?>" name="expectCity">
                                    <input type="button" value="<?=isset($user['residence'])?$user['residence']:'期望城市，如：北京'?>" id="select_expectCity" class="profile_select_287 profile_select_normal">
                                    <div class="boxUpDown boxUpDown_596 dn" id="box_expectCity" style="display: none;">
                                        <dl>
                                            <dt>热门城市</dt>
                                            <dd>
                                                <span>北京</span>
                                                <span>上海</span>
                                                <span>广州</span>
                                                <span>深圳</span>
                                                <span>成都</span>
                                                <span>杭州</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>ABCDEF</dt>
                                            <dd>
                                                <span>北京</span>
                                                <span>长春</span>
                                                <span>成都</span>
                                                <span>重庆</span>
                                                <span>长沙</span>
                                                <span>常州</span>
                                                <span>东莞</span>
                                                <span>大连</span>
                                                <span>佛山</span>
                                                <span>福州</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>GHIJ</dt>
                                            <dd>
                                                <span>贵阳</span>
                                                <span>广州</span>
                                                <span>哈尔滨</span>
                                                <span>合肥</span>
                                                <span>海口</span>
                                                <span>杭州</span>
                                                <span>惠州</span>
                                                <span>金华</span>
                                                <span>济南</span>
                                                <span>嘉兴</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>KLMN</dt>
                                            <dd>
                                                <span>昆明</span>
                                                <span>廊坊</span>
                                                <span>宁波</span>
                                                <span>南昌</span>
                                                <span>南京</span>
                                                <span>南宁</span>
                                                <span>南通</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>OPQR</dt>
                                            <dd>
                                                <span>青岛</span>
                                                <span>泉州</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>STUV</dt>
                                            <dd>
                                                <span>上海</span>
                                                <span>石家庄</span>
                                                <span>绍兴</span>
                                                <span>沈阳</span>
                                                <span>深圳</span>
                                                <span>苏州</span>
                                                <span>天津</span>
                                                <span>太原</span>
                                                <span>台州</span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>WXYZ</dt>
                                            <dd>
                                                <span>武汉</span>
                                                <span>无锡</span>
                                                <span>温州</span>
                                                <span>西安</span>
                                                <span>厦门</span>
                                                <span>烟台</span>
                                                <span>珠海</span>
                                                <span>中山</span>
                                                <span>郑州</span>
                                            </dd>
                                        </dl>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="nature" value="1">
                                    <ul class="profile_radio clearfix reset">
                                        <li class="current">
                                            全职<em></em>
                                            <input type="radio" name="type" value="1">
                                        </li>
                                        <li>
                                            兼职<em></em>
                                            <input type="radio" name="type" value="2">
                                        </li>
                                        <li>
                                            实习<em></em>
                                            <input type="radio" name="type" value="3">
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" placeholder="<?=isset($user['intention_jobs'])?$user['intention_jobs']:'期望职位，如：产品经理'?>" value="<?=isset($user['intention_jobs'])?$user['intention_jobs']:''?>" name="expectPosition" id="expectPosition">
                                </td>
                                <td>
                                    <input type="hidden" id="expectSalary" value="<?=isset($user['wage'])?$user['wage']:''?>" name="expectSalary">
                                    <input type="button" value="<?=isset($user['wage'])?$user['wage']:'期望月薪'?>" id="select_expectSalary" class="profile_select_287 profile_select_normal">
                                    <div class="boxUpDown boxUpDown_287 dn" id="box_expectSalary" style="display: none;">
                                        <ul>
                                            <li>2k以下</li>
                                            <li>2k-5k</li>
                                            <li>5k-10k</li>
                                            <li>10k-15k</li>
                                            <li>15k-25k</li>
                                            <li>25k-50k</li>
                                            <li>50k以上</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </form><!--end #expectForm-->
                </div><!--end .expectEdit-->
                <div class="expectAdd pAdd">
                    填写准确的期望工作能大大提高求职成功率哦…<br>
                    快来添加期望工作吧！
                    <span>添加期望工作</span>
                </div><!--end .expectAdd-->

                <input type="hidden" id="expectJobVal" value="">
                <input type="hidden" id="expectCityVal" value="">
                <input type="hidden" id="typeVal" value="<?= isset($user['nature'])?$user['nature']:''?>">
                <input type="hidden" id="expectPositionVal" value="">
                <input type="hidden" id="expectSalaryVal" value="<?= isset($user['wage'])?$user['wage']:''?>">
            </div><!--end #expectJob-->


            <script>
                $(function(){
                    $("body").on("click","a.btn_s",function(){
                        $.colorbox.close();
                        parent.jQuery.colorbox.close();
                    });
                    $(".inline").colorbox({
                        inline:true
                    });
                    $(document).on('click','.img',function(){
                        $('.img').removeClass('border');
                        $(this).addClass('border');

                        var url = $(this).attr('src');
                        var id = $(this).attr('photo_id');
                        $('#img').attr('src',url);
                        $('#photo_id').val(id);
                    });
                    $('input[name="sex"]').click(function () {
                        var sex = $(this).val();
                        $('input[name="se"]').val(sex)
                    });
                    $('input[name="marriage"]').click(function () {
                        $('input[name="marr"]').val($(this).val())
                    });
                    $('input[name="type"]').click(function () {
                        $('input[name="nature"]').val($(this).val())
                    })
                });
            </script>


            <div class="profile_box" id="workExperience">
                <h2>工作经历 <span> （投递简历时必填）</span></h2>
                <span class="c_add dn"></span>
                <!--<div class="experienceShow dn">
                    <form class="experienceForm borderBtm dn">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" value="<?/*= isset($user['companyName']) ? $user['companyName'] : '公司名称' */?>"  name="companyName" class="companyName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" value="<?/*= isset($user['positionName'])?$user['positionName']:'职位名称，如：产品经理'*/?>" name="positionName" class="positionName">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearStart" value="<?/*= isset($user['startYear'])?$user['startYear']:''*/?>" name="companyYearStart">
                                        <input type="button" value="<?/*= isset($user['startYear'])?$user['startYear']:'开始年份'*/?>" class="profile_select_139 profile_select_normal select_companyYearStart">
                                        <div class="box_companyYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="companyMonthStart" value="<?/*= isset($user['startMonth'])?$user['startMonth']:''*/?>" name="companyMonthStart">
                                        <input type="button" value="<?/*= isset($user['startMonth'])?$user['startMonth']:'开始月份'*/?>" class="profile_select_139 profile_select_normal select_companyMonthStart">
                                        <div style="display: none;" class="box_companyMonthStart boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearEnd" value="<?/*= isset($user['endYear'])?$user['endYear']:''*/?>" name="companyYearEnd">
                                        <input type="button" value="<?/*= isset($user['endYear'])?$user['endYear']:'结束年份'*/?>" class="profile_select_139 profile_select_normal select_companyYearEnd">
                                        <div class="box_companyYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>至今</li>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="companyMonthEnd" value="<?/*= isset($user['endMonth'])?$user['endMonth']:''*/?>" name="companyMonthEnd">
                                        <input type="button" value="<?/*= isset($user['endMonth'])?$user['endMonth']:'结束月份'*/?>" class="profile_select_139 profile_select_normal select_companyMonthEnd">
                                        <div style="display: none;" class="box_companyMonthEnd boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                        <input type="hidden" class="expId" value="">
                    </form>
                    <ul class="wlist clearfix">
                    </ul>
                </div>-->
                <div class="experienceEdit dn">
                    <form class="experienceForm">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="<?= isset($user['companyName']) ? $user['companyName'] : '请输入公司名称' ?>"  value="<?= isset($user['companyName']) ? $user['companyName'] : '' ?>" name="companyName" class="companyName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="<?= isset($user['positionName'])?$user['positionName']:'请输入职位'?>"  value="<?= isset($user['positionName'])?$user['positionName']:''?>" name="positionName" class="positionName">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearStart" value="<?= isset($user['startYear']) ? $user['startYear']:'' ?>" name="companyYearStart">
                                        <input type="button" value="<?= isset($user['startYear'])?$user['startYear']:'开始年份'?>" class="profile_select_139 profile_select_normal select_companyYearStart">
                                        <div class="box_companyYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="companyMonthStart" value="<?= isset($user['startMonth'])?$user['startMonth']:''?>" name="companyMonthStart">
                                        <input type="button" value="<?= isset($user['startMonth'])?$user['startMonth']:'开始月份'?>" class="profile_select_139 profile_select_normal select_companyMonthStart">
                                        <div style="display: none;" class="box_companyMonthStart boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearEnd" value="<?= isset($user['endYear'])?$user['endYear']:''?>" name="companyYearEnd">
                                        <input type="button" value="<?= isset($user['endYear'])?$user['endYear']:'结束年份'?>" class="profile_select_139 profile_select_normal select_companyYearEnd">
                                        <div class="box_companyYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>至今</li>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="companyMonthEnd" value="<?= isset($user['endMonth'])?$user['endMonth']:''?>" name="companyMonthEnd">
                                        <input type="button" value="<?= isset($user['endMonth'])?$user['endMonth']:'结束月份'?>" class="profile_select_139 profile_select_normal select_companyMonthEnd">
                                        <div style="display: none;" class="box_companyMonthEnd boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                        <input type="hidden" class="expId" value="">
                    </form><!--end .experienceForm-->
                </div><!--end .experienceEdit-->

                <div class="experienceAdd pAdd">
                    工作经历最能体现自己的工作能力，<br>
                    且完善后才可投递简历哦！
                    <span>添加工作经历</span>
                </div><!--end .experienceAdd-->
            </div><!--end #workExperience-->



            <div class="profile_box" id="projectExperience">
                <h2>项目经验</h2>
                <span class="c_add dn"></span>
                <div class="projectShow dn">
                    <ul class="plist clearfix">
                    </ul>
                </div><!--end .projectShow-->
                <div class="projectEdit dn">
                    <form class="projectForm">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="<?=isset($user['projectName']) ? $user['projectName'] : '项目名称'?>" value="<?=isset($user['projectName']) ? $user['projectName'] : ''?>" name="projectName" class="projectName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="<?=isset($user['positionName_p']) ? $user['positionName_p'] : '担任职务，如：产品负责人'?>" value="<?=isset($user['positionName_p']) ? $user['positionName_p'] : ''?>" name="thePost" class="thePost">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="projectYearStart" value="<?=isset($user['startYear_p']) ? $user['startYear_p'] : ''?>" name="projectYearStart">
                                        <input type="button" value="<?=isset($user['startYear_p']) ? $user['startYear_p'] : '开始年份'?>" class="profile_select_139 profile_select_normal select_projectYearStart">
                                        <div class="box_projectYearStart  boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="projectMonthStart" value="<?=isset($user['startMonth_p']) ? $user['startMonth_p'] : ''?>" name="projectMonthStart">
                                        <input type="button" value="<?=isset($user['startMonth_p']) ? $user['startMonth_p'] : '开始月份'?>" class="profile_select_139 profile_select_normal select_projectMonthStart">
                                        <div style="display: none;" class="box_projectMonthStart boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="projectYearEnd" value="<?=isset($user['endYear_p']) ? $user['endYear_p'] : ''?>" name="projectYearEnd">
                                        <input type="button" value="<?=isset($user['endYear_p']) ? $user['endYear_p'] : '结束年份'?>" class="profile_select_139 profile_select_normal select_projectYearEnd">
                                        <div class="box_projectYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
                                            <ul>
                                                <li>至今</li>
                                                <li>2014</li>
                                                <li>2013</li>
                                                <li>2012</li>
                                                <li>2011</li>
                                                <li>2010</li>
                                                <li>2009</li>
                                                <li>2008</li>
                                                <li>2007</li>
                                                <li>2006</li>
                                                <li>2005</li>
                                                <li>2004</li>
                                                <li>2003</li>
                                                <li>2002</li>
                                                <li>2001</li>
                                                <li>2000</li>
                                                <li>1999</li>
                                                <li>1998</li>
                                                <li>1997</li>
                                                <li>1996</li>
                                                <li>1995</li>
                                                <li>1994</li>
                                                <li>1993</li>
                                                <li>1992</li>
                                                <li>1991</li>
                                                <li>1990</li>
                                                <li>1989</li>
                                                <li>1988</li>
                                                <li>1987</li>
                                                <li>1986</li>
                                                <li>1985</li>
                                                <li>1984</li>
                                                <li>1983</li>
                                                <li>1982</li>
                                                <li>1981</li>
                                                <li>1980</li>
                                                <li>1979</li>
                                                <li>1978</li>
                                                <li>1977</li>
                                                <li>1976</li>
                                                <li>1975</li>
                                                <li>1974</li>
                                                <li>1973</li>
                                                <li>1972</li>
                                                <li>1971</li>
                                                <li>1970</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fl">
                                        <input type="hidden" class="projectMonthEnd" value="<?=isset($user['endMonth_p']) ? $user['endMonth_p'] : ''?>" name="projectMonthEnd">
                                        <input type="button" value="<?=isset($user['endMonth_p']) ? $user['endMonth_p'] : '结束月份'?>" class="profile_select_139 profile_select_normal select_projectMonthEnd">
                                        <div style="display: none;" class="box_projectMonthEnd boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td colspan="3">
                                    <textarea class="projectDescription s_textarea" name="projectDescription" placeholder="项目描述"><?=isset($user['projectRemark']) ? $user['projectRemark'] : ''?></textarea>
                                    <div class="word_count">你还可以输入 <span>500</span> 字</div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td colspan="3">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                        <input type="hidden" value="" class="projectId">
                    </form><!--end .projectForm-->
                </div><!--end .projectEdit-->
                <div class="projectAdd pAdd">
                    项目经验是用人单位衡量人才能力的重要指标哦！<br>
                    来说说让你难忘的项目吧！
                    <span>添加项目经验</span>
                </div><!--end .projectAdd-->
            </div><!--end #projectExperience-->



            <div class="profile_box" id="selfDescription">
                <h2>自我描述</h2>
                <span class="c_edit dn"></span>
                <div class="descriptionShow dn">

                </div><!--end .descriptionShow-->
                <div class="descriptionEdit dn">
                    <form class="descriptionForm">
                        <table>
                            <tbody><tr>
                                <td colspan="2">
                                    <textarea class="selfDescription s_textarea" name="selfDescription" placeholder="<?=isset($user['specialty']) ? $user['specialty'] : ''?>"><?=isset($user['specialty']) ? $user['specialty'] : ''?></textarea>
                                    <div class="word_count">你还可以输入 <span>500</span> 字</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </form><!--end .descriptionForm-->
                </div><!--end .descriptionEdit-->
                <div class="descriptionAdd pAdd">
                    描述你的性格、爱好以及吸引人的经历等，<br>
                    让企业了解多元化的你！
                    <span>添加自我描述</span>
                </div><!--end .descriptionAdd-->
            </div><!--end #selfDescription-->

            <input type="hidden" id="resumeId" value="268472">
        </div>
        <!--end .content_l-->


        <div class="content_r">
            <div class="mycenterR" id="myInfo">
                <h1><a target="_blank"  style="color: green" href="<?= \yii\helpers\Url::to(['resume/index'])?>">返回个人中心</a></h1>
            </div><!--end #myInfo-->



            <div class="greybg qrcode mt20">
                <img width="242" height="242" alt="拉勾微信公众号二维码" src="style/images/qr_resume.png">
                <span class="c7">微信扫一扫，轻松找工作</span>
            </div>
        </div><!--end .content_r-->
    </div>

    <input type="hidden" id="userid" name="userid" value="314873">

    <!-------------------------------------弹窗lightbox ----------------------------------------->
    <div style="display:none;">
        <!-- 上传简历 -->
        <div class="popup" id="uploadFile">
            <table width="100%">
                <tbody><tr>
                    <td align="center">
                        <form>
                            <a class="btn_addPic" href="javascript:void(0);">
                                <span>选择上传文件</span>
                                <input type="file" onchange="file_check(this,'h/nearBy/updateMyResume.json','resumeUpload')" class="filePrew" id="resumeUpload" name="newResume" size="3" title="支持word、pdf、ppt、txt、wps格式文件，大小不超过10M" tabindex="3">
                            </a>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td align="left">支持word、pdf、ppt、txt、wps格式文件<br>文件大小需小于10M</td>
                </tr>
                <tr>
                    <td align="left" style="color:#dd4a38; padding-top:10px;">注：若从其它网站下载的word简历，请将文件另存为.docx格式后上传</td>
                </tr>
                <tr>
                    <td align="center"><img width="55" height="16" alt="loading" style="visibility: hidden;" id="loadingImg" src="style/images/loading.gif"></td>
                </tr>
                </tbody></table>
        </div><!--/#uploadFile-->

        <!-- 简历上传成功 -->
        <div class="popup" id="uploadFileSuccess">
            <h4>简历上传成功！</h4>
            <table width="100%">
                <tbody><tr>
                    <td align="center"><p>你可以将简历投给你中意的公司了。</p></td>
                </tr>
                <tr>
                    <td align="center"><a class="btn_s" href="javascript:;">确&nbsp;定</a></td>
                </tr>
                </tbody></table>
        </div><!--/#uploadFileSuccess-->

        <!-- 没有简历请上传 -->
        <div class="popup" id="deliverResumesNo">
            <table width="100%">
                <tbody><tr>
                    <td align="center"><p class="font_16">你在拉勾还没有简历，请先上传一份</p></td>
                </tr>
                <tr>
                    <td align="center">
                        <form>
                            <a class="btn_addPic" href="javascript:void(0);">
                                <span>选择上传文件</span>
                                <input type="file" onchange="file_check(this,'h/nearBy/updateMyResume.json','resumeUpload1')" class="filePrew" id="resumeUpload1" name="newResume" size="3" title="支持word、pdf、ppt、txt、wps格式文件，大小不超过10M">
                            </a>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td align="center">支持word、pdf、ppt、txt、wps格式文件，大小不超过10M</td>
                </tr>
                </tbody></table>
        </div><!--/#deliverResumesNo-->

        <!-- 上传附件简历操作说明-重新上传 -->
        <div class="popup" id="fileResumeUpload">
            <table width="100%">
                <tbody><tr>
                    <td>
                        <div class="f18 mb10">请上传标准格式的word简历</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="f16">
                            操作说明：<br>
                            打开需要上传的文件 - 点击文件另存为 - 选择.docx - 保存
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a title="上传附件简历" href="#uploadFile" class="inline btn cboxElement">重新上传</a>
                    </td>
                </tr>
                </tbody></table>
        </div><!--/#fileResumeUpload-->

        <!-- 上传附件简历操作说明-重新上传 -->
        <div class="popup" id="fileResumeUploadSize">
            <table width="100%">
                <tbody><tr>
                    <td>
                        <div class="f18 mb10">上传文件大小超出限制</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="f16">
                            提示：<br>
                            单个附件不能超过10M，请重新选择附件简历！
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a title="上传附件简历" href="#uploadFile" class="inline btn cboxElement">重新上传</a>
                    </td>
                </tr>
                </tbody></table>
        </div><!--/#deliverResumeConfirm-->

    </div>
    <!------------------------------------- end ----------------------------------------->

    <script src="style/js/Chart.min.js" type="text/javascript"></script>
    <script src="style/js/profile.min.js" type="text/javascript"></script>
    <!-- <div id="profileOverlay"></div> -->
    <div class="" id="qr_cloud_resume" style="display: none;">
        <div class="cloud">
            <img width="134" height="134" src="">
            <a class="close" href="javascript:;"></a>
        </div>
    </div>
    <script>
        $(function(){
            $.ajax({
                url:ctx+"/mycenter/showQRCode",
                type:"GET",
                async:false
            }).done(function(data){
                if(data.success){
                    $('#qr_cloud_resume img').attr("src",data.content);
                }
            });
            var sessionId = "resumeQR"+314873;
            if(!$.cookie(sessionId)){
                $.cookie(sessionId, 0, {expires: 1});
            }
            if($.cookie(sessionId) &amp;&amp; $.cookie(sessionId) != 5){
                $('#qr_cloud_resume').removeClass('dn');
            }
            $('#qr_cloud_resume .close').click(function(){
                $('#qr_cloud_resume').fadeOut(200);
                resumeQR = parseInt($.cookie(sessionId)) + 1;
                $.cookie(sessionId, resumeQR, {expires: 1});
            });
        });
    </script>
    <div class="clear"></div>
    <input type="hidden" value="97fd449bcb294153a671f8fe6f4ba655" id="resubmitToken">
    <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
</div><!-- end #container -->


<script src="style/js/core.min.js" type="text/javascript"></script>
<script src="style/js/popup.min.js" type="text/javascript"></script>

<!--  -->

<script type="text/javascript">
    $(function(){
        $('#noticeDot-1').hide();
        $('#noticeTip a.closeNT').click(function(){
            $(this).parent().hide();
        });
    });
    var index = Math.floor(Math.random() * 2);
    var ipArray = new Array('42.62.79.226','42.62.79.227');
    var url = "ws://" + ipArray[index] + ":18080/wsServlet?code=314873";
    var CallCenter = {
        init:function(url){
            var _websocket = new WebSocket(url);
            _websocket.onopen = function(evt) {
                console.log("Connected to WebSocket server.");
            };
            _websocket.onclose = function(evt) {
                console.log("Disconnected");
            };
            _websocket.onmessage = function(evt) {
                //alert(evt.data);
                var notice = jQuery.parseJSON(evt.data);
                if(notice.status[0] == 0){
                    $('#noticeDot-0').hide();
                    $('#noticeTip').hide();
                    $('#noticeNo').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }else{
                    $('#noticeDot-0').show();
                    $('#noticeTip strong').text(notice.status[0]);
                    $('#noticeTip').show();
                    $('#noticeNo').text('('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text(' ('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }
                $('#noticeDot-1').hide();
            };
            _websocket.onerror = function(evt) {
                console.log('Error occured: ' + evt);
            };
        }
    };
    CallCenter.init(url);
</script>

<div id="cboxOverlay" style="display: none;"></div>
<div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;">
    <div id="cboxWrapper">
        <div>
            <div id="cboxTopLeft" style="float: left;"></div>
            <div id="cboxTopCenter" style="float: left;"></div>
            <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxMiddleLeft" style="float: left;"></div>
            <div id="cboxContent" style="float: left;">
                <div id="cboxTitle" style="float: left;"></div>
                <div id="cboxCurrent" style="float: left;"></div>
                <button type="button" id="cboxPrevious"></button>
                <button type="button" id="cboxNext"></button>
                <button id="cboxSlideshow"></button>
                <div id="cboxLoadingOverlay" style="float: left;"></div>
                <div id="cboxLoadingGraphic" style="float: left;"></div>
            </div>
            <div id="cboxMiddleRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxBottomLeft" style="float: left;"></div>
            <div id="cboxBottomCenter" style="float: left;"></div>
            <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
</div>
