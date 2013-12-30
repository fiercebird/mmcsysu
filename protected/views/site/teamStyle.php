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
                        preloadImage: '/mmcsysu/images/mmintro/loading.gif',
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



<div id="about">
<h6 style="margin:10px 0px 10px 20px;">关于我们</h6>

<div class="about_content">
<div class="PicSlide"  >
<div class="slideContainer">
<div id="slides1">
<div class="slides_container">
<div class="slide"><img src="/mmcsysu/images/mmslide/slide1-1.jpg" class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>每天一早打开多媒体设备</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide1-2.jpg" class='image1' alt="Slide 2"><div class="caption"><p>维修多媒体设备</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide1-3.jpg" class='image1' alt="Slide 3"><div class="caption"><p>办公室</p></div></div></div>
<a  class="prev"></a><a  class="next"></a>
</div>
</div>
</div>
<div class="about_us" >
<br /><h4>我们的工作</h4><br />
<ul>
<li>每天的清晨</li><li>我们准时为有课的教室打开多媒体设备</li><br />
<li>每次教室的多媒体设备出现故障</li><li>我们总会第一时间赶到</li><li>为您排除故障</li><br />
<li>每天傍晚</li><li>我们都安排专人对每个教室的多媒体设备进行故障检查</li><br />
<li>每周一次的周检</li><li>保证多媒体设备处于良好的工作状态</li>
</ul>
</div>
</div>

<div  class="about_content">
<div class="about_us">
<br /><h4>我们是一个有爱的部门</h4><br />
<ul >
<li>每一年</li><li>我们都会为毕业的助理办一个送旧活动</li><li>多媒体就像我们的家</li><br />
<li>一年一度的篮球赛</li><li>无论是球员还是拉拉队</li><li>都可以享受运动的喜悦</li><br />
<li>集体出游</li><li>让多媒体每一个人享受出游的喜悦</li><br />
<li>我们互帮互助</li><li>我们有如家人</li><li>我们一起享受在多媒体的时光</li>
</ul>
</div>
<div class="PicSlide" >
<div class="slideContainer">
<div id="slides2">
<div class="slides_container">
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-1.jpg"  class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>06送旧</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-2.jpg"  class='image1' alt="Slide 2"><div class="caption"><p>07送旧</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-3.jpg"  class='image1' alt="Slide 3"><div class="caption"><p>篮球赛合影</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-4.jpg"  class='image1' alt="Slide 4"><div class="caption"><p>篮球赛合影</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-5.jpg"  class='image1' alt="Slide 5"><div class="caption"><p>大夫山出游</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-6.jpg"  class='image1' alt="Slide 6"><div class="caption"><p>金星农庄出游</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide2-7.jpg"  class='image1' alt="Slide 7"><div class="caption"><p>长兴乐园出游</p></div></div>
</div>
<a class="prev"></a><a class="next"></a>
</div>
</div>
</div>
</div>

<div  class="about_content">            
<div class="PicSlide"  >
<div class="slideContainer">
<div id="slides3">
<div class="slides_container">
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-1.jpg" class='image1' alt="Slide 1"><div class="caption" style="bottom:0"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-2.jpg" class='image1' alt="Slide 2"><div class="caption"><p>多媒体中技术全面的优秀</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-3.jpg" class='image1' alt="Slide 3"><div class="caption"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-4.jpg" class='image1' alt="Slide 4"><div class="caption" style="bottom:0"><p>Stay hungry!Stay foolish!</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-5.jpg" class='image1' alt="Slide 5"><div class="caption"><p>2009年助理的好建议</p></div></div>
<div class="slide"><img src="/mmcsysu/images/mmslide/slide3-6.jpg" class='image1' alt="Slide 6"><div class="caption"><p>2013年主力军</p></div></div></div>
<a  class="prev"></a><a  class="next"></a>
</div>
</div>
</div>
<div class="about_us">
<br /><h4>我们的宗旨</h4><br />
<ul >
<li>帮助师生解决多媒体设备问题</li><li>是我们的责任</li><br />
<li>团结、互助是我们一贯的作风</li><br />
<li>耐心、认真地解决每一个问题</li><br />
<li>我们竭诚为师生服务</li><li>努力维护好我们的学习环境</li><br />
</ul>
</div>
</div>

</div>
