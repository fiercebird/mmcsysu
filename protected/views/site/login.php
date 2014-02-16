<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 后台管理';
$this->breadcrumbs=array(
	'后台管理',
);
?>
<div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'loginForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'type'=>'horizontal',
        'htmlOptions'=>array('class'=>'well'),
        )); ?>
<fieldset>
<legend class='text-center'><strong>多媒体信息服务后台管理</strong></legend>
<?php
        echo $form->textFieldRow($model,'username', array('prepend'=>"<i class='icon-user'></i>", 'placeholder'=>'用户名')  ); 
        echo $form->passwordFieldRow($model,'password', array('prepend'=>"<i class='icon-lock'></i>", 'placeholder'=>'密码')  ); 
        echo $form->textFieldRow($model,'verifyCode', array('prepend'=>'<i class="icon-barcode"></i>',  'placeholder'=>'验证码')); 
        if(CCaptcha::checkRequirements()) { ?>
	<div class="control-group"><div class='controls'>
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一张', 'buttonOptions'=>array('style'=>'display:inline-block;margin:0px 5px;'))); ?>
	</div></div>
	<?php } ?>

<?php  echo $form->checkBoxRow($model,'rememberMe' );  ?>

</fieldset>
 <div class='control-group'><div class='controls'>
<?php    $this->widget('bootstrap.widgets.TbButton', array(  'type'=>'primary', 'label'=>'登录', 'htmlOptions'=>array('class'=>'span2', 'id'=>'loginBtn') )); ?>
</div></div>
<?php    $this->endWidget(); ?>
</div><!-- form -->


<script language='javascript' type="text/javascript">
$('#loginBtn').bind('click', function(){
        

        $('#loginForm').submit();
});


</script>
