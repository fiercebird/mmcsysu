<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-12 
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 查看用户';
$this->breadcrumbs=array(
           '用户管理',
           '查看用户',
);

function showAuthIcon($bit)
{
    echo ($bit)?'<i class="icon-ok"></i>':'<i class="icon-remove"></i>';
}

$auth = $model->authority;
?>

<div>
<table class="table table-striped table-hover">
<thead><tr><th>用户名</th><th><?php echo $model->username;?></th></tr></thead>
<tbody>
<tr><th>校区</th><th><?php echo Dictionary::Item(Yii::app()->params['dictTypeCampus'], $model->campus_id);?></th></tr>
<tr><th>模块名</th><th>权限</th></tr>
<tr><td>首页管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_HOMEPAGE_ADMIN) ?></td></tr>
<tr><td>课室管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_CLASSROOM_ADMIN) ?></td></tr>
<tr><td>服务列表</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_SERVICE_ADMIN) ?></td></tr>
<tr><td>规章制度</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_RULE_ADMIN) ?></td></tr>
<tr><td>技术探索</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TECH_EXPLORE) ?></td></tr>
<tr><td>多媒体风采</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TEAMSTYLE) ?></td></tr>
<tr><td>评论管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_COMMENT_ADMIN) ?></td></tr>
<tr><td>用户管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_USER_ADMIN) ?></td></tr>
<tr><td>回收站管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TRASH_ADMIN) ?></td></tr>
<tr><td>设备检查登记</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_DEVICE_CHECK) ?></td></tr>
<tr><td>设备信息查询</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_DEVICE_INFO) ?></td></tr>
<tr><td>设备操作管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_ACTION_MANAGE) ?></td></tr>
<tr><td>服务调查统计</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_SERVICE_SURVEY) ?></td></tr>
</tbody>
</table>
<div>
<a class="btn btn-info span2" href="<?php echo Yii::app()->request->urlReferrer;?> ">返回</a>

<script language="javascript" type="text/javascript">
$('#collapse8').addClass('in');

</script>
