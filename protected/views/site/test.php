<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

echo $tt;

?>

<div></div>
<div class="accordion" id="accordion2">
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
国土问题
</a>
</div>
<div id="collapseOne" class="accordion-body collapse in">
<div class="accordion-inner">
前一段时间一个段子说，某国的网民在因国土问题与中国网民争吵时说，全是敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词敏感词。
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
门票问题
</a>
</div>
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner">
目前，中国半数5A级景区门票达到100元，黄山门票10年来由80元涨至230元。山东曲阜称，与同类景区相比收费较低，仅收150元，不涨票价就丢身价。曲阜的孔庙、孔府和孔林，年收入1.5亿元左右，全部上缴了地方财政，但景区维护成本从未公开。
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
超生罚款
</a>
</div>
<div id="collapseThree" class="accordion-body collapse">
<div class="accordion-inner">
学者杨支柱因生二胎被取消公职，并罚款24万余元。他称，计生罚款以前直接叫超生罚款，入世后改成“社会抚养费”。根据9省市超生罚款的平均数，全国31个省市每年征收的超生罚款可高达279亿元。其中大城市将该收入上缴财政，而地方则分配混乱，部分罚款去向成谜。
</div>
</div>
</div>
</div>


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
