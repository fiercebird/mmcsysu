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
         'id'=>'useradmin-grid',
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
               'name'=>'campus_id',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:8%; text-align:center; '),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeCampus"], $data->campus_id)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeCampus"]),
               ),            
            array(
               'name'=>'username',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:13%; text-align:center; '),
               'value'=>'CHtml::link(CHtml::encode($data->username), $data->url)'
               ),  
            array(
               'name'=>'authority',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>''),
               'filter'=>false,
               'value'=>array($this,'authorityColumnLayout'),  
               ),  
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{view} {update} {delete}',
               'htmlOptions'=>array('style'=>'width:60px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要删除该用户'+$(this).parent().parent().children(':eq(1)').html()+'？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除用户成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'view'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->user_id, "username"=>$data->username))',
                     'options'=>array('class'=>'icon-search', 'title'=>'查看用户' ),
                     ),  
                  'update'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->user_id, "username"=>$data->username))',
                     'options'=>array('class'=>'icon-edit', 'title'=>'更新用户' ),
                     ),  
                  'delete'=>array(      
                     'label'=>'',          
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->user_id, "username"=>$data->username))',
                     'options'=>array('class'=>'icon-remove', 'title'=>'删除用户', ),
                     ),
                 ),
               ),  
            ),  
            )); 


?>

<div id='hint'></div>


<script language="javascript" type="text/javascript">
$('#collapse8').addClass('in');
</script>
