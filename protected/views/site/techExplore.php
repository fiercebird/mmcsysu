<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-23
 *Function:
 *  
 */



$this->pageTitle=Yii::app()->name . ' - 技术探索';
$this->breadcrumbs=array(
           '技术探索',
);

$ruleList="";
$count = 0;
foreach($dataProvider as $rule)
{
    if($count != count($dataProvider)-1)
	$ruleList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$rule->article_id, 'cate'=>Category::$CATE_TECH_EXPLORE)) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';
    else
        $ruleList.='<div class="ruleItemNoBorder"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$rule->article_id, 'cate'=>Category::$CATE_TECH_EXPLORE)) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';
    $count++;
}



?>

<div class='row-fluid'><img width="998" style="width:998px" src="<?php echo Yii::app()->baseUrl . '/images/tech_explode.jpg'; ?>"/></div>
<div id='rule' class='row-fluid'>
<?php  echo $ruleList; ?>
</div>
