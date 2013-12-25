<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-24
 *Function:
 *  
 */


//print_r($classroomItems);

$this->pageTitle=Yii::app()->name . ' - 特色课室';
$this->breadcrumbs=array(
           '特色课室',
);


$item=array();
$item[0]=array('label'=>'特色课室', 'icon'=>'star-empty' );
foreach($classroomItems as $classroom)
{
	$item[$classroom->display_order]=array('label'=>$classroom->item_value, 'url'=>'#', 'linkOptions'=>array('id'=>$classroom->item_key));
}


?>


<div class="row-fluid">
	<div class='leftNavbar' >

	<?php $this->widget('bootstrap.widgets.TbMenu', array(
                 'id'=>'specialClassroom',
		 'type'=>'list',
		 'items'=>$item,
		 )); ?>

	</div>
	<div  class='rightContent'>
		<?php  if(isset($siteSpecialArticle)) {   ?>  
			<div class='text-center'><h4><?php echo $siteSpecialArticle->title; ?></h4> </div>
			<hr class='hr4'/>
			<div><?php echo $siteSpecialArticle->content; ?></div>

		<?php } ?>
	</div>
</div>

<script language="javascript" type="text/javascript"> 
	$('#specialClassroom li a').click(function(){
		var id=$(this).attr('id');
                //alert(id);
                //alert(typeof(id));
		$.ajax({
                        url: 'article/getSpeicalRoom',
			method: 'post',
			dataType: 'json',
			data:'{"articleId":'+ id +'}',
			success:function(response)
			{
			},
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                return ;
                                alert(XMLHttpRequest.status);
                                alert(XMLHttpRequest.readyState);
                                alert(textStatus);
                        },
		});
	});

</script>
