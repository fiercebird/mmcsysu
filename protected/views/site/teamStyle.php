<?php
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-29
 *Function:
 *  
 */


$this->pageTitle=Yii::app()->name . ' - 多媒体风采';
$this->breadcrumbs=array(
           '多媒体风采',
);

?>


<script>
function addSlide(i){
        $(function(){
                var slidei='#slides'+i;
                var slidecap=slidei+' .caption';        
                $(slidei).slides({
                        preload: true,
                        preloadImage: "<?php echo Yii::app()->baseUrl;?>/images/mmintro/loading.gif",
                        play: 5000,
                        pause: 2500,
                        hoverPause: true,
                        animationStart: function(current){
                        $(slidecap).animate({
                        bottom:-35
                        },100);
                        if (window.console && console.log) {
                        // example return of current slide number
                        console.log('animationStart on slide: ', current);
                        };
                        },
                        animationComplete: function(current){
                        $(slidecap).animate({
                        bottom:0
                        },200);
                        if (window.console && console.log) {
                        // example return of current slide number
                        console.log('animationComplete on slide: ', current);
                        };
                        },
                        slidesLoaded: function() {
                        $(slidecap).animate({
                        bottom:0
                        },200);
                        }
                });
        });
}
for(var i=1;i<=3;i++){
addSlide(i);
}//for
</script>



<div class="team-main">

<div class="slideBorder">
<div class="slidePicture"  >
<div class="slideContainer">
<div id="slides1">
<div class="slides_container">
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide1-1.jpg" class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>每天一早打开多媒体设备</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide1-2.jpg" class='image1' alt="Slide 2"><div class="caption"><p>维修多媒体设备</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide1-3.jpg" class='image1' alt="Slide 3"><div class="caption"><p>办公室</p></div></div></div>
<a  class="slidePrev"></a><a  class="slideNext"></a>
</div>
</div>
</div>
<div class="slideText" >
<h4>我们的工作</h4>
<p>每天的清晨<br />我们准时为有课的教室打开多媒体设备</p>
<p>每次多媒体设备出现故障<br />我们会第一时间赶到教室为您排除故障</p>
<p>每天傍晚<br />我们都安排专人对每个教室的多媒体设备进行故障检查</p>
<p>日检周检<br />保证多媒体设备处于良好的工作状态</p>
</div>
</div>

<div  class="slideBorder">
<div class="slideText">
<h4>我们是一个有爱的部门</h4>
<p>每一年<br />多媒体会为毕业助理们办一个送旧活动</p>
<p>一年一度的篮球赛<br />无论是球员还是拉拉队<br />都可以感受运动的快感</p>
<p>户外踏青<br />让每个人享受出游的喜悦</p>
<p>互爱互助 &#12288;有如家人<br />一起享受多媒体的静好时光</p>
</ul>
</div>
<div class="slidePicture" >
<div class="slideContainer">
<div id="slides2">
<div class="slides_container">
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-1.jpg"  class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>06送旧</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-2.jpg"  class='image1' alt="Slide 2"><div class="caption"><p>07送旧</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-3.jpg"  class='image1' alt="Slide 3"><div class="caption"><p>篮球赛合影</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-4.jpg"  class='image1' alt="Slide 4"><div class="caption"><p>篮球赛合影</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-5.jpg"  class='image1' alt="Slide 5"><div class="caption"><p>大夫山出游</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-6.jpg"  class='image1' alt="Slide 6"><div class="caption"><p>金星农庄出游</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide2-7.jpg"  class='image1' alt="Slide 7"><div class="caption"><p>长兴乐园出游</p></div></div>
</div>
<a class="slidePrev"></a><a class="slideNext"></a>
</div>
</div>
</div>
</div>

<div  class="slideBorder">            
<div class="slidePicture"  >
<div class="slideContainer">
<div id="slides3">
<div class="slides_container">
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-1.jpg" class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-2.jpg" class='image1' alt="Slide 2"><div class="caption"><p>多媒体中技术全面的优秀</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-3.jpg" class='image1' alt="Slide 3"><div class="caption"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-4.jpg" class='image1' alt="Slide 4"><div class="caption" style="bottom:0"><p>Stay hungry!Stay foolish!</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-5.jpg" class='image1' alt="Slide 5"><div class="caption"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="<?php echo Yii::app()->baseUrl;?>/images/mmslide/slide3-6.jpg" class='image1' alt="Slide 6"><div class="caption"><p>2013年主力军</p></div></div></div>
<a  class="slidePrev"></a><a  class="slideNext"></a>
</div>
</div>
</div>
<div class="slideText">
<h4>我们的宗旨</h4>
<p>帮助师生<br />解决多媒体设备问题<br />是我们的责任</p>
<p>团结&#12288;互助<br />是我们一贯的作风</p>
<p>耐心&#12288;认真<br />地解决每一个问题</p>
<p>我们竭诚为师生服务<br />努力维护好我们的学习环境</p>
</div>
</div>

</div>
