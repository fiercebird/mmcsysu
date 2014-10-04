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
    if($classroom->display_order >0)
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
			<div class='text-center'><h4  id='articleTitle'><?php echo $siteSpecialArticle->title; ?></h4> </div>
			<hr class='hr4'/>
			<div id='articleContent'><?php echo $siteSpecialArticle->content; ?></div>

		<?php } ?>
	</div>
</div>

<script language="javascript" type="text/javascript"> 
	$('#specialClassroom li a').click(function(){
		var id=$(this).attr('id');
		$.ajax({
                        url:"<?php echo Yii::app()->createUrl('site/getSpecialRoom');?>",
			method:'post',
			data:{"id":id },
			dataType: 'json',
			success:function(response)
                        {
                            if(response.article!=null){
                                $('#articleTitle').html(response.article.title);
                                $('#articleContent').html(response.article.content);
                                var height=$('div.leftNavbar').next().height();//自适应高度:w
                                if(height>500){
                                 $('div.leftNavbar ul').css('height',height);
                                 }
                             }
			},
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('错误码：'+ XMLHttpRequest.status);
                                //alert(XMLHttpRequest.readyState);
                                //alert(textStatus);
                        },
		});
	});

</script>
