<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(
	'评论管理'=>array('index'),
	'评论清单',
);


$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
         'pager'=>array('class'=>'CLinkPager',
            'header'=>'', 
            'firstPageLabel'=>'首页', 
            'lastPageLabel'=>'末页',
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            ),
         'template'=>"{summary}{items}{pager}",
         'summaryText'=>"第{start}-{end}条 | 共{count}条 | {page}/{pages}页",
         'itemView'=>'_view',
)); ?>



<script language="javascript" type="text/javascript">
$('#collapse7').addClass('in');
</script>



