<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-27
 *Function:
 *  
 */

$cate = 'index';
switch($cate)
{
        case 'index':
           $this->pageTitle=Yii::app()->name . ' - 服务信息';
           $this->breadcrumbs=array( '服务信息');
           break;
        case 'rule':
           $this->pageTitle=Yii::app()->name . ' - 规章制度';
           $this->breadcrumbs=array( '规章制度');
           break;
}


?>

<div id='article'>
<?php  if(isset($article)) {   ?>  
	<div class='text-center'><h4><?php echo $article->title; ?></h4> </div>
	<div class='articleInfo'><span>发布方:<?php  echo $article->publisher; ?></span><span>发布时间:<?php echo substr($article->update_time, 0, -3); ?></span></div>
        <hr class='hr4'/>
	<div><?php  echo $article->content; ?></div>
        <?
        //$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
        //echo $article->content;
        //$this->endWidget();
        ?>
<?php } ?>
</div>



<script language='javascript'  type='text/javascript' />
$(document).ready(function(){
        //替换table样式，改为横向可滑动
        $('#content table').each(function(){
                var innerHtml=$(this).html();
                $(this).before('<div class="mytable1" style="width:100%;max-height:600px;overflow-x:scroll;overflow-y:auto;"><table class="items table table-striped table-bordered table-condensed" style="min-width:1500px;">'+ innerHtml +'</table></div>');
                $(this).remove();
        });
       });

</script>
