<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
            'items'=>array(
               'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
               'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
               'justifyright', 'insertorderedlist','insertunorderedlist', '|',
               'emoticons', 'image', 'link',),
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

<fieldset><legend><strong><?php echo '新增报表'; ?> </strong></legend>

<div class='row-fluid'>
    <div class='span5'><?php  echo $form->dropDownListRow($model,'type', MisService::getTypeList());  ?></div>

</div>
    <p>*上传文件时，请严格填写文件说明：【校区】【时间】【报表名】，如：东校区2012年4月多媒体课室教学设备与服务情况月报表</p>
    <input type="button" id="insertfile" value="选择文件"> &nbsp;
    <input type="text" style="width:500px;" name="MisService[content]" id="MisService_content" value="" readonly="true" />
	<br>
    <?php echo $form->error($model,'content'); ?>
<br />

</fieldset>

<div class='control-group'><div class='controls'>
<?php    
$this->widget('bootstrap.widgets.TbButton', array( 'buttonType'=>'submit', 'type'=>'primary', 'label' => '创建', 'htmlOptions'=>array('class'=>'span2 offset2', 'id'=>'finishBtn') )); 
?>
</div></div>
<?php   $this->endWidget(); 
   if(Yii::app()->user->hasFlash('error'))
   echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';
   

?>

<script>
			KindEditor.ready(function(K) {
				var editor = K.editor({
					'allowFileManager' : 'true',
					'langType':'zh_CN'
				});
				K('#insertfile').click(function() {
					editor.loadPlugin('insertfile', function() {
						editor.plugin.fileDialog({
							fileUrl : K('#MisService_content').val(),
							clickFn : function(url, title){
								var a = '<a href="' + url +'">' + title +'</a>';
								K('#MisService_content').val(a);
								editor.hideDialog();
							}
						});
					});
				});
			});
                        
$('#collapse3').addClass('in');


		
</script>
