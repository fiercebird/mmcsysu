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


?>


<?php $this->widget('bootstrap.widgets.TbCarousel', array(
         'id'=>'TechPic',
         'htmlOptions'=>array('style'=>'width:800px;height:500px;'),
         'items'=>array(
            array('image'=>'http://i1.sinaimg.cn/IT/discovery/idx/2014/0224/U2727P2T788D1F26391DT20140224103037.jpg', 'label'=>'360度全景摄影震撼超现实世界', 'caption'=>'Randy Scott Slavin是一名来自纽约的摄影师兼电影制片人。这些超现实主义的作品是通过上百张照片后期合成的。因为有拍摄动态影像的经验，他把这些观念结合到静态的摄影里面，漩涡的画面呈现出超现实的滚动感，像万花筒一样', 'style'=>'height:500px;'),
            array('image'=>'http://www.sinaimg.cn/dy/slidenews/5_img/2014_08/453_40911_150155.jpg', 'label'=>'危地马拉巨型地坑深30米', 'caption'=>'近日英国的暴雨导致出现大量地陷现象，导致道路和建筑损坏。这份图集整理了发生在英国以及世界各地的一些地陷现象。2010年5月，中美洲危地马拉城，一个直径20米，深度达到30米的巨型地陷坑洞突然出现，将一座3层高的楼房整个吞下。当局认为是连绵不断的降雨导致的恶果'),
            array('image'=>'http://www.sinaimg.cn/dy/slidenews/5_img/2014_08/453_40782_844135.jpg', 'label'=>'瑞典发现树龄9500岁云杉：或来自冰河世纪时期', 'caption'=>'瑞典于默奥大学的科学家在瑞典中部的一座山脉上发现了一株堪称为“世界上最古老”的树，虽然它看上去很年轻，只有4米左右高度，但经过碳-14年代测定法的测试后，发现其根系至少有9500年历史，而且它还在继续生长。'),
            array('image'=>'http://y0.ifengimg.com/29e78f2198d26614/2014/0213/rdn_52fc897e89dbc.jpg', 'label'=>'两外籍人士擅自攀爬“上海中心”', 'caption'=>'俄罗斯攀高狂人Vadim Makhorov和Vitaliy Raskalov在互联网上展示了二人在“上海中心”顶部拍摄的视频和照片，引起网络轰动。视频画面显示，两人借着夜色偷偷翻入上海中心大厦在建工地，在没有任何安全措施的情况下爬上施工中的“中国在建第一高楼”顶部塔吊，高度近650米'),
            ),
         )); ?>



<?php $this->widget('zii.widgets.CListView', array(
         'dataProvider'=>$dataProvider,
         'itemView'=>'_view',
         'template'=>"{items}\n{pager}",
         )); ?>
