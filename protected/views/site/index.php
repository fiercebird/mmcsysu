<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

$articleList = "";
foreach ($articles as $article)
{
    $articleList .= '<div class="aritcleItem">';
    $articleList .= '<a class="row-fluid" title="' . $article->title . '" href="' . Yii::app()->createUrl("site/article", array("id" => $article->article_id, "cate" => Category::$CATE_SERVICE_INFO)) . '">' . $article->title . '</a>';
    $articleList .= '<span class="row-fluid">' . substr($article->create_time, 0, 16) . '</span>';
    $articleList .= '</div>';
}
?>

<div class="row-fluid">
    <div id='info' class="pull-left" >
        <div class='div-hd'>
            <span class='font1'>服务信息</span>
            <a  class='a-more pull-right'  href="<?php echo Yii::app()->createUrl("site/more"); ?>">更多>></a>
        </div>
        <div id="news">
            <?php echo $articleList; ?>
        </div>
    </div>
    <div id='contact' class="pull-left" >
        <div class='div-hd'>
            <span class='font1'>联系我们</span>
        </div>
        <div id="phone">
            <?php echo (isset($contactWay->content) ? $contactWay->content : ""); ?>
        </div>
    </div>
</div>
<div class="row-fliud">
    <div class="font1 div-hd">常用链接</div>
    <br />
    <div>
        <div class="siteLink"><a  id='link1' target='_blank' href='http://jwc.sysu.edu.cn/Item/1575.aspx'><span>中大校历</span></a></div>
        <div class="siteLink"><a  id='link2'  target='_blank' href='http://bbs.sysu.edu.cn/'><span>逸仙时空</span></a></div>
        <div class="siteLink"><a  id='link3'  target='_blank' href='http://www.bojistudio.org/'><span>博济在线</span></a></div>
        <div class="siteLink"><a  id='link4'  target='_blank'  href='http://lecture.sysu.edu.cn/'><span>逸仙讲坛</span></a></div>
    </div>
</div>
