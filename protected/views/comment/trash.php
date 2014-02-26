<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'回收站',
	'评论回收站',
);



$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'commentGrid',
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
               'name'=>'author',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:100px'),
               ),  
            array(
               'name'=>'email',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:150px'),
               ), 
            array(
               'name'=>'content',
               'type'=>'raw',
               //'value'=>'mb_substr($data->content, 0, 300, "utf-8")',
               ), 
            array(
               'name'=>'create_time',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:110px'),
               'value'=>'substr($data->create_time,0,-3)',  
               ), 
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{restore} {delete}',
               'htmlOptions'=>array('style'=>'width:50px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要彻底删除评论人\"'+$(this).parent().parent().children(':eq(0)').html()+'\"发表的评论？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除评论成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'restore'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'click'=>'function(){ restore(this);return false;}',
                     'url'=>'Yii::app()->controller->createUrl("restore", array("id"=>$data->comment_id))',
                     'options'=>array('class'=>'icon-share', 'title'=>'恢复评论' ),
                     ),  
                  'delete'=>array(      
                     'label'=>'',          
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("physicalDelete", array("id"=>$data->comment_id))',
                     'options'=>array('class'=>'icon-fire', 'title'=>'彻底删除', ),
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
   var username = $(obj).parent().parent().children(':eq(0)').html();
   if(confirm("确定要恢复评论人为 "+ username  +" 的评论?"))
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
                $.fn.yiiGridView.update('commentGrid');
                $("#hint").html('<div class="flash-success mesFade">成功恢复评论！</div>');
                $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); 
        }
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
                var errorMes ="状态: " + textStatus + "\n" + XMLHttpRequest.status  + " : " + XMLHttpRequest.statusText + "\n删除用户操作失败: \n" +XMLHttpRequest.responseText;
                alert(errorMes);        
                }
                });
   }
}


</script>



