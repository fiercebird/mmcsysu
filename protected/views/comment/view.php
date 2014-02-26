<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'评论管理',
	'查看评论',
);

?>
<h3>查看评论#<?php echo $model->comment_id; ?></h3>
<hr>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'author',
		'email',
		'create_time',
		'content',
		'reply',
                array(              
                   'name'=>'status',
                   'type'=>'raw',
                   'value'=>Dictionary::item(Yii::app()->params["dictTypeComment"], $model->status),
                   ),
	),
)); ?>
<br />
<a class="btn btn-info span2" href="<?php echo Yii::app()->request->urlReferrer ?>">返回</a>


<script language="javascript" type="text/javascript">
$('#collapse7').addClass('in');
</script>

