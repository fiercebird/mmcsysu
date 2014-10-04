<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-23
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 规章制度';
$this->breadcrumbs=array(
           '规章制度',
);

$ruleList="";
$count = 0;
foreach($rules as $rule)
{
    if($count != count($rules)-1)
	$ruleList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$rule->article_id, 'cate'=>Category::$CATE_REGULATION_RULE)) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';
    else
        $ruleList.='<div class="ruleItemNoBorder"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$rule->article_id, 'cate'=>Category::$CATE_REGULATION_RULE)) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';
    $count++;
}



?>

<div class='row-fluid'><img width="998" style="width:998px" src="<?php echo Yii::app()->baseUrl . '/images/rule_topban.png'; ?>"/></div>
<div id='rule' class='row-fluid'>
<?php  echo $ruleList; ?>
</div>
