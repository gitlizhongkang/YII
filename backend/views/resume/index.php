<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeCurd */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<script src="js/jquery.min.js"></script>
<div class="resume-index">

    <h1>Resume</h1>

   <!-- <p>
        <?/*= Html::a('Create Resume', ['create'], ['class' => 'btn btn-success']) */?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,   //显示脚部
        'columns' =>
            [
                [
                    'class'         => 'yii\grid\CheckboxColumn',   //复选 全选
                    'cssClass'      => '_check',
                    'footer'        => '<a href="javascript:;" id="delete-all">全部删除</a>',
                ],
                'id',
                'uid',
                [
                    'attribute' => 'audit',
                    'value' => function($row)
                    {
                        if($row->audit == 1) {
                            return "<span class='_update'>1</span>";
                        }elseif($row->audit == 2) {
                            return "<span class='_update'>2</span>";
                        }else{
                            return "<span class='_update'>3</span>";
                        }
                    },
                    'footer' => '<a href="javascript:;" id="update-all">全部审核</a>(1审核中|2通过|3未通过)',
                    'format' => 'html',
                ],
                [
                    'attribute' => 'display',
                    'value' => function($row) {
                            return $row->display == 1 ? '公开' : '保密';
                    }
                ],
                'title',
                'name',
                'tel',
                'email:email',
                'category.categoryname',
                ['attribute'=>'addtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
                ['attribute'=>'refreshtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}  {delete}',
                    'header'=> '<a href="javascript:;">操作</a>',
                ],
            ],
        'emptyText'=>'当前没有简历',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold'],
    ]); ?>
</div>


<script>
    $(function () {
        //选择之后添加一个识别类
        $('._check').click(function () {
            $(this).parents('tr').toggleClass('checked');
        });
        $('.select-on-check-all').click(function () {
            $('._check').parents('tr').toggleClass('checked');
        });


        //即点即改
        $(document).on('click','._update',function () {

            oldValue = $(this).html();
            var par =  $(this).parent();

            par.html('<input type="text" id="_self" value="'+oldValue+'" size="6">');
            par.children('input').focus();
        });
        $(document).on('blur','#_self',function () {

            var _self = $(this);
            var newValue = _self.val();
            var url = "<?= Url::to(['resume/update-one'])?>";
            var id = $(this).parents('tr').attr('data-key');

            if(oldValue == newValue  || (newValue != 1 && newValue != 2 && newValue != 3))
            {
                _self.parent().html('<span class="_update">'+oldValue+'</span>')
            }
            else
            {
                $.get(url,{id:id,data:newValue},function (map) {
                    if(map.done == '1')
                    {
                        _self.parent().html('<span class="_update">'+newValue+'</span>');
                        alert(map.msg);
                    }
                    else
                    {
                        _self.parent().html('<span class="_update">'+oldValue+'</span>');
                        alert(map.msg);
                    }
                })
            }
        });

        //批量修改
        $('#update-all').click(function () {
            var url = "<?= Url::to(['resume/update-all'])?>";
            var tr = $('.checked');
            var ids = select(tr);
            var num = prompt('请选择审核选项(1 |审核中, 2 |通过, 3 |未通过)');
            if(num != 1 && num != 2 && num != 3)
            {
                alert('请输入正确数字');
                return false;
            }
            $.get(url,{ids:ids,data:num},function (map) {
                if(map.done == 1)
                {
                    for(var i = tr.size(); i >= 0; i--)
                    {
                        tr.eq(i).find('._update').html(num);
                    }
                    alert(map.msg);
                }
                else
                {
                    alert(map.msg);
                }
            })
        });


        //ajax批删
        $('#delete-all').click(function () {
            var url = "<?= Url::to(['resume/delete-all'])?>";
            var tr = $('.checked');
            var ids = select(tr);

            $.get(url,{ids:ids},function (map) {
                if(map.done == 1)
                {
                    for(var i = tr.size(); i >= 0; i--)
                    {
                        tr.eq(i).remove();
                    }
                    alert(map.msg);
                }
                else
                {
                    alert(map.msg);
                }
            })
        });

        function select(tr) {
            var ids = '';
            for(var i = 0; i<tr.size(); i++)
            {
                ids += ',' + tr.eq(i).attr('data-key');
            }
            ids = ids.substr(1);
            return ids;
        }
    })
</script>

