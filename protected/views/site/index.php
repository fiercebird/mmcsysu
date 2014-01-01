<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$articleList="";
foreach($articles as $article)
{
  $articleList.='<div class="aritcleItem"><a class="row-fluid" title="' . $article->title . '" href="'. Yii::app()->createUrl("site/article", array("id"=>$article->article_id,"cate"=>'index'))  .'">'. $article->title .'</a></div>';
}
?>

<div class="row-fluid">
<div id='info' class="span7  pull-left" >
<div class='row-fluid'><span class='font1'>服务信息</span><a  class='pull-right'  href="#">更多>></a></div>
<hr class="hr2"/>
<div id="news">
<?php echo $articleList; ?>
</div>


</div>
<div id='contact' class="span5 pull-left">
<div class='row-fulid'><span class='font1'>联系我们</span></div>
<hr class='hr0' />
 <p style="line-height: 150%;">【南校区】<br />第一、二教学楼：卜老师&nbsp;&nbsp;&nbsp;84110459&nbsp;<br />第三教学楼、文科楼：洪老师&nbsp;&nbsp;&nbsp;84113453&nbsp;<br />逸夫楼:&nbsp;张老师&nbsp;&nbsp;&nbsp;84115148<br />【东校区】<br />教学楼:&nbsp;李文杰&nbsp;&nbsp;&nbsp;&nbsp;39332701&nbsp;39332702&nbsp;<br />【北校区】<br />教学楼:&nbsp;岑老师&nbsp;&nbsp;&nbsp;&nbsp;87331669&nbsp;87331626<br />【珠海校区】&nbsp;<br />教学楼：蔡家明&nbsp;&nbsp;&nbsp;&nbsp;0756－3668187										  </p>    
</div>
</div>

<br />
<div class="row-fliud">
<div class="font1">常用链接</div>
<br />
<div>
<div class="siteLink"><a  id='link1' target='_blank' href='http://home.sysu.edu.cn/zdnl/2013/'><span>中大校历</span></a></div>
<div class="siteLink"><a  id='link2'  target='_blank' href='http://bbs.sysu.edu.cn/'><span>逸仙时空</span></a></div>
<div class="siteLink"><a  id='link3'  target='_blank' href='http://www.bojistudio.org/'><span>博济在线</span></a></div>
<div class="siteLink"><a  id='link4'  target='_blank'  href='http://lecture.sysu.edu.cn/'><span>逸仙讲坛</span></a></div>
</div>
</div>
