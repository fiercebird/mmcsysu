<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-29
 *Function:
 *  
 */

/* @var $this Controller */

?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
	<div class='leftNavbar' >

	<?php $this->widget('bootstrap.widgets.TbMenu', array(
	         'id'=>'teamStyle',
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'多媒体风采', 'icon'=>'th-large'),
                        array('label'=>'优秀助理','url'=>array('/site/page', 'view'=>'classroom.east'), 'icon'=>'th'),
                        array('label'=>'工作感想','url'=>array('/site/page', 'view'=>'classroom.zhuhai'),'icon'=>'th'),
                        array('label'=>'活动报道','url'=>array('/site/page', 'view'=>'classroom.north'), 'icon'=>'th'),
                    ),
		 )); ?>
	</div>
	<div  class='rightContent'>
                 <div id='content'>
                <?php echo $content; ?>
                </div>
	</div>
</div>

<?php $this->endContent(); ?>


