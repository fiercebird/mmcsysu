<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-12
 *Function:
 *  
 */

/* @var $this Controller */ ?>

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

	  <?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div>

	<div class='row-fluid'>
		<div class="logoBE"><div id="leftLogoBE"></div></div>
		<div class="logoBE"><div id="centerLogoBE"></div></div>
		<div class="logoBE"><div id="rightLogoBE"></div></div>
	</div><!-- header -->
        <div class='row-fluid'>
        <div class='breadcrumbsLeft'>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
	                'homeLink'=>CHtml::link('首页', '?r=site/admin'),
                        'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
        </div>
        <div class='breadcrumbsRight'>
        <div class='pull-right'>
        <span class="color-blue"><i class='icon-user' ></i>&ensp;当前用户:&ensp;<?php echo Yii::app()->user->name; ?></span>
        <span><a class="btn btn-primary" >设置</a></span>
        <span><a class="btn btn-warning" href="<?php echo Yii::app()->createUrl('site/logout') ?>" >退出</a></span>
        </div>
        </div>
        </div>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->
</body>
</html>


<script language='javascript'  type='text/javascript' />
//左侧导航栏目自适应右侧内容高度
$(document).ready(function(){
        var height=$('div.leftNavbar').next().height();
        if(height>600){
                $('div.leftNavbar ul').css('height',height);
        }
});

</script>
