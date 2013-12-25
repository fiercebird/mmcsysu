<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

echo $tt;

?>

<div></div>



<div class="row">
<div class="span12">
Level 1 of column
<div class="row">
<div class="span6">Level 2</div>
<div class="span6">Level 2</div>
</div>
</div>
</div>


<?php $this->widget('bootstrap.widgets.TbMenu', array(
	     'type'=>'list',
	         'items'=>array(
		            array('label'=>'LIST HEADER'),
			            array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
				            array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
					            array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
						            array('label'=>'ANOTHER LIST HEADER'),
							            array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
								            array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
									            array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
										        ),
	 )); ?>


<?php
$gridDataProvider = new CArrayDataProvider(array(
	     array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS'),
	         array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript'),
		     array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML'),
	 ));
?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	 'type'=>'striped bordered condensed text-center',
	 'dataProvider'=>$gridDataProvider,
	 'template'=>"{items}",
	 'columns'=>array(
	    array('name'=>'id', 'header'=>'#'),
	    array('name'=>'firstName', 'header'=>'First name'),
	    array('name'=>'lastName', 'header'=>'Last name'),
	    array('name'=>'language', 'header'=>'Language'),
	   // array(
	 //      'class'=>'bootstrap.widgets.TbButtonColumn',
	   //    'htmlOptions'=>array('style'=>'width: 50px'),
	     //  ),
	    ),
	 )); ?>








<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>



<?php $this->widget('bootstrap.widgets.TbButton', array(
	     'label'=>'Primary',
	         'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		     'size'=>'large', // null, 'large', 'small' or 'mini'
	 )); ?>
