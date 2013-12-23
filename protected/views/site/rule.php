<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-23
 *Function:
 *  
 */

$ruleList="";
//foreach($rules as $rule)
//{
//	$ruleList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("article/ruleDetail",array('articleId'=>$rule['article_id'])) . '">'. $rule['title'] .'</a></div><div class="RuleText">'.strip_tags($rule['content']).'......</div></div>';
//
//}
//
foreach($rules as $rule)
{
	$ruleList.='<div class="ruleItem"><div class="ruleTitle"><a href="' . Yii::app()->createUrl("article/ruleDetail",array('articleId'=>$rule->article_id)) . '">'. $rule->title .'</a></div><div class="ruleText">'. strip_tags($rule->content) .'......</div></div>';

}



?>

<div class='row-fluid'><img src="<?php echo Yii::app()->baseUrl . '/images/rule_topban.png'; ?>"/></div>
<div id='rule' class='row-fluid'>
<?php  echo $ruleList; ?>
</div>
