<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
switch($typeid) {
    case MisService::WEEK_SERVICE:
        $name = '周报表';
        break;
    case MisService::MONTH_SERVICE:
        $name = '月报表';
        break;
    case MisService::SURVEY_SERVICE:
        $name = '服务调查表';
        break;
    case MisService::STAT_SERVICE:
        $name = '服务统计表';
        break;
    case MisService::TABLE_SERVICE:
        $name = '表格下载';
        break;
    default:
        $name = '';
}

$this->pageTitle=Yii::app()->name . ' - '.$name;
$this->breadcrumbs=array(
            '服务列表',
            $name,
);        
?>

<?php
if(Yii::app()->user->hasFlash('success'))
   echo '<div class="flash-success mesFade">' . Yii::app()->user->getFlash('success') . '</div>';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'mis-service-grid',
    'dataProvider' => $model->search($typeid),
    'pager'=>array('class'=>'CLinkPager',
            'maxButtonCount'=>10,
            'header'=>'', 
            'firstPageLabel'=>'首页', 
            'lastPageLabel'=>'末页',
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            ),
     'nullDisplay'=>' ',
     'template'=>"{summary}{items}{pager}",
     'summaryText'=>"第{start}-{end}条 | 共{count}条 | {page}/{pages}页",
     'filter'=>$model,
     'columns' => array(
         array('name' => 'content', 'type' => 'raw', 'value' => 'MisService::getLink($data->content)'),
         'date',
         array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{delete}',
               'htmlOptions'=>array('style'=>'width:90px; text-align:center;')),
         ),
));
?>

<script>
    $('#collapse3').addClass('in');
</script>    
