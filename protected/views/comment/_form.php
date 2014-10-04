<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
if(Yii::app()->user->hasFlash('error'))
   echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';

?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
         'id'=>'commentForm',
         'enableClientValidation'=>true,
         'clientOptions'=>array(
            'validateOnSubmit'=>true,
            ),
         'type'=>'horizontal',
         'htmlOptions'=>array('class'=>'well'),
         )); ?>

<fieldset><legend><strong>更新评论</strong></legend>
<?php
echo $form->textFieldRow($model,'author', array('disabled'=>true)); 
echo $form->textFieldRow($model,'email', array('disabled'=>true)); 
echo $form->textFieldRow($model,'create_time',array('disabled'=>true)); 
echo $form->textAreaRow($model,'content', array('disabled'=>true, 'style'=>'height:200px;width:690px;')); 
echo $form->textAreaRow($model,'reply',  array('style'=>'height:200px;width:690px;')); 
echo $form->dropDownListRow($model,'status', Dictionary::items(Yii::app()->params['dictTypeComment'])); 
?>
<br />
</fieldset>
<div class='control-group'><div class='controls'>
<?php    
$this->widget('bootstrap.widgets.TbButton', array( 'buttonType'=>'submit', 'type'=>'primary', 'label'=> '保存', 'htmlOptions'=>array('class'=>'span2 offset2', 'id'=>'finishBtn') )); 
echo '<a class="btn btn-info span2" href="' . Yii::app()->request->urlReferrer . '">返回</a>';
?>
</div></div>
<?php   $this->endWidget(); ?>



<script language="javascript" type="text/javascript">
$('#collapse7').addClass('in');
</script>
