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

$this->breadcrumbs=array(
        '回收站',
	'文章回收站',
);



$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'articleTrashGrid',
         'dataProvider'=>$model->searchTrash(),
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
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{restore} {delete}',
               'htmlOptions'=>array('style'=>'width:50px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要彻底该文章\"'+$(this).parent().parent().children(':eq(2)').children().html()+'\"？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除文章成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'restore'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("restore", array("id"=>$data->article_id, "cate"=>$data->category_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-share', 'title'=>'恢复文章' ),
                     'click'=>'function(){ restore(this); return false;}',
                     ),  
                  'delete'=>array(      
                     'label'=>'',          
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("physicalDelete", array("id"=>$data->article_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-fire', 'title'=>'彻底删除文章', ),
                     ),
                 ),
               ),  
            ),  
            )); 


?>

<div id='hint'></div>


<script language="javascript" type="text/javascript">
$('#collapse9').addClass('in');
var csrfToken='<?php echo Yii::app()->request->csrfToken; ?>';
function restore(obj)
{         
   var title = $(obj).parent().parent().children(':eq(2)').children().html();
   if(confirm("确定要恢复'"+ title  +"'"))
   {
      $.ajax({
        type:'post',
        url: $(obj).attr('href'),
        data:{ "YII_CSRF_TOKEN":csrfToken},
        dataType:'json',
        success:function(resData){
        if(resData.resCode)
                alert(resData.resMes);
        else{
                $.fn.yiiGridView.update('articleTrashGrid');
                $("#hint").html('<div class="flash-success mesFade">成功恢复文章！</div>');
                $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); 
        }
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
                var errorMes ="状态: " + textStatus + "\n" + XMLHttpRequest.status  + " : " + XMLHttpRequest.statusText + "\n恢复文庄操作失败: \n" +XMLHttpRequest.responseText;
                alert(errorMes);        
                }
                });
   }
}
</script>



