<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'评论管理'=>array('index'),
	'评论列表',
);



$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'commentGrid',
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
               'name'=>'author',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:100px'),
               ),  
            array(
               'name'=>'email',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:150px'),
               ), 
            array(
               'name'=>'content',
               'type'=>'raw',
               //'value'=>'mb_substr($data->content, 0, 300, "utf-8")',
               ), 
            array(
               'name'=>'create_time',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:110px'),
               'value'=>'substr($data->create_time,0,-3)',  
               ), 
            array(
               'name'=>'status',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:70px'),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeComment"], $data->status)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeComment"]),
               ),  
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{view} {update} {delete}',
               'htmlOptions'=>array('style'=>'width:90px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要把评论人为\"'+$(this).parent().parent().children(':eq(0)').html()+'\"的评论放入回收站？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除评论成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'view'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->comment_id))',
                     'options'=>array('class'=>'icon-search', 'title'=>'查看评论' ),
                     ),  
                  'update'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->comment_id))',
                     'options'=>array('class'=>'icon-edit', 'title'=>'编辑评论' ),
                     ),  
                  'delete'=>array(      
                     'label'=>'',          
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->comment_id))',
                     'options'=>array('class'=>'icon-trash', 'title'=>'放入回收站', ),
                     ),
                 ),
               ),  
            ),  
            )); 


?>

<div id='hint'></div>


<script language="javascript" type="text/javascript">
$('#collapse7').addClass('in');
</script>



