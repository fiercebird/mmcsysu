<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-27
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 课室介绍';
$breadcrumbs=array(
      '课室介绍'=>array('site/introduce'),
      );
switch($bid)
{
        case '1':
           array_push($breadcrumbs, '东校区');
           break;
        case '2':
           array_push($breadcrumbs, '南校区');
           break;
        case '3':
           array_push($breadcrumbs, '珠海校区');
           break;
        case '4':
           array_push($breadcrumbs, '北校区');
           break;

}
$this->breadcrumbs=$breadcrumbs;

$cid = 1;
$building = Building::model()->findByPk($bid);
if($building)
	$cid = $building->cid;
$dir=Yii::app()->baseUrl;
if($cid==1) $dir.= "/images/classroom/east/";
if($cid==2) $dir.= "/images/classroom/south/";
if($cid==3) $dir.= "/images/classroom/north/";
if($cid==4) $dir.= "/images/classroom/zhuhai/";
if($bid==8) $dir.='YF';
if($bid==6) $dir.='WK';
$dir.=$className;

?>


<div class='row-fluid'>
<h4 class='text-center'>教室情况说明</h4>
<hr class='hr4'>
<div class='row-fluid' >
<div id="classroomPicture" class='span7 pull-right' >
<div id="imgPlayer">
<script type="text/javascript">
var cid=<?php echo $cid ;?>;             
var dir="<?php echo $dir; ?>";
var PicStr=new Array();
PicStr[0]="多媒体中控面板";
PicStr[1]="教室讲台";
PicStr[2]="教室讲台";
PicStr[3]="教室全景";
PicStr[4]="教室全景";
if(cid==4)
{
   PicStr[0]="教室门牌";
}else if(cid==3 || cid==2)
{
   PicStr[0]="教室讲台";
   PicStr[1]="中控面板";
   PicStr[2]="教室全景";
   PicStr[3]="教室全景";
   PicStr[4]="投影设备";
}
PImgPlayer.addItem(PicStr[0], "#", dir+"_01.jpg");
PImgPlayer.addItem(PicStr[1], "#", dir+"_02.jpg");
PImgPlayer.addItem(PicStr[2], "#", dir+"_03.jpg");
PImgPlayer.addItem(PicStr[3], "#", dir+"_04.jpg");
PImgPlayer.addItem(PicStr[4], "#", dir+"_05.jpg");
PImgPlayer.init("imgPlayer", 434,300);   
</script>
</div>
</div>
<div class='span5   pull-left'><dl>
<dt><h5>教室说明:</h5></dt>
<dd><ul>
<li>课室名：<?php  if($className) echo $className; else echo "暂无信息";?></li> 
<li>教室座位数：<?php if($classDetail) echo $classDetail->seatNum; else echo "暂无信息";?></li>
<li>教室考位：<?php if($classDetail) echo $classDetail->examNum; else echo "暂无信息";?></li>
</ul><dd>
<?php
    if($classDetail)
	    $com = $classDetail->computers;
	if(isset($com[0]))
		$com = $com[0];
	else
		$com = false;
?>
<dt><h5>计算机配置:</h5><dt>
<dd><ul>
<li>CPU：&nbsp;<?php  if($com) echo $com->cpu; else echo "暂无信息";?></li> 
<li>内存：&nbsp;<?php if($com) echo $com->memory." GB"; else echo "暂无信息";?></li> 
<li>硬盘：&nbsp;<?php if($com) echo $com->hardDisk." GB"; else echo "暂无信息";?></li> 
<li>IP地址：&nbsp;<?php if($com) echo $com->ip; else echo "暂无信息";?></li> 
<li>操作系统：&nbsp; win 7</li>
<li>预装软件：&nbsp; Office 办公软件 | 常用播放器 | 杀毒软件</dd>
</ul>
</dl></div>
</div>

<div id="ClassDown"> 
<dl>    
<dt><h5>多媒体教室操作说明</h5></dt>
<dd>
<ul>
<li>教室采用集中电话管理，老师可拨打内线电话801 or 802联系多媒体办公室</li>
<li>考虑到空气对流换气，教室中走廊一侧上窗口应开启，减少闷热。</li>
</ul>
</dd>  
<dt><h5>教室基本设备</h5></dt>
<dd>
<ol>
<li>高分辨率投影机，可以播放讲课讲义和视频</li>
<li>嵌入讲台的设备控制台</li>
<li>每个多媒体教室配备了移频扩音设备，无线及有线话筒可同步使用</li>
<li>教室桌面提供网络接口，可通过网络接口连接校园网（IP应设置为自动获取），也可通过无线网连接校园网。</li>
</ol>
</dd>   
<dt><h5>可借用设备设备</h5></dt> 
<dd>
<ul>
<li>200人以上教室可借用无线麦克风</li>
<li>录像机、DVD机、实物展示台</li>
<li>PPT遥控器（激光笔）</li>
<li>VAG线，音频线</li>
<li>80人以下教室没有扩音设备，如确实有需要，可与主控室联系。</li>
</ul>
</dd>
<dt><h5>教室投影操作说明</h5></dt>
<dd>
<ol >
<li>按“开关”按键，系统开，5秒后给投影机发出开机代码，打开投影机，降下电动幕。</li>
<li>等待投影机及电脑启动正常后，即可插上U盘进行使用。</li>
<li>如果需要使用台式计算机以外的设备，如笔记本、展示台等，请按相应键。“扩展键”用于切换显示提前接入的DVD、VCD等扩展外设信号。</li>
<li>可使用面板按键进行演示设备音量的控制，音量大、小按键每按一次键增加或减少一级音量（一级为±4db），每三级为一个LED音量显示，一直按住音量大、小键，系统会连续控制音量，直至最大或最小。“静音键”无效。教室扩音设备音量控制在讲台内，控制面板下旋钮，顺时针为音量增。</li>
<li>使用完毕，关闭投影机和电脑，按“开关”按键，系统会自动收起电动幕，投影机进入散热状态，延时4分30秒后，自动断投影机电源。</li>
</ol>
</dd>
<dt><h5>温馨提示</h5></dt>
<dd>
<ul>
<li>请老师或同学使用完多媒体后，把自己的Ｕ盘等物品带走，并关闭多媒体设备。</li>
<li>如在正常操作情况下出现异常情况，请通知管理员。（使用黑板旁边的内部电即可。）</li>
<li>多媒体课室电脑仅作为老师上课用，其他人员不得使用课室电脑。若有其它事务，请与多媒体服务室联系。</li>
</ul>
</dd>  
</dl>
</div>
</div>




