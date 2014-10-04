<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-27
 *Function:
 *  
 */

switch($cate)
{
        case Category::$CATE_SERVICE_INFO:
           $this->pageTitle=Yii::app()->name . ' - 服务信息';
           $this->breadcrumbs=array( '服务信息');
           break;
        case Category::$CATE_REGULATION_RULE:
           $this->pageTitle=Yii::app()->name . ' - 规章制度';
           $this->breadcrumbs=array( '规章制度');
           break;
       case Category::$CATE_TECH_EXPLORE:
           $this->pageTitle=Yii::app()->name . ' - 技术探索';
           $this->breadcrumbs=array( '技术探索');
           break;
       case Category::$CATE_PERFECT_ASSISTANT:
           $this->pageTitle=Yii::app()->name . ' - 多媒体风采';
           $this->breadcrumbs=array('多媒体风采', '优秀助理');
           break;
       case Category::$CATE_ACTIVITY_REPORT:
           $this->pageTitle=Yii::app()->name . ' - 多媒体风采';
           $this->breadcrumbs=array('多媒体风采', '活动报道');
           break;
       case Category::$CATE_WORK_FEELING:
           $this->pageTitle=Yii::app()->name . ' - 多媒体风采';
           $this->breadcrumbs=array('多媒体风采', '工作感想');
           break;

}


?>

<div id='article'>
<?php  if(isset($article)) {   ?>  
	<div class='text-center'><h4><?php echo $article->title; ?></h4> </div>
	<div class='articleInfo'><span>发布方：<?php  echo $article->publisher; ?></span><span>发布时间：<?php echo substr($article->update_time, 0, -3); ?></span></div>
        <hr class='hr4'/>
        <div id="article-main"><?php echo $article->content; ?></div>

<?php } ?>
</div>



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
