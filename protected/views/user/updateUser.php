<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-20 
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 更新用户';
$this->breadcrumbs=array(
           '用户管理',
           '更新用户',
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

