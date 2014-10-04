<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-24
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 课室介绍';
$this->breadcrumbs=array(
           '课室介绍',
);

?>

<?php  if(isset($siteIntroduceArticle)) {   ?>  
	<div class='text-center'><h4><?php echo $siteIntroduceArticle->title; ?></h4> </div>
	<hr class='hr4'/>
	<div><?php echo $siteIntroduceArticle->content; ?></div>

<?php } ?>


<script language='javascript'  type='text/javascript' />
$(document).ready(function(){
        //替换table样式，改为横向可滑动
        $('#content table').each(function(){
                var innerHtml=$(this).html();
                $(this).before('<div class="mytable1" style="width:100%;max-height:600px;overflow-x:auto;overflow-y:auto;"><table class="items table table-striped table-bordered table-condensed">'+ innerHtml +'</table></div>');
                $(this).remove();
        });
       });

</script>
