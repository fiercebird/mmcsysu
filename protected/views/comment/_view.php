<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="row-fluid">
<div class='pull-left' style='display:inline-block'>
<div  class='headPhoto' style='height:80px;min-width:80px;'><img alt="" src="/mmcsysu/images/head/head4.jpg"  height="80" width="80"></div>
<div  class='name' style='text-align:center;'><?php echo $data->author; ?></div>
</div>
<div class="span10 well" style='' >
<div ><?php echo substr($data->create_time,0,-3); ?>&emsp;&emsp;<a id="commentId-<?php echo $data->comment_id;?>">#<?php getNum(); ?></a></div>
<div><div id="content-<?php echo $data->comment_id;?>"><p><?php echo $data->content;?></p></div></div>
</div>
</div>
<?php
if(isset($data->reply) && trim($data->reply) != ""  )
{?>
<div class="row-fluid">
<div class='pull-right' style='display:inline-block'>
<div  class='headPhoto' style='height:80px;min-width:80px;'><img alt="" src="/mmcsysu/images/head/head3.jpg"  height="80" width="80"></div>
<div  class='name' style='text-align:center;'>多媒体中心</div>
</div>
<div class="span10 well" style='' >
<div><div id="reply-<?php echo $data->comment_id;?>"><p><?php echo $data->reply;?></p></div></div>
</div>
</div>

<?php

}
 ?>
