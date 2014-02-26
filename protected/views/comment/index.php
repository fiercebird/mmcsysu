<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(
	'评论管理',
	'评论清单',
);


$this->widget('zii.widgets.CListView', array(
         'id'=>'commentList',
	'dataProvider'=>$dataProvider,
         'pager'=>array('class'=>'CLinkPager',
            'header'=>'', 
            'firstPageLabel'=>'首页', 
            'lastPageLabel'=>'末页',
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            ),
         'template'=>"{summary}{items}{pager}",
         'summaryText'=>"第{start}-{end}条 | 共{count}条 | {page}/{pages}页",
         'itemView'=>'_viewAdmin',
)); ?>



<script language="javascript" type="text/javascript">
$('#collapse7').addClass('in');
var csrfToken='<?php echo Yii::app()->request->csrfToken; ?>';
$('a.deleteBtn').live('click', function(){
     var commentId = $(this).data('id');
     if(confirm("确定要把该评论放入回收站 ?"))
     {
        $.ajax({
           type:'post',
           url:'<?php echo Yii::app()->createUrl('comment/delete')?>',
           data:{"id":commentId,  "YII_CSRF_TOKEN":csrfToken},
           dataType:'json',
           success:function(resData){
           if(resData.resCode)
                   alert(resData.resMes);
           else{
                alert("成功删除！");
                $.fn.yiiListView.update('commentList');
           }
           },
           error:function(XMLHttpRequest, textStatus, errorThrown){
           var errorMes ="状态: " + textStatus + "\n" + XMLHttpRequest.status  + " : " + XMLHttpRequest.statusText + "\n删除评论操作失败: \n" +XMLHttpRequest.responseText;
           alert(errorMes);        
           }
        });
     }
      });
</script>



