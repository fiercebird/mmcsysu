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


$cid = 0;
switch($model->category_id)
{
   case Category::$CATE_SPECIAL_CLASSROOM:
      $cid = 2;
      break;
   case Category::$CATE_REGULATION_RULE:
      $cid = 4;
      break;
   case Category::$CATE_SERVICE_INFO:
      $cid = 1;
      break;
   case Category::$CATE_TECH_EXPLORE:
      $cid = 5;
      break;
   case Category::$CATE_PERFECT_ASSISTANT:
      $cid = 6;
      break;
   case Category::$CATE_WORK_FEELING:
      $cid = 6;
      break;
   case Category::$CATE_ACTIVITY_REPORT:
      $cid = 6;
      break;
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
<?php if($model->category_id != Category::$CATE_SPECIAL_CLASSROOM){?>
<div class='row-fluid'>
<div class='span5'><?php  echo $form->dropDownListRow($model,'campus_id', Dictionary::items(Yii::app()->params['dictTypeCampus']));  ?></div>
<div class='span6'><?php echo $form->textFieldRow($model,'publisher' ,array('class'=>'inline') ); ?></div>
</div>
<?php } ?>
<?php
echo $form->textFieldRow($model,'title', array('class'=>'span9') ); 
echo $form->labelEx($model,'content');
echo $form->textArea($model,'content',  array('id'=>'serviceEditor','style'=>'height:500px;width:750px;')); 
echo $form->error($model,'content');
?>
<br />
<?php 
 if($model->category_id != Category::$CATE_SPECIAL_CLASSROOM)
        echo $form->dropDownListRow($model,'status', Dictionary::items(Yii::app()->params['dictTypeArticle'])); 
?>
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
var cid = <?php echo $cid; ?>;
$('#collapse'+cid).addClass('in');
</script>
