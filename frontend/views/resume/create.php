
<div id="container">
    <div class="clearfix">
        <div class="content_l">
            <div class="fl" id="resume_name">
                <div class="nameShow fl">
                    <h1 title="jason的简历">jason的简历</h1>
                    <span class="rename">重命名</span> | <a target="_blank" href="h/resume/preview.html">预览</a>
                </div>
                <form class="fl dn" id="resumeNameForm">
                    <input type="text" value="jason的简历" name="resumeName" class="nameEdit c9">
                    <input type="submit" value="保存"> | <a target="_blank" href="h/resume/preview.html">预览</a>
                </form>
            </div>

            <div class="profile_box" id="basicInfo">
                <h2>基本信息</h2>
                <span class="c_edit"></span>
                <div class="basicShow">
                    <span>
                        <?= $user['name']?> |
                        <?= $user['sex'] == 1 ? '男' : '女' ?> |
                        <?= $user['height'] ?> |
                        <?= date('Y',time()) - $user['birthday'] ?>岁 |
                        <?= $user['marriage'] == 1 ? '已婚': '未婚'?>
                        <br>
                        籍贯：<?= $user['province_id'] . $user['city_id'] . $user['district_id'] ?>
                        <br>
                        <?= $user['education'] ?>学历 |
                        <?= $user['experience'] ?>工作经验
                        <br>
                        <?= $user['tel'] ?><?= $user['tel_audit'] == 1 ? '(<span style="color: green">已验证</span>)' : '(<span style="color: red">未验证</span>)'?>|
                        <?= $user['email'] ?><?= $user['email_audit'] == 1 ? '(<span style="color: green">已验证</span>)' : '(<span style="color: red">未验证</span>)'?><br>
                    </span>
                    <div class="m_portrait">
                        <div></div>
                        <img width="120" height="120" alt="jason" src="<?= $user['head_ic'] ?>">
                    </div>
                </div>
                <!--end .basicShow-->

                <div class="basicEdit dn">
                    <form id="profileForm" action="<?= \yii\helpers\Url::to(['resume/add'])?>" method="post">
                        <table>
                            <tbody>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="姓名"  id="name" name="name">
                                </td>
                                <td valign="top"></td>
                                <td>
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
                                    <select style="width: 100px;height: 40px;border: solid 2px #f2f2f2">
                                        <option>北京</option>
                                        <option>江苏</option>
                                    </select>
                                    <select style="width: 100px;height: 40px;border: solid 2px #f2f2f2"">
                                        <option>北京</option>
                                        <option>南京</option>
                                        <option>苏州</option>
                                    </select>
                                    <select style="width: 100px;height: 40px;border: solid 2px #f2f2f2"">
                                        <option>海淀</option>
                                        <option>雨花台</option>
                                        <option>科技园</option>
                                    </select>
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
                                    <input type="submit" value="保存">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form><!--end #profileForm-->
                    <div class="new_portrait">
                        <div class="portrait_upload" id="portraitNo">
                            <span>上传自己的头像</span>
                        </div>
                        <div class="portraitShow dn" id="portraitShow">
                            <img width="120" height="120" src="">
                            <span>更换头像</span>
                        </div>
                        <input type="file" value="" title="支持jpg、jpeg、gif、png格式，文件小于5M" onchange="img_check(this,'h/resume/uploadPhoto.json','headPic');" name="headPic" id="headPic" class="myfiles">
                        <!-- <input type="hidden" id="headPicHidden" /> -->
                        <em>
                            尺寸：120*120px <br>
                            大小：小于5M
                        </em>
                        <span style="display:none;" id="headPic_error" class="error"></span>
                    </div>
                    <!--end .new_portrait-->
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
                                    <input type="hidden" id="expectCity" value="" name="expectCity">
                                    <input type="button" value="期望城市，如：北京" id="select_expectCity" class="profile_select_287 profile_select_normal">
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
                                    <ul class="profile_radio clearfix reset">
                                        <li class="current">
                                            全职<em></em>
                                            <input type="radio" checked="" name="type" value="全职">
                                        </li>
                                        <li>
                                            兼职<em></em>
                                            <input type="radio" name="type" value="兼职">
                                        </li>
                                        <li>
                                            实习<em></em>
                                            <input type="radio" name="type" value="实习">
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" placeholder="期望职位，如：产品经理" value="" name="expectPosition" id="expectPosition">
                                </td>
                                <td>
                                    <input type="hidden" id="expectSalary" value="" name="expectSalary">
                                    <input type="button" value="期望月薪" id="select_expectSalary" class="profile_select_287 profile_select_normal">
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
                <input type="hidden" id="typeVal" value="">
                <input type="hidden" id="expectPositionVal" value="">
                <input type="hidden" id="expectSalaryVal" value="">
            </div><!--end #expectJob-->

            <div class="profile_box" id="workExperience">
                <h2>工作经历  <span> （投递简历时必填）</span></h2>
                <span class="c_add dn"></span>
                <div class="experienceShow dn">
                    <form class="experienceForm borderBtm dn">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="公司名称" name="companyName" class="companyName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="职位名称，如：产品经理" name="positionName" class="positionName">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearStart" value="" name="companyYearStart">
                                        <input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_companyYearStart">
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
                                        <input type="hidden" class="companyMonthStart" value="" name="companyMonthStart">
                                        <input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_companyMonthStart">
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
                                        <input type="hidden" class="companyYearEnd" value="" name="companyYearEnd">
                                        <input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_companyYearEnd">
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
                                        <input type="hidden" class="companyMonthEnd" value="" name="companyMonthEnd">
                                        <input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_companyMonthEnd">
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

                    <ul class="wlist clearfix">
                    </ul>
                </div><!--end .experienceShow-->
                <div class="experienceEdit dn">
                    <form class="experienceForm">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="公司名称" name="companyName" class="companyName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="职位名称，如：产品经理" name="positionName" class="positionName">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="companyYearStart" value="" name="companyYearStart">
                                        <input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_companyYearStart">
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
                                        <input type="hidden" class="companyMonthStart" value="" name="companyMonthStart">
                                        <input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_companyMonthStart">
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
                                        <input type="hidden" class="companyYearEnd" value="" name="companyYearEnd">
                                        <input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_companyYearEnd">
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
                                        <input type="hidden" class="companyMonthEnd" value="" name="companyMonthEnd">
                                        <input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_companyMonthEnd">
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
                                    <input type="text" placeholder="项目名称" name="projectName" class="projectName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="担任职务，如：产品负责人" name="thePost" class="thePost">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="projectYearStart" value="" name="projectYearStart">
                                        <input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_projectYearStart">
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
                                        <input type="hidden" class="projectMonthStart" value="" name="projectMonthStart">
                                        <input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_projectMonthStart">
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
                                        <input type="hidden" class="projectYearEnd" value="" name="projectYearEnd">
                                        <input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_projectYearEnd">
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
                                        <input type="hidden" class="projectMonthEnd" value="" name="projectMonthEnd">
                                        <input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_projectMonthEnd">
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
                                    <textarea class="projectDescription s_textarea" name="projectDescription" placeholder="项目描述"></textarea>
                                    <div class="word_count">你还可以输入 <span>500</span> 字</div>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="2">
                                    <textarea placeholder="职责描述" name="ResponsDescription" class="ResponsDescription s_textarea"></textarea>
                                    <div class="word_count">你还可以输入 <span>500</span> 字</div>
                                </td>
                            </tr> -->
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

            <div class="profile_box" id="educationalBackground">
                <h2>教育背景<span>（投递简历时必填）</span></h2>
                <span class="c_add dn"></span>
                <div class="educationalShow dn">
                    <form class="educationalForm borderBtm dn">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="学校名称" name="schoolName" class="schoolName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="hidden" class="degree" value="" name="degree">
                                    <input type="button" value="学历" class="profile_select_287 profile_select_normal select_degree">
                                    <div class="box_degree boxUpDown boxUpDown_287 dn" style="display: none;">
                                        <ul>
                                            <li>大专</li>
                                            <li>本科</li>
                                            <li>硕士</li>
                                            <li>博士</li>
                                            <li>其他</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="专业名称" name="professionalName" class="professionalName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="schoolYearStart" value="" name="schoolYearStart">
                                        <input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_schoolYearStart">
                                        <div class="box_schoolYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
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
                                        <input type="hidden" class="schoolYearEnd" value="" name="schoolYearEnd">
                                        <input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_schoolYearEnd">
                                        <div style="display: none;" class="box_schoolYearEnd  boxUpDown boxUpDown_139 dn">
                                            <ul>
                                                <li>2021</li>
                                                <li>2020</li>
                                                <li>2019</li>
                                                <li>2018</li>
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
                                <td></td>
                                <td colspan="3">
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                        <input type="hidden" class="eduId" value="">
                    </form><!--end .educationalForm-->

                    <ul class="elist clearfix">
                    </ul>
                </div><!--end .educationalShow-->
                <div class="educationalEdit dn">
                    <form class="educationalForm">
                        <table>
                            <tbody><tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="学校名称" name="schoolName" class="schoolName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="hidden" class="degree" value="" name="degree">
                                    <input type="button" value="学历" class="profile_select_287 profile_select_normal select_degree">
                                    <div class="box_degree boxUpDown boxUpDown_287 dn" style="display: none;">
                                        <ul>
                                            <li>大专</li>
                                            <li>本科</li>
                                            <li>硕士</li>
                                            <li>博士</li>
                                            <li>其他</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <input type="text" placeholder="专业名称" name="professionalName" class="professionalName">
                                </td>
                                <td valign="top">
                                    <span class="redstar">*</span>
                                </td>
                                <td>
                                    <div class="fl">
                                        <input type="hidden" class="schoolYearStart" value="" name="schoolYearStart">
                                        <input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_schoolYearStart">
                                        <div class="box_schoolYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
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
                                        <input type="hidden" class="schoolYearEnd" value="" name="schoolYearEnd">
                                        <input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_schoolYearEnd">
                                        <div class="box_schoolYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
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
                        <input type="hidden" class="eduId" value="">
                    </form><!--end .educationalForm-->
                </div><!--end .educationalEdit-->
                <div class="educationalAdd pAdd">
                    教育背景可以充分体现你的学习和专业能力，<br>
                    且完善后才可投递简历哦！
                    <span>添加教育经历</span>
                </div><!--end .educationalAdd-->
            </div><!--end #educationalBackground-->

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
                                    <textarea class="selfDescription s_textarea" name="selfDescription" placeholder=""></textarea>
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

            <div class="profile_box" id="worksShow">
                <h2>作品展示</h2>
                <span class="c_add dn"></span>
                <div class="workShow dn">
                    <ul class="slist clearfix">
                    </ul>
                </div><!--end .workShow-->
                <div class="workEdit dn">
                    <form class="workForm">
                        <table>
                            <tbody><tr>
                                <td>
                                    <input type="text" placeholder="请输入作品链接" name="workLink" class="workLink">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea maxlength="100" class="workDescription s_textarea" name="workDescription" placeholder="请输入说明文字"></textarea>
                                    <div class="word_count">你还可以输入 <span>100</span> 字</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="保 存" class="btn_profile_save">
                                    <a class="btn_profile_cancel" href="javascript:;">取 消</a>
                                </td>
                            </tr>
                            </tbody></table>
                        <input type="hidden" class="showId" value="">
                    </form><!--end .workForm-->
                </div><!--end .workEdit-->
                <div class="workAdd pAdd">
                    好作品会说话！<br>
                    快来秀出你的作品打动企业吧！
                    <span>添加作品展示</span>
                </div><!--end .workAdd-->
            </div><!--end #worksShow-->
            <input type="hidden" id="resumeId" value="268472">
        </div>
        <!--end .content_l-->


        <div class="content_r">
            <div class="mycenterR" id="myInfo">
                <h2>我的信息</h2>
                <a target="_blank" href="collections.html">我收藏的职位</a>
                <br>
                <a target="_blank" href="subscribe.html">我订阅的职位</a>
            </div><!--end #myInfo-->

            <div class="mycenterR" id="myResume">
                <h2>我的附件简历
                    <a title="上传附件简历" href="#uploadFile" class="inline cboxElement">上传简历</a>
                </h2>
                <div class="resumeUploadDiv">
                    暂无附件简历
                </div>
            </div><!--end #myResume-->


            <div class="mycenterR" id="myShare">
                <h2>当前每日投递量：10个</h2>
                <a target="_blank" href="h/share/invite.html">邀请好友，提升投递量</a>
            </div><!--end #myShare-->


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

<div id="footer">
    <div class="wrapper">
        <a rel="nofollow" target="_blank" href="h/about.html">联系我们</a>
        <a target="_blank" href="h/af/zhaopin.html">互联网公司导航</a>
        <a rel="nofollow" target="_blank" href="http://e.weibo.com/lagou720">拉勾微博</a>
        <a rel="nofollow" href="javascript:void(0)" class="footer_qr">拉勾微信<i></i></a>
        <div class="copyright">&copy;2013-2014 Lagou <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action" target="_blank">京ICP备14023790号-2</a></div>
    </div>
</div>

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
</body>
</html>