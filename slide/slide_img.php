<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script> 
  <script src="./slide/js/jquery.bxslider.min.js"></script> 
 <script type="text/javascript">
         var j = $.noConflict(true); // 
        
         j(document).ready(function(){ 
        
             var main = j('.bxslider').bxSlider({ 
        
             mode: 'fade', 
        
             auto: true,	//자동으로 슬라이드 
        
             controls : true,	//좌우 화살표	
        
             autoControls: true,	//stop,play 
        
             pager:false,	//페이징 
        
             pause: 3000, 
        
             autoDelay: 0,	
        
             slideWidth: 1000, 
        
             speed: 300, 
        
             stopAutoOnclick:true, 
        
             autoHover: true
         }); 
        
        
        
         j(".bx-stop").click(function(){	// 중지버튼 눌렀을때 
        
             main.stopAuto(); 
        
             j(".bx-stop").hide(); 
        
             j(".bx-start").hide(); 
        
             return false; 
        
         }); 
        
        
        
         j(".bx-start").click(function(){	//시작버튼 눌렀을때 
        
             main.startAuto(); 
        
             j(".bx-start").hide(); 
        
             j(".bx-stop").hide(); 
        
             return false; 
        
         }); 
        
        
        
         j(".bx-start").hide();	//onload시 시작버튼 숨김. 
        	
         }); 
	 
 </script>

</head>

<body id="n">
<div class="home__slider" style="height: 2%;"> 
 
    <div class="bxslider" style="height: 2%;"> 
 
        <div><img src="./slide/img/intro_1.jpg"></div>
        <div><img src="./slide/img/intro_2.jpg"></div> 
        <div><img src="./slide/img/intro_3.jpg"></div> 
        <div><img src="./slide/img/intro_4.jpg"></div> 
 
    </div> 
 
</div> 
 
</body>

</html>