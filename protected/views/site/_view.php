<?php
/*
 * Author: hehao
 * Email:  mickeymousesysu@gmail.com
 * Date: 2013-12-23
 * Function:
 *  
 */
?>



<?php
if (isset($data))
{
    ?>

    <div class='row-fluid'>
        <div class='span4' style='height:200px'>
        </div>
        <div class='span8' style='height:auto'>
            <div class="techTitle row"><a href="<?php echo Yii::app()->createUrl("site/article", array('id' => $data->article_id, 'cate' => 'rule')); ?>"><?php echo $data->title; ?></a></div>
            <div class="techText row"><?php echo strip_tags($data->content); ?></div>
        </div>
        <hr class='hr2'/>
    </div>
<?php } ?>
