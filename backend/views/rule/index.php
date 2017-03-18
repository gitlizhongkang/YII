<?php
use yii\helpers\Url;
?>
<link href="css/rule/rule.css" rel="stylesheet" type="text/css" />
<body class="mian_bj">
<div class="mian_top_01">
    <div class="mian_top_r"></div>
    <div class="mian_top_l"></div>
    <div class="mian_top_c">
        <ul>
            <li><a href="<?=Url::to(['rule/index'])?>"><p>用户管理</p></a></li>
            <li><a href="Role.html"><p>角色管理</p></a></li>
            <li><a href="Power.html"><p>权限管理</p></a></li>
        </ul>
    </div>
    <div class="mian_b">
        <div class="mian_b1">
            <a href="#" title="添加"><p class="mian_b1_a1"></p></a>
            <a href="#" title="删除"><p class="mian_b1_a2"></p></a>
            <p class="mian_b1_sousuo"><input name="" type="text"></p>
            <a href="#" title="搜索"><p class="mian_b1_a3"></p></a>
            <a href="#" title="最后"><p class="mian_b1_a4"></p></a>
            <a href="#" title="下一页"><p class="mian_b1_a5"></p></a>
            <p class="mian_b1_list">1 2 3 4……</p>
            <a href="#" title="上一页"><p class="mian_b1_a6"></p></a>
            <a href="#" title="最前"><p class="mian_b1_a7"></p></a>
        </div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mian_b_bg">
            <tr>
                <td width="3%" class="mian_b_bg_lm"><input name="" type="checkbox" value="">&nbsp;</td>
                <td width="11%" class="mian_b_bg_lm"><span></span>部门编号</td>
                <td width="13%" class="mian_b_bg_lm"><span></span>部门名称</td>
                <td width="10%" class="mian_b_bg_lm"><span></span>部门简称</td>
                <td width="37%" class="mian_b_bg_lm"><span></span>备注</td>
                <td colspan="2" class="mian_b_bg_lm"><span></span>操作</td>
            </tr>
            <tr>
                <td><input name="" type="checkbox" value="">&nbsp;</td>
                <td>1001 </td>
                <td>人事部</td>
                <td>HR</td>
                <td>主管公司人事</td>
                <td width="8%" class="mian_b_icon_01"><a href="AddBranch.html">编辑</a></td>
                <td width="8%" class="mian_b_icon_02"><a href="BranchDetail.html">查看</a></td>
            </tr>
            <tr>
                <td><input name="" type="checkbox" value="">&nbsp;</td>
                <td>1001 </td>
                <td>人事部</td>
                <td>HR</td>
                <td>主管公司人事</td>
                <td width="8%" class="mian_b_icon_01"><a href="AddBranch.html">编辑</a></td>
                <td width="8%" class="mian_b_icon_02"><a href="BranchDetail.html">查看</a></td>
            </tr>
            <tr>
                <td width="3%" class="mian_b_bg_lm"></td>
                <td width="11%" class="mian_b_bg_lm"><span></span>部门编号</td>
                <td width="13%" class="mian_b_bg_lm"><span></span>部门名称</td>
                <td width="10%" class="mian_b_bg_lm"><span></span>部门简称</td>
                <td width="37%" class="mian_b_bg_lm"><span></span>备注</td>
                <td colspan="2" class="mian_b_bg_lm"><span></span>操作</td>
            </tr>
        </table>
    </div>
</div>
</body>

