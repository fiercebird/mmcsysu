<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'评论管理',
	'更新评论',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
