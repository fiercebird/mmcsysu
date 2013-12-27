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

foreach($rules as $rule)
{
	$ruleList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("site/article",array('id'=>$rule->article_id, 'cate'=>'rule')) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';

}



?>

<div class='row-fluid'><img src="<?php echo Yii::app()->baseUrl . '/images/rule_topban.png'; ?>"/></div>
<div id='rule' class='row-fluid'>
<?php  echo $ruleList; ?>
</div>
