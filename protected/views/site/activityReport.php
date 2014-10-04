<?php


$this->pageTitle=Yii::app()->name . ' - 活动报道';
$this->breadcrumbs=array(
           '多媒体风采'=>array('site/teamStyle'),
           '活动报道',
);


$reportList="";

foreach($reports as $report)
{
        $reportList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$report->article_id, 'cate'=>Category::$CATE_ACTIVITY_REPORT)) . '">'. $report->title .'</a></div><div class="ruleText">'. strip_tags($report->content) .'......</div></div>';

}



?>

<div  class='row-fluid rightContent'>
<?php  echo $reportList; ?>
</div>

