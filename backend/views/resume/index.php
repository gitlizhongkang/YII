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

    <p>
        <?= Html::a('Create Resume', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'click',
                [
                    'attribute' => 'audit',
                    'value' => function($row)
                    {
                        if($row->audit == 1) {
                            return "<span class='_update'>审核中</span>";
                        }elseif($row->audit == 2) {
                            return "<span class='_update'>已审核</span>";
                        }else{
                            return "<span class='_update'>审核未通过</span>";
                        }
                    },
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
                [
                    'attribute' => 'photo',
                    'format' => ['image', ['width'=>'60', 'height'=>'40',]],
                ],
                [
                    'attribute' => 'sex',
                    'value' => function($row) {
                        return $row->sex == 1 ? '男' : '女';
                    }
                ],
                'height',
                'birthday',
                'tel',
                'email:email',
                'residence',
                'birthland',
                [
                    'attribute' => 'marriage',
                    'value' => function($row)
                    {
                        if($row->marriage == 1) {
                            return '保密';
                        }elseif($row->marriage == 2) {
                            return '未婚';
                        }else{
                            return '已婚';
                        }
                    }
                ],
                'nature',
                'experience',
                'education',
                'major',
                'intention_jobs_id',
                'wage',
                //'good_at',
                //'specialty',
                ['attribute'=>'addtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
                ['attribute'=>'refreshtime', 'format'=>['date', 'php:Y-m-d H:i:s']],
                [
                    'class' => 'yii\grid\ActionColumn',
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

            if(oldValue == newValue)
            {
                _self.parent().html('<span class="_update">'+newValue+'</span>')
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


        //ajax批删
        $('#delete-all').click(function () {
            var url = "<?= Url::to(['resume/delete-all'])?>";
            var tr = $('.checked');
            var ids = '';
            for(var i = 0; i<tr.size(); i++)
            {
                ids += ',' + tr.eq(i).attr('data-key');
            }

            ids = ids.substr(1);
            $.get(url,{ids:ids},function (map) {
                if(map == 1)
                {
                    for(var i = tr.size(); i >= 0; i--)
                    {
                        tr.eq(i).remove();
                    }
                }
                else
                {
                    alert('删除失败');
                }
            })
        })
    })
</script>

