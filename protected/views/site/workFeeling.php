<?php

$this->pageTitle=Yii::app()->name . ' - 工作感想';
$this->breadcrumbs=array(
           '多媒体风采'=>array('site/teamStyle'),
           '工作感想',
);

$feelingList="";

foreach($feelings as $feeling)
{
        $feelingList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$feeling->article_id, 'cate'=>Category::$CATE_WORK_FEELING)) . '">'. $feeling->title .'</a></div><div class="ruleText">'. strip_tags($feeling->content) .'......</div></div>';

}



?>

<div class='row-fluid rightContent'>
<?php  echo $feelingList; ?>
</div>

