<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <?php Yii::app()->bootstrap->register(); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body id='body1'>

        <div class="container" id="page">

            <div id="header">
                <div id="logo">
                </div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => '首页', 'url' => array('/site/index')),
                        array('label' => '课室介绍', 'url' => array('/site/introduce')),
                        array('label' => '特色课室', 'url' => array('/site/special')),
                        array('label' => '服务报表', 'url' => array('/site/serviceList')),
                        array('label' => '规章制度', 'url' => array('/site/rule')),
                        array('label' => '技术探索', 'url' => array('/site/techExplore')),
                        array('label' => '多媒体风采', 'url' => array('/site/teamStyle')),
                        array('label' => '意见收集', 'url' => array('/site/feedback')),
                        array('label' => '内部管理', 'url' => array('/site/login')),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <div style="clear: both;">
                <?php echo $content; ?>
            </div>


            <div class="clear"></div>

            <div id="footer">
                Copyright&copy; 2011-<?php echo date('Y'); ?> 『中山大学东校区多媒体工作室 』 All Rights Reserved. <br />
                网站规划与技术支持：中山大学东校区网络中心多媒体网站组<br />
                建议使用IE9-10、Chrome、Firefox、Safari等现代浏览器
            </div><!-- footer -->

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
