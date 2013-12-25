<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->


        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	  <?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><img  src="<?php echo Yii::app()->baseUrl.'/images/header.jpg';  ?>"  /> </div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/site/index')),
				array('label'=>'课室介绍', 'url'=>array('/site/introduce')),
				array('label'=>'特色课室', 'url'=>array('/site/special')),
				array('label'=>'服务列表', 'url'=>array('/site/service')),
				array('label'=>'规章制度', 'url'=>array('/site/rule')),
				array('label'=>'技术探索', 'url'=>array('/site/test')),
				array('label'=>'多媒体风采', 'url'=>array('/site/index')),
				array('label'=>'意见收集', 'url'=>array('/site/index')),
				array('label'=>'内部管理', 'url'=>array('/site/index')),
			//	array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			//	array('label'=>'Contact', 'url'=>array('/site/contact')),
			//	array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			//	array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		电话：84111059&nbsp;|&nbsp;84113871 &#12288;  邮件:kjccxba@mail.sysu.edu.cn<br />
		版权所有 &copy; <?php echo date('Y'); ?>&#12288; 中山大学技术转移中心&#12288;  粤ICP备05008892号<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>


<!--
左侧导航栏目自适应右侧内容高度
-->

<script language='javascript'  type='text/javascript' />
$(document).ready(function(){
        var height=$('div.leftNavbar').next().height();
        $('div.leftNavbar ul').css('height',height);
});
</script>
