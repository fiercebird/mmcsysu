<?php


$this->pageTitle=Yii::app()->name . ' - 新增列表';
$this->breadcrumbs=array(
            '服务列表',
            '新增列表',
);
        
echo $this->renderPartial('_form', array('model' => $model));
?>
