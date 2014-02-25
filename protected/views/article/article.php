<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-27
 *Function:
 *  
 */

$cid = 0;
switch($article->category_id)
{
   case Category::$CATE_SPECIAL_CLASSROOM:
      $cid = 2;
      break;
   case Category::$CATE_REGULATION_RULE:
      $cid = 4;
      break;
   case Category::$CATE_SERVICE_INFO:
      $cid = 1;
      break;
   case Category::$CATE_TECH_EXPLORE:
      $cid = 5;
      break;
}

$cate = Dictionary::item(Yii::app()->params['dictTypeCategory'], $article->category_id);
$prev = $cate;
if($article->category_id == Category::$CATE_SERVICE_INFO)
        $prev = '首页管理';
$this->pageTitle=Yii::app()->name . ' - ' . $cate;
$this->breadcrumbs=array(
	$prev,
	'管理' . $cate,
);




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
var cid = <?php echo $cid; ?>;
$('#collapse'+cid).addClass('in');


$(document).ready(function(){
        //替换table样式，改为横向可滑动
        $('#content table').each(function(){
                var innerHtml=$(this).html();
                $(this).before('<div class="mytable1" style="width:100%;max-height:600px;overflow-x:scroll;overflow-y:auto;"><table class="items table table-striped table-bordered table-condensed" style="min-width:1500px;">'+ innerHtml +'</table></div>');
                $(this).remove();
        });
       });

</script>
