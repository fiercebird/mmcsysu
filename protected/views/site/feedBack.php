<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-01-22
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 意见收集';
$this->breadcrumbs=array(
           '意见收集',
);
?>
<div>
<?php
if(isset($comments))
{
?>
<div class='row-fluid'>

</div>
<?php } ?>
<div class='row-fluid'>
<div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
         'id'=>'commentForm',
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'type'=>'horizontal',
        'htmlOptions'=>array('class'=>'well'),
         )) ?>

<?php
        echo $form->textFieldRow($model,'author', array('prepend'=>"<i class='icon-user'></i>", )  ); 
        echo $form->textFieldRow($model,'email', array('prepend'=>"<i class='icon-envelope'></i>",  )  ); 
        echo $form->textAreaRow($model,'content', array('class'=>'span8', 'rows'=>5) ); 
        echo $form->textFieldRow($model,'verifyCode', array('prepend'=>'<i class="icon-barcode"></i>',  'placeholder'=>'验证码')); 
 ?>
 
 <?php  if(CCaptcha::checkRequirements()) { ?>
	<div class="control-group"><div class='controls'>
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一张', 'buttonOptions'=>array('style'=>'display:inline-block;margin:0px 5px;'))); ?>
	</div></div>
	<?php } ?>
 <div class='control-group'><div class='controls'>
<?php    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交 ', 'htmlOptions'=>array('class'=>'span2') )); ?>
</div></div>

<?php $this->endWidget(); ?>
</div>
</div>
</div>
