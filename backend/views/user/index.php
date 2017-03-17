<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserCurd */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<script src="js/jquery.min.js"></script>
<div class="user-index">
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        /*//整行的属性
        'rowOptions'  => function($row)//整行的对象
        {
            return ['id' => $row->id,];
        },*/
        'showFooter' => true,   //显示脚部
        'columns' => [
            [
                'class'         => 'yii\grid\CheckboxColumn',   //复选 全选
                'cssClass'      => '_check',
                'footer'        => '<a href="javascript:;" id="delete-all">全部删除</a>',
                //'footerOptions' => ['colspan' => 10],         //合并脚部 'class'=>'hide'
            ],
            'id',
            'account',
            [
                'attribute' => 'password',//必须是attribute 才能表格列值搜索功能
                'value' => function($row) {
                    return "<span class='_update'>$row->password</span>";//Html::tag('span',$row->password,['class'=>'_update'])
                },
                'format' => 'html',
            ],
            'tel',
            'email:email',
            [
                'attribute' => 'head_ic',
                'format' => ['image', ['width'=>'60', 'height'=>'40']],
            ],
            ['attribute'=>'last_login_time', 'format'=>['date', 'php:Y-m-d H:i:s']],
            'last_login_ip',
            'status',
            'userinfo.name',
            [
                'attribute' => 'userinfo.sex',
                'value' => function($row) {
                    if(isset($row->getRelatedRecords()['userinfo'])) {
                        return $row->getRelatedRecords()['userinfo']->sex == 0 ? '女' : '男';
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> '<a href="javascript:;">操作</a>',
                /*'template' => '{delete}',
                'buttons' => [
                        'delete' => function($url,$row)
                        {
                            return "<a href='javascript:;' class='_delete' url=$url>删除</a>";
                        }
                ]*/
            ],
        ],
        'emptyText'=>'当前没有用户',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold'],
        'layout' => "{summary}\n{items}\n{pager}",
        //'showOnEmpty'=>false,         //没有数据不展示表格
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
            var url = "<?= Url::to(['user/update-one'])?>";
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
            var url = "<?= Url::to(['user/delete-all'])?>";
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
