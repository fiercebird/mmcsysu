<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 后台管理';
$this->breadcrumbs=array(
	'后台管理',
);
$token=UserIdentity::createLoginToken();
$verifyCode = strtolower($this->createAction('captcha')->verifyCode);  
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
<input name="LoginForm[token]" id="LoginForm_token"  style="display:none;visibility:collapse" value="<?php echo $token;?>" >
<?php
        echo $form->textFieldRow($model,'username', array('prepend'=>"<i class='icon-user'></i>", 'placeholder'=>'用户名')  ); 
        echo '<div class="control-group"><label class="control-label required" for="Origin_password">密码 <span class="required">*</span></label><div class="controls"><div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input placeholder="密码" name="Origin[password]" id="Origin_password" type="password"></div><span class="help-inline error" id="Origin_password_em_" style="display: none"></span></div></div>';
        echo $form->textFieldRow($model,'verifyCode', array('prepend'=>'<i class="icon-barcode"></i>',  'placeholder'=>'验证码',  'onkeydown'=>"javascript:keyLogin(event)")); 
        if(CCaptcha::checkRequirements()) { ?>
	<div class="control-group"><div class='controls'>
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一张', 'buttonOptions'=>array('style'=>'display:inline-block;margin:0px 5px;'))); ?>
	</div></div>
	<?php } 
        echo $form->checkBoxRow($model,'rememberMe' );  ?>
</fieldset>
<div class='control-group'><div class='controls'>
<?php    $this->widget('bootstrap.widgets.TbButton', array(  'type'=>'primary', 'label'=>'登录', 'htmlOptions'=>array('class'=>'span2', 'id'=>'loginBtn', 'name'=>'loginForm') )); ?>
</div></div>
<?php   
        echo $form->passwordFieldRow($model,'password', array( 'style'=>'display:none; visibility: collapse' )  ); 
        $this->endWidget(); ?>
</div><!-- form -->


<script language='javascript' type="text/javascript">
function keyLogin(event){
   if(event.keyCode==13)  //按下回车键， 则触发登陆按钮
      $("#loginBtn").click(); 
}


var verifyCode='<?php echo $verifyCode; ?>';
var oldHash=0;
for(var i=verifyCode.length-1; i >= 0; --i) 
        oldHash+=verifyCode.charCodeAt(i);
$('#Origin_password').blur(function(){
        var pwd=$(this).attr('value');
        if($.trim(pwd) == "")
        {
                $('#Origin_password').parent().parent().parent().addClass('error');
                $('#Origin_password_em_').removeAttr("style");
                $('#Origin_password_em_').html('密码 不可为空白');
        }else{
                $('#Origin_password').parent().parent().parent().addClass('success');
                $('#Origin_password_em_').attr("style","display:none");
                $('#Origin_password_em_').html('');
        }
      });


$('#loginBtn').bind('click', function(){
      var username=$('#LoginForm_username').attr('value');
      var originPwd=$('#Origin_password').attr('value');
      var verifyCodeValue=$('#LoginForm_verifyCode').attr('value');
      var csrfToken='<?php echo Yii::app()->request->csrfToken; ?>';
      var loginToken=$('#LoginForm_token').attr('value');
      if($.trim(username) == "")
      {
        $('#LoginForm_username').blur();
        return false;
      }
      if($.trim(originPwd) == "")
      {
        $('#Origin_username').blur();
        return false;
      }
      var hash = jQuery('body').data('captcha.hash');
      if (hash == null)
          hash = oldHash;
      else
          hash = hash[1];
      for(var i=verifyCodeValue.length-1, h=0; i >= 0; --i) 
         h+=verifyCodeValue.toLowerCase().charCodeAt(i);
      if(h != hash) {
        $('#LoginForm_verifyCode').blur();
        return false;
      }
      
      $.ajax({
        type:'post',
        url:'<?php echo Yii::app()->createUrl('user/getLoginSalt')?>',
        data:{"username":username, "YII_CSRF_TOKEN":csrfToken},
        dataType:'json',
        success:function(resData){
                if(resData.resCode==0){
                var salt=resData.salt;
                var newPwd=CryptoJS.SHA256( salt+CryptoJS.SHA256(salt+originPwd) + loginToken);
                $('#LoginForm_password').attr('value',newPwd);
                $('#Origin_password').attr('value',"");
                $('#loginForm').submit();
                }else{
                        $('#LoginForm_password_em_').removeAttr("style");
                        $('#LoginForm_password_em_').html('用户名或者密码错误!');
                }
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
                var errorMes ="状态: " + textStatus + "\n" + XMLHttpRequest.status  + " : " + XMLHttpRequest.statusText + "\n操作失败: \n" +XMLHttpRequest.responseText;
                alert(errorMes);        
        }
      });
});


</script>
