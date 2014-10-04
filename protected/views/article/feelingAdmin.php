<?php

//因为多媒体风采是文章，所以直接参考manageArticle
//弄懂dictionary就行
$this->breadcrumbs=array(
        '多媒体风采',
        '工作感想',
);

$this->widget('zii.widgets.grid.CGridView', array(
         'id'=>'assistantGrid',
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
             //校区
             array(
               'name'=>'campus_id',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:80px'),
               'value'=>'Dictionary::item(Yii::app()->params["dictTypeCampus"], $data->campus_id)',
               'filter'=>Dictionary::items(Yii::app()->params["dictTypeCampus"]),
               ),            
            array(
               'name'=>'publisher',
               'type'=>'raw',
               'htmlOptions'=>array('style'=>'width:180px'),
               ),  
            array(
               'name'=>'title',
               'type'=>'raw',
               'value'=>'CHtml::link(CHtml::encode($data->title), $data->url,   array("target"=>"_blank"))'
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
               ),  
            array(
               'header'=>'操作',
               'class'=>'CButtonColumn',
               'template'=>'{view} {update} {delete}',
               'htmlOptions'=>array('style'=>'width:90px; text-align:center;'),
               'deleteConfirmation'=>"js:'确定要把该感想\"'+$(this).parent().parent().children(':eq(2)').children().html()+'\"放入回收站？'",
               'afterDelete'=>'function(link,success,data){ if(success) {var res=JSON.parse(data);if(res.resCode){var hint="<div class=\'flash-error mesFade\'>" + res.resMes + "</div>"; }else{var hint="<div class=\'flash-success mesFade\'>删除感想成功！</div>";}$("#hint").html(hint); $(".mesFade").animate({opacity: 1.0}, 2000).fadeOut(3000); }}',
               'buttons'=>array(
                  'view'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->article_id, "cate"=>$data->category_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-search', 'title'=>'查看感想' ),
                     ),  
                  'update'=>array(      
                     'label'=>'',      
                     'imageUrl'=>'',
                     'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->article_id, "title"=>$data->title))',
                     'options'=>array('class'=>'icon-edit', 'title'=>'编辑感想' ),
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
$('#collapse6').addClass('in');
</script>



