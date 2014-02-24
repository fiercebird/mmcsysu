<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-20 
 *Function:
 *  
 */

$this->pageTitle=Yii::app()->name . ' - 联系人设置';
$this->breadcrumbs=array(
           '首页管理',           
           '联系人设置',
);
?>




<?php $this->widget('ext.kindeditor.KindEditorWidget',array(
         'id'=>'contactTel',   //Textarea id
         // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
         'items' => array(
            'width'=>'400px',
            'height'=>'300px',
            'themeType'=>'simple',
            'allowImageUpload'=>false,
            'allowFileManager'=>false,
            'items'=>array(
               'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
               'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
               'justifyright', 'insertorderedlist','insertunorderedlist',),
            ),
         )); ?> 

<?php echo CHtml::beginForm('', 'post', array('id'=>'contactTelForm', 'name'=>'contactTelForm')); ?>

<fieldset><legend><strong>联系人设置</strong></legend>
<div class='row-fluid'>
<div class='span6'><?php echo CHtml::textArea('contactTel',  (isset($data->content)?$data->content:"") , array('style'=>'width:400px;height:300px', 'id'=>'contactTel'));  ?></div>
</div>
</fieldset>
<br />
<div class='control-group'><div class='controls'>
<?php    
$this->widget('bootstrap.widgets.TbButton', array( 'buttonType'=>'submit', 'type'=>'primary', 'label'=> '保存', 'htmlOptions'=>array('class'=>'span2 offset2') )); 
?>
</div></div>
<?php echo CHtml::endForm(); ?>
<br />

<?php   
   if(Yii::app()->user->hasFlash('error'))
   echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';
   if(Yii::app()->user->hasFlash('success'))
   echo '<div class="flash-success mesFade">' . Yii::app()->user->getFlash('success') . '</div>';
?>




<script language="javascript" type="text/javascript">
$('#collapse1').addClass('in');
</script>
