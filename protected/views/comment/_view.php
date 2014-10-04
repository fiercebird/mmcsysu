<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="row-fluid" style="clear: both;">
    <div style="width:100px; float: left">
        <div  class='headPhoto'><img alt="" src="<?php echo Yii::app()->baseUrl; ?>/images/head/head4.jpg"  height="80" width="80"></div>
    </div>
    <div class="well" style="width:600px; float: left">
        <div ><strong><?php echo $data->author; ?>：</strong>&emsp;<span style="color: #595959;"><?php echo substr($data->create_time, 0, -3); ?></span></div>
        <div><div id="content-<?php echo $data->comment_id; ?>"><p><?php echo $data->content; ?></p></div></div>
    </div>
</div>
<?php
if (isset($data->reply) && trim($data->reply) != "")
{
    ?>
    <div class="row-fluid" style="clear: both;">
        <div class="well" style="width:600px; margin-left: 245px; float: left">
            <div><div id="reply-<?php echo $data->comment_id; ?>"><strong>多媒体中心：</strong><br /><p style="text-indent: inherit;"><?php echo $data->reply; ?></p></div></div>
        </div>
        <div style="width:100px; float: right">
            <div  class='headPhoto'><img alt="" src="<?php echo Yii::app()->baseUrl; ?>/images/head/head3.jpg"  height="80" width="80"></div>
        </div>
    </div>
    <br />
<?php } ?>
