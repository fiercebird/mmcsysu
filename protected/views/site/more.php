<?php
/* @var $this SiteController */
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-23
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
           '服务信息',
);


$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'serviceInfoGrid',
         'dataProvider'=>$model->search(),
         'pager'=>array('class'=>'CLinkPager',
            'maxButtonCount'=>30,
            'header'=>'', 
            'firstPageLabel'=>'首页', 
            'lastPageLabel'=>'末页',
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            ),
         'nullDisplay'=>' ',
         'template'=>"{summary}{items}{pager}",
         'summaryText'=>"第{page}页，共{pages}页",
         'filter'=>$model,
         'columns'=>array(
             array(
               'name'=>'campus_id',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:80px'),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeCampus"], $data->campus_id)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeCampus"]),
               ),            
            array(
               'name'=>'publisher',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:180px'),
               ),  
            array(
               'name'=>'title',
               'type'=>'raw',
               'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
               ), 
            array(
               'name'=>'create_time',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:130px'),
               'value'=>'substr($data->create_time,0,-3)',  
               ),  
            ),  
            )); 


?>


