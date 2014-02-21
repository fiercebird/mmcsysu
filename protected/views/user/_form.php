<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-20 
 *Function:
 *  
 */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sha256.js',CClientScript::POS_HEAD);
$isUpdate=0;
if($model->isNewRecord)
{
        $label = '创建';
        $legend = '创建用户';
        
}else{
        $label='保存';
        $legend = '保存用户';
        $isUpdate=1;
}
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'userForm',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'type'=>'horizontal',
        'htmlOptions'=>array('class'=>'well'),
        )); 
echo '<fieldset><legend><strong>' . $legend . '</strong></legend><div class="row"><div class="span6">';
echo $form->dropDownListRow($model,'campus_id', Dictionary::items(Yii::app()->params['dictTypeCampus']) ); 
echo $form->textFieldRow($model,'username' ); 
echo $form->passwordField($model,'password', array( 'style'=>'display:none; visibility: collapse' )  ); 
echo '<div class="control-group"><label class="control-label required" for="Origin_password">初始密码 <span class="required">*</span></label><div class="controls"><input  name="Origin[password]" id="Origin_password" type="password"><span class="help-inline error" id="Origin_password_em_" style="display: none"></span></div></div>';
echo '<div class="control-group"><label class="control-label required" for="Confirm_password">确认密码 <span class="required">*</span></label><div class="controls"><input name="Confirm[password]" id="Confirm_password" type="password"><span class="help-inline error" id="Confirm_password_em_" style="display: none"></span></div></div>';
echo '</div><div class="span6">' . $form->checkBoxListRow($model,'authority', Dictionary::items(Yii::app()->params['dictTypeModule']) ) . '</div><div>';
?>
</fieldset>
 <div class='control-group'><div class='controls'>
<?php    
        $this->widget('bootstrap.widgets.TbButton', array(  'type'=>'primary', 'label'=> $label, 'htmlOptions'=>array('class'=>'span2', 'id'=>'userFormBtn') )); 
        if(!$model->isNewRecord)
                echo '<a class="btn btn-info span2" href="' . Yii::app()->request->urlReferrer . '">返回</a>';
 ?>
</div></div>
<?php   $this->endWidget(); 
if(Yii::app()->user->hasFlash('error'))
    echo '<div class="flash-error mesFade">' . Yii::app()->user->getFlash('error') . '</div>';
?>

<script language="javascript" type="text/javascript">
$('#collapse8').addClass('in');
var isUpdate=<?php echo $isUpdate;?>;
var auth=<?php echo $model->authority; ?>;
var pwd="<?php echo $model->password; ?>";
if(isUpdate){
if(auth!=null && auth!=0){
   var i=0;
   var mask=2;
   while( i<22){
      if(auth & mask)
         $('#User_authority_'+i).attr('checked','checked');
      mask=mask<<1;
      i++;
   }
}
var pwdSign = pwd.substr(0,8)+pwd.substr(-4);
 $('#Origin_password').attr('value', pwdSign);
 $('#Confirm_password').attr('value', pwdSign);
}


$('#Origin_password').blur(function(){
        var pwd=$(this).attr('value');
        if($.trim(pwd) == "")
        {
                $('#Origin_password').parent().parent().addClass('error');
                $('#Origin_password_em_').removeAttr("style");
                $('#Origin_password_em_').html('初始密码 不可为空白');
                return false;
        }else{
                $('#Origin_password').parent().parent().addClass('success');
                $('#Origin_password_em_').attr("style","display:none");
                $('#Origin_password_em_').html('');
                return true;
        }
      });

$('#Confirm_password').blur(function(){
        var originPwd=$.trim($('#Origin_password').attr('value'));
        var pwd=$.trim($(this).attr('value'));
        if( pwd  == "")
        {
                $('#Confirm_password').parent().parent().addClass('error');
                $('#Confirm_password_em_').removeAttr("style");
                $('#Confirm_password_em_').html('确认密码 不可为空白');
        }else if(pwd!=originPwd){
                $('#Confirm_password').parent().parent().addClass('error');
                $('#Confirm_password_em_').removeAttr("style");
                $('#Confirm_password_em_').html('确认密码 不等于初始密码');
        }else{
                $('#Confirm_password').parent().parent().addClass('success');
                $('#Confirm_password_em_').attr("style","display:none");
                $('#Confirm_password_em_').html('');
        }
      });


$('#userFormBtn').click(function(){
      var csrfToken='<?php echo Yii::app()->request->csrfToken; ?>';
      var username=$.trim($('#User_username').attr('value'));
      var confirmPwd=$.trim($('#Confirm_password').attr('value'));
      var originPwd=$.trim($('#Origin_password').attr('value'));
      $('#User_username').blur();
      if( username == "")
                return false;
      $('#Origin_password').blur();
      if( originPwd == "")
                return false;
      $('#Confirm_password').blur();
      if(confirmPwd == "" || confirmPwd != originPwd)
                return false;
      if(isUpdate && originPwd == pwdSign){ //没有修改密码的话则直接提交
                $('#userForm').submit();
                return true;
      }
      $.ajax({
        type:'post',
        url:'<?php echo Yii::app()->createUrl('user/createNewSalt')?>',
        data:{"YII_CSRF_TOKEN":csrfToken},
        dataType:'json',
        success:function(resData){
                var salt=resData.salt;
                var newPwd=salt+CryptoJS.SHA256(salt+originPwd);
                $('#User_password').attr('value',newPwd);
                $('#Origin_password').attr('value',"");
                $('#Confirm_password').attr('value',"");
                $('#userForm').submit();
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
                var errorMes ="状态: " + textStatus + "\n" + XMLHttpRequest.status  + " : " + XMLHttpRequest.statusText + "\n操作失败: \n" +XMLHttpRequest.responseText;
                alert(errorMes);        
        }
      });
      });
</script>
