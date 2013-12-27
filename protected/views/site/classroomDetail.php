<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-27
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 课室介绍';
$breadcrumbs=array(
      '课室介绍'=>array('site/introduce'),
      );
switch($bid)
{
        case '1':
           array_push($breadcrumbs, '东校区');
           break;
        case '2':
           array_push($breadcrumbs, '南校区');
           break;
        case '3':
           array_push($breadcrumbs, '珠海校区');
           break;
        case '4':
           array_push($breadcrumbs, '北校区');
           break;

}
$this->breadcrumbs=$breadcrumbs;

echo $classroom;

?>

