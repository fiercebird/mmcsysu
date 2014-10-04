<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-12
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 管理平台';
$this->breadcrumbs=array(
           '管理平台',
);

function showAuthIcon($bit)
{
    echo ($bit)?'<i class="icon-ok"></i>':'<i class="icon-remove"></i>';
}

$auth = Yii::app()->user->auth;
?>

<div  class='row-fluid'>
<div class='span6 pull-left'> 
<div class="well well-small" data-toggle="collapse" data-target="#currentUser">
当前用户
</div>
<div id="currentUser" class="collapse in"> 
<div class="alert">申请模块权限请联系张梓滨，469917226@qq.com。</div>
<table class="table table-striped table-hover">
<thead><tr><th>用户名</th><th><?php echo Yii::app()->user->name;?></th></tr></thead>
<tbody>
<tr><th>校区</th><th><?php echo Dictionary::Item(Yii::app()->params['dictTypeCampus'], Yii::app()->user->campusId);?></th></tr>
<tr><th>模块名</th><th>权限</th></tr>
<tr><td>首页管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_HOMEPAGE_ADMIN) ?></td></tr>
<tr><td>特色课室</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_CLASSROOM_ADMIN) ?></td></tr>
<tr><td>服务列表</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_SERVICE_ADMIN) ?></td></tr>
<tr><td>规章制度</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_RULE_ADMIN) ?></td></tr>
<tr><td>技术探索</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TECH_EXPLORE) ?></td></tr>
<tr><td>多媒体风采</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TEAMSTYLE) ?></td></tr>
<tr><td>评论管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_COMMENT_ADMIN) ?></td></tr>
<tr><td>用户管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_USER_ADMIN) ?></td></tr>
<tr><td>设备检查登记</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_DEVICE_CHECK) ?></td></tr>
<tr><td>设备信息查询</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_DEVICE_INFO) ?></td></tr>
<tr><td>设备操作管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_ACTION_MANAGE) ?></td></tr>
<tr><td>服务调查统计</td><td><?php showAuthIcon($auth & ModuleAuth::MMD_SERVICE_SURVEY) ?></td></tr>
<tr><td>回收站管理</td><td><?php showAuthIcon($auth & ModuleAuth::MMC_TRASH_ADMIN) ?></td></tr>
</tbody>
</table>
</div>
</div>
<div class='span6 pull-right' >
<div class="well well-small" data-toggle="collapse" data-target="#aboutSystem">
关于系统
</div>
<div id="aboutSystem" class="collapse in"> 
<table class="table table-striped table-hover">
<thead><tr><th>系统名称</th><th>中山大学信息管理平台</th></tr></thead>
<tbody>
<tr><th>系统版本</th><td>V 3.0</td></tr>
<tr><th>系统开发</th><td>中山大学网络中心多媒体网络组</td></tr>
<tr><th>浏览器支持</th><td>IE8-10、Chrome、Firefox、Safari</td></tr>
</tbody>
</table>
<table class="table table-striped table-hover">
<thead><tr><th>维护人员</th><th>联系方式</th><th>QQ</th></tr></thead>
<tbody>
<tr><th>张梓滨</th><td>15902024360</td><td>469917226</td></tr>
<tr><th>杨文欢</th><td>639723</td><td>1966775441</td></tr>
<tr><th>张永燊</th><td>610648</td><td>2485030029</td></tr>
<tr><th>何&emsp;浩</th><td>13512709207</td><td>328679181</td></tr>
</tbody>
</table>
</div>
</div>
</div>

