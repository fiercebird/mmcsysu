<?php
/* @var $this ArticleController */
/* @var $model Article */
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-24
 *Function:
 *  
 */

$cate = Dictionary::item(Yii::app()->params['dictTypeCategory'], $cateId);
$prev = $cate;
if($cateId == Category::$CATE_SERVICE_INFO)
        $prev = '首页管理';
$this->breadcrumbs=array(
	$prev,
	'管理' . $cate,
);

$cid = 0;
switch($cateId)
{
   case Category::$CATE_SPECIAL_CLASSROOM:
      $cid = 2;
      break;
   case Category::$CATE_REGULATION_RULE:
      $cid = 4;
      break;
   case Category::$CATE_SERVICE_INFO:
      $cid = 1;
      break;
   case Category::$CATE_TECH_EXPLORE:
      $cid = 5;
      break;
}



$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'articleGrid',
         'dataProvider'=>$model->search(),
         'pager'=>array('class'=>'CLinkPager',
            'maxButtonCount'=>10,
            'header'=>'', 
            'firstPageLabel'=>'首页', 
            'lastPageLabel'=>'末页',
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            ),
         'nullDisplay'=>' ',
         'template'=>"{summary}{items}{pager}",
         'summaryText'=>"第{start}-{end}条 | 共{count}条 | {page}/{pages}页",
         'filter'=>$model,
         'columns'=>array(
             array(
               'name'=>'campus_id',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:80px'),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeCampus"], $data->campus_id)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeCampus"]),
               ),            
             array(
               'name'=>'update_time',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:130px'),
               'value'=>'substr($data->create_time,0,-3)',  
               'visible'=>($cateId==Category::$CATE_SPECIAL_CLASSROOM),
               ),
            array(
               'name'=>'publisher',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:180px'),
               'visible'=>($cateId!=Category::$CATE_SPECIAL_CLASSROOM),
               ),  
            array(
               'name'=>'title',
               'type'=>'raw',
               'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
               ), 
            array(
               'name'=>'create_time',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:130px'),
               'value'=>'substr($data->create_time,0,-3)',  
               ), 
            array(
               'name'=>'status',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:70px'),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeArticle"], $data->status)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeArticle"]),
               'visible'=>($cateId!=Category::$CATE_SPECIAL_CLASSROOM),
               ),  
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{view} {update} {delete}',
               'htmlOptions'=>array('style'=>'width:90px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要把该文章\"'+$(this).parent().parent().children(':eq(2)').children().html()+'\"放入回收站？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除文章成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'view'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->article_id, "cate"=>$data->category_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-search', 'title'=>'查看文章' ),
                     ),  
                  'update'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->article_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-edit', 'title'=>'编辑文章' ),
                     ),  
                  'delete'=>array(      
                     'label'=>'',          
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->article_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-trash', 'title'=>'放入回收站', ),
                     ),
                 ),
               ),  
            ),  
            )); 


?>

<div id='hint'></div>


<script language="javascript" type="text/javascript">
var cid = <?php echo $cid; ?>;
$('#collapse'+cid).addClass('in');
</script>



