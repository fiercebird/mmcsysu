<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-20 
 *Function:
 *  
 */

if($model->isNewRecord)
{
   $label = '创建';
   $legend = '创建' . $cate;

}else{
   $label='保存';
   $legend = '更新' . $cate;
   $isUpdate=1;
}





?>

<?php $this->widget('ext.kindeditor.KindEditorWidget',array(
         'id'=>'serviceEditor',   //Textarea id
         // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
         'items' => array(
            'width'=>'auto',
            'height'=>'500px',
            'themeType'=>'simple',
            'allowImageUpload'=>true,
            'allowFileManager'=>true,
          //  'items'=>array(
          //     'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
          //     'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
          //     'justifyright', 'insertorderedlist','insertunorderedlist', '|',
          //     'emoticons', 'image', 'link',),
            ),
         )); ?> 


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
         'id'=>'articleForm',
         'enableClientValidation'=>true,
         'clientOptions'=>array(
            'validateOnSubmit'=>true,
            ),
         'type'=>'horizontal',
         'htmlOptions'=>array('class'=>'well'),
         )); ?>

<fieldset><legend><strong><?php echo  $legend; ?> </strong></legend>
<div class='row-fluid'>
<div class='span5'><?php  echo $form->dropDownListRow($model,'campus_id', Dictionary::items(Yii::app()->params['dictTypeCampus']));  ?></div>
<div class='span6'><?php echo $form->textFieldRow($model,'publisher' ,array('class'=>'inline') ); ?></div>
</div>
<?
echo $form->textFieldRow($model,'title', array('class'=>'span9') ); 
echo $form->labelEx($model,'content');
echo $form->textArea($model,'content',  array('id'=>'serviceEditor','style'=>'height:500px;width:750px;')); 
echo $form->error($model,'content');
?>
<br />
<?php  echo $form->dropDownListRow($model,'status', Dictionary::items(Yii::app()->params['dictTypeArticle']));  ?>
</fieldset>
<div class='control-group'><div class='controls'>
<?php    
$this->widget('bootstrap.widgets.TbButton', array( 'buttonType'=>'submit', 'type'=>'primary', 'label'=> $label, 'htmlOptions'=>array('class'=>'span2 offset2', 'id'=>'finishBtn') )); 
if(!$model->isNewRecord)
   echo '<a class="btn btn-info span2" href="' . Yii::app()->request->urlReferrer . '">返回</a>';
?>
</div></div>
<?php   $this->endWidget(); 
   if(Yii::app()->user->hasFlash('error'))
   echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';
?>



<script language="javascript" type="text/javascript">
$('#collapse1').addClass('in');
</script>
