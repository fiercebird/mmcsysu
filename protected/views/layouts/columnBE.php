<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-12
 *Function:
 *  
 */

/* @var $this Controller */
Yii::app()->clientScript->registerScript('myHideEffect','$(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000);', CClientScript::POS_READY);

$auth = Yii::app()->user->auth;
?>
<?php $this->beginContent('//layouts/backend'); ?>

<div class="row-fluid">
<div class='leftNavbarBE'>
<div class="accordion" id="accordion1">
<?php 
if($auth & ModuleAuth::MMC_HOMEPAGE_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1"><i class="icon-home"></i>&emsp;首页管理</a>
</div>
<div id="collapse1" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'添加服务信息','url'=>array('article/createArticle', 'cate'=>Category::$CATE_SERVICE_NEWS), 'icon'=>'plus'),
                        array('label'=>'管理服务信息','url'=>array('article/manageArticle', 'cate'=>Category::$CATE_SERVICE_NEWS), 'icon'=>'list-alt'),
                        array('label'=>'联系我们','url'=>array(''),'icon'=>'retweet'),
                    ),
		 )); ?>

        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_SPECIAL_CLASSROOM){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse2"><i class="icon-star"></i>&emsp;特色课室</a>
</div>
<div id="collapse2" class="accordion-body collapse ">
        <div class="accordion-inner">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'新增特色课室','url'=>array('article/createArticle','cate'=>Category::$CATE_SERVICE_NEWS), 'icon'=>'plus'),
                        array('label'=>'编辑特色课室','url'=>array(''),'icon'=>'wrench'),
                    ),
		 )); ?>
        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_SERVICE_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse3"><i class="icon-list"></i>&emsp;服务列表</a>
</div>
<div id="collapse3" class="accordion-body collapse ">
        <div class="accordion-inner">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'周报表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'月报表','url'=>array(''),'icon'=>'list-alt'),
                        array('label'=>'服务调查表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'服务统计表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'表格下载','url'=>array(''), 'icon'=>'list-alt'),
                    ),
		 )); ?>
        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_RULE_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse4"><i class="icon-tasks"></i>&emsp;规章制度</a>
</div>
<div id="collapse4" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'新增规章制度','url'=>array('article/createArticle','cate'=>Category::$CATE_REGULATION_RULE), 'icon'=>'plus'),
                        array('label'=>'编辑规章制度','url'=>array('article/manageArticle', 'cate'=>Category::$CATE_REGULATION_RULE), 'icon'=>'wrench'),
                    ),
		 )); ?>

        
        
        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_TECH_EXPLORE){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse5"><i class="icon-eye-open"></i>&emsp;技术探索</a>
</div>
<div id="collapse5" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'新增技术文章','url'=>array('article/createArticle','cate'=>Category::$CATE_TECH_EXPLORE), 'icon'=>'plus'),
                        array('label'=>'编辑技术探索','url'=>array('article/manageArticle', 'cate'=>Category::$CATE_TECH_EXPLORE),'icon'=>'wrench'),
                    ),
		 )); ?>

        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_TEAMSTYLE){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse6"><i class="icon-flag"></i>&emsp;多媒体风采</a>
</div>
<div id="collapse6" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'优秀助理','url'=>array(''), 'icon'=>'thumbs-up'),
                        array('label'=>'工作感想','url'=>array(''), 'icon'=>'pencil'),
                        array('label'=>'活动报道','url'=>array(''), 'icon'=>'bullhorn'),
                  ),
		 )); ?>

        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_COMMENT_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse7"><i class="icon-comment"></i>&emsp;评论管理</a>
</div>
<div id="collapse7" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'审核评论','url'=>array(''), 'icon'=>'filter'),
                        array('label'=>'管理评论','url'=>array(''),'icon'=>'wrench'),
                    ),
		 )); ?>

        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_USER_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse8"><i class="icon-user"></i>&emsp;用户管理</a>
</div>
<div id="collapse8" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'添加用户','url'=>array('user/createUser'), 'icon'=>'plus'),
                        array('label'=>'管理用户','url'=>array('user/manageUser'),'icon'=>'th'),
                    ),
		 )); ?>

        </div>
</div>
</div>
<?php }
if($auth & ModuleAuth::MMC_TRASH_ADMIN){
?>
<div class="accordion-group">
<div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse9"><i class="icon-trash"></i>&emsp;回收站</a>
</div>
<div id="collapse9" class="accordion-body collapse ">
        <div class="accordion-inner">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'文章回收站','url'=>array(''), 'icon'=>'th-list'),
                        array('label'=>'评论回收站','url'=>array(''),'icon'=>'th'),
                    ),
		 )); ?>

        </div>
</div>
</div>
<?php } ?>

</div>
	</div>

        <div  class='rightContentBE'>
                <div class='row-fluid'>
                <?php echo $content; ?>
                </div>
	</div>
</div>

<?php $this->endContent(); ?>


