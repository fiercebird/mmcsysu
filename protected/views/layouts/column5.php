<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-01-01
 *Function:
 *  
 */

/* @var $this Controller */

?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
	<div class='leftNavbar' >

	<?php $this->widget('bootstrap.widgets.TbMenu', array(
	         'id'=>'service',
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'服务列表', 'icon'=>'list'),
                        array('label'=>'周报表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'月报表','url'=>array(''),'icon'=>'list-alt'),
                        array('label'=>'服务调查表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'服务统计表','url'=>array(''), 'icon'=>'list-alt'),
                        array('label'=>'表格下载','url'=>array(''), 'icon'=>'list-alt'),
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


