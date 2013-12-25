<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
	<div class='leftNavbar' >

	<?php $this->widget('bootstrap.widgets.TbMenu', array(
	         'id'=>'classroomIntroduce',
                 'type'=>'list',
		 'items'=>array(
                        array('label'=>'课室介绍', 'icon'=>'th-large'),
                        array('label'=>'东校区','url'=>array('/site/page', 'view'=>'classroom.east'), 'icon'=>'th'),
                        array('label'=>'南校区','url'=>array('/site/page', 'view'=>'classroom.south'), 'icon'=>'th'),
                        array('label'=>'珠海校区','url'=>array('/site/page', 'view'=>'classroom.zhuhai'),'icon'=>'th'),
                        array('label'=>'北校区','url'=>array('/site/page', 'view'=>'classroom.north'), 'icon'=>'th'),
                        array('label'=>'校区交通', 'icon'=>'plane'),
                        array('label'=>'购票信息','url'=>array('/site/page', 'view'=>'ticketInfo'), 'icon'=>'th-list'),
                        array('label'=>'校车时刻表','url'=>array('/site/page', 'view'=>'campusBus'), 'icon'=>'time'),
                        array('label'=>'地图查询', 'icon'=>'search'),
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


