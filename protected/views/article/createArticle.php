<?php
/* @var $this ArticleController */
/* @var $model Article */
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-18 
 *Function:
 *  
 */

$cate = Dictionary::item(Yii::app()->params['dictTypeCategory'], $model->category_id);
$prev = $cate;
if($cate == Category::$CATE_SERVICE_NEWS)
        $prev = '首页管理';
$this->pageTitle=Yii::app()->name . ' - 添加' . $cate;
$this->breadcrumbs=array(
            $prev,
           '添加'. $cate ,
)



?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'cate'=>$cate)); ?>
