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
<?php
if(!empty($comments))
{
       echo '<h4>&emsp;用户留言</h4><hr />';
       $this->widget('zii.widgets.CListView', array(
                       'dataProvider'=>$comments,
                       'pager'=>array('class'=>'CLinkPager',
                          'header'=>'', 
                          'firstPageLabel'=>'首页', 
                          'lastPageLabel'=>'末页',
                          'prevPageLabel'=>'上一页',
                          'nextPageLabel'=>'下一页',
                          ),
                       'itemView'=>'/comment/_view',
               )); 
}
?>
<br />

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'commentForm',
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
                'afterValidate'=>'js:afterValidate',
	),
        'type'=>'horizontal',
        'htmlOptions'=>array('class'=>'well'),
         )) ?>
<fieldset><legend>意见收集</legend>
<?php
        echo $form->textFieldRow($model,'author', array('prepend'=>"<i class='icon-user'></i>", )  ); 
        echo $form->textFieldRow($model,'email', array('prepend'=>"<i class='icon-envelope'></i>",  )  ); 
        echo $form->textAreaRow($model,'content', array('class'=>'span8', 'rows'=>5) ); 
        echo $form->textFieldRow($model,'verifyCode', array('prepend'=>'<i class="icon-barcode"></i>',  'placeholder'=>'验证码')); 
 ?>
</fieldset> 
 <?php  if(CCaptcha::checkRequirements()) { ?>
	<div class="control-group"><div class='controls'>
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一张', 'buttonOptions'=>array('style'=>'display:inline-block;margin:0px 5px;'))); ?>
	</div></div>
	<?php } ?>
 <div class='control-group'><div class='controls'>
<?php  

$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交 ', 'htmlOptions'=>array('class'=>'span2') )); ?>

</div></div>

<?php $this->endWidget(); ?>

<script language='javascript' type='text/javascript'>
function afterValidate(form, data, hasError){
   if (!hasError) {
      $.ajax({
        url: '<?php Yii::app()->createUrl("site/feedback");?>',
        type: 'POST',
        dataType: 'json',
        data:$("#commentForm").serialize()
        })
      .done(function ( response ) {
            if(response.resCode)
                alert(response.resMes);
            else
                alert('感谢您的宝贵意见！');
            $('#commentForm')[0].reset();
            $('#yw2_button').click();
            })
      .fail(function ( xhr, status ) {
            alert(xhr.status+':'+xhr.statusText);
      });
      return false;
   }
}

</script>
