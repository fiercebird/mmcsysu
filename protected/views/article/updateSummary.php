<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-26
 *Function:
 *  
 */


if($model->publisher == Yii::app()->params['SiteSpecialArticle'])
        $legend = '特色课室概况';
else
        $legend = '课室介绍概况';

$this->pageTitle=Yii::app()->name . ' - ' . $legend;
$this->breadcrumbs=array(
           '课室管理',           
           $legend,
);
?>



<?php   
   if(Yii::app()->user->hasFlash('error'))
   echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';
   if(Yii::app()->user->hasFlash('success'))
   echo '<div class="flash-success mesFade">' . Yii::app()->user->getFlash('success') . '</div>';
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
<?php
echo $form->textFieldRow($model,'title', array('class'=>'span9') ); 
echo $form->labelEx($model,'content');
echo $form->textArea($model,'content',  array('id'=>'serviceEditor','style'=>'height:500px;width:750px;')); 
echo $form->error($model,'content');
?>
<br />
</fieldset>
<div class='control-group'><div class='controls'>
<?php    
$this->widget('bootstrap.widgets.TbButton', array( 'buttonType'=>'submit', 'type'=>'primary', 'label'=> '保存', 'htmlOptions'=>array('class'=>'span2 offset2', 'id'=>'finishBtn') )); 
?>
</div></div>
<?php   $this->endWidget(); ?>



<script language="javascript" type="text/javascript">
$('#collapse2').addClass('in');
</script>
