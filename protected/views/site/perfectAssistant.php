<?php

$this->pageTitle=Yii::app()->name . ' - 优秀助理';
$this->breadcrumbs=array(
           '多媒体风采'=>array('site/teamStyle'),
           '优秀助理',
);

$assistantList="";

foreach($assistants as $assistant)
{
        $assistantList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$assistant->article_id, 'cate'=>Category::$CATE_PERFECT_ASSISTANT)) . '">'. $assistant->title .'</a></div><div class="ruleText">'. strip_tags($assistant->content) .'......</div></div>';
}
?>

<div  class='row-fluid rightContent'>
<?php  echo $assistantList; ?>
</div>

