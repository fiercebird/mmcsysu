<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-18 
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 管理用户';
$this->breadcrumbs=array(
           '用户管理',
           '管理用户',
);

$this->widget('zii.widgets.grid.CGridView', array(
         'dataProvider'=>$model->search(),
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
         'columns'=>array(
            array(
               'name'=>'username',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:13%; text-align:center; '),
               //'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
               ),  
            array(
               'name'=>'authority',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:200px; '),
               //'filter'=>false,
               //'value'=>'Lookup::item("PostStatus",$data->status)',
               //'filter'=>Lookup::items('PostStatus'),
               ),  
           
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'htmlOptions'=>array('style'=>'width:20%;'),
               ),  
            ),  
         )); 


?>



<script language="javascript" type="text/javascript">
$('#collapse8').addClass('in');

</script>
