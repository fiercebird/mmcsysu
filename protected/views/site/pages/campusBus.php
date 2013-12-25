<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-25
 *Function:
 *  
 */



$this->pageTitle=Yii::app()->name . ' - 校车时刻表';
$this->breadcrumbs=array(
           '校区交通',
           '校车时刻表',
);

?>
<div class='row-fluid'>
<div id='tt'></div>
<div id='tt1'></div>
<iframe id='campusBus' name='campusBus' src="http://home3.sysu.edu.cn/zwc/news/news01/39586.htm" width="100%" height="1300" onload="getsome()"></iframe>
</div>




