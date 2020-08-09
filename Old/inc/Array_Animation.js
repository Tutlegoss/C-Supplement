var std_speed  = 1000;
var pauseShort = 1000;
var pauseLong = 2000;
var change_speed = false;
var pause_animation = false;
var resume_pos = 1;

$(document).ready(function(){
	$("#Pause").attr("disabled","disabled");
	$("#Resume").attr("disabled","disabled");
	$("#Restart").attr("disabled","disabled");
	$("#Pause i").css("color","#212529");
	$("#Resume i").css("color","#212529");
	$("#Restart i").css("color","#212529");
	$("#Play").click(function($e){
		$e.preventDefault();
		$("#Pause").removeAttr("disabled","disabled");
		$("#Restart").removeAttr("disabled","disabled");
		$("#Play").attr("disabled","disabled");
		$("#Slow").attr("disabled","disabled");
		$("#Fast").attr("disabled","disabled");
		$("#Resume").attr("disabled","disabled");
		$("#Pause i").css("color","#b31b1b");
		$("#Restart i").css("color","#29a693");
		$("#Play i").css("color","#212529");
		$("#Slow i").css("color","#212529");
		$("#Fast i").css("color","#212529");
		$("#Resume i").css("color","#212529");
		pause_animation = false;
		var x = window.scrollX;
		var y = window.scrollY;
		step1(x,y);
	});
	
	function sleep (time) {
	  return new Promise((resolve) => setTimeout(resolve, time));
	}
	
	function step1(x,y) 
	{
		changeText(0,4);
		$("#pseudocode").remove();
		$("#pseudo").append('<p class="green mt-2" id="pseudocode"><span class="yellow">Loop:</span> number-of-elements / 2 times \
		                     <br><span class="yellow"> Swap:</span> first element with last element \
		                     <br><span class="yellow"> Swap:</span> second element with second-to-last element</p>');
		window.scrollTo(x,y);
		$("#box0").animate({bottom: '177px'},std_speed);
		$("#box4").animate({bottom: '133px'},std_speed);
		++resume_pos;
		sleep(pauseShort).then(()=> {
			if(pause_animation === false)
				step2();
		});
	}
	function step2() 
	{
		$("#box0").animate({left:   '140px'},std_speed);
		$("#box4").animate({right:  '260px'},std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step3();
		});
	}
	function step3() 
	{
		$("#box0").delay(std_speed);
		$("#box4").delay(std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step4();
		});
	}
	function step4() 
	{
		$("#box0").animate({bottom:  '87px'},std_speed);
		$("#box4").delay(std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step5();
		});
	}
	function step5() 
	{
		$("#box0").delay(std_speed);
		$("#box4").animate({bottom: '177px'},std_speed);	  
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step6();
		});
	}
	function step6() 
	{
		$("#box0").animate({bottom: '133px'},std_speed);
		$("#box4").delay(std_speed);	  
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step7();
		});
	}
	function step7() 
	{					
		$("#box0").delay(std_speed);
		$("#box4").delay(std_speed);
		++resume_pos;
		sleep(pauseShort).then(()=> {
			if(pause_animation === false)
				step8();
		});
	}
	function step8() 
	{					
		$("#box0").animate({left:   '400px'},std_speed);
		$("#box4").animate({right:  '400px'},std_speed);
		++resume_pos;
		sleep(pauseShort).then(()=> {
			if(pause_animation === false)
				step9();
		});
	}
	function step9() 
	{					
		$("#box0").animate({top:        '0'},std_speed);
		$("#box4").animate({top:        '0'},std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step10();
		});
	}
	function step10() 
	{
		changeText(1,3);
		$("#box1").animate({bottom: '177px'},std_speed);
		$("#box3").animate({bottom: '133px'},std_speed);
		++resume_pos;
		sleep(pauseShort).then(()=> {
			if(pause_animation === false)
				step11();
		});
	}
	function step11() 
	{
		changeText(1,3);
		$("#box1").animate({left:    '40px'},std_speed);
		$("#box3").animate({right:  '160px'},std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step12();
		});
	}
	function step12() 
	{
		$("#box1").delay(std_speed);
		$("#box3").delay(std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step13();
		});
	}
	function step13() 
	{
		$("#box1").animate({bottom:  '87px'},std_speed);
		$("#box3").delay(std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step14();
		});
	}
	function step14() 
	{
		$("#box1").delay(std_speed);
		$("#box3").animate({bottom: '177px'},std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step15();
		});
	}
	function step15()
	{
		$("#box1").animate({bottom: '133px'},std_speed);
		$("#box3").delay(std_speed);
		++resume_pos;
		sleep(pauseLong).then(()=> {
			if(pause_animation === false)
				step16();
		});
	}
	function step16() 
	{
		$("#box1").delay(std_speed)
				  .animate({left:   '200px'},std_speed)
				  .animate({top:        '0'},std_speed);
		$("#box3").delay(std_speed)
				  .animate({right:  '200px'},std_speed)
				  .animate({top:        '0'},std_speed);
		++resume_pos; 
	}
 
	function changeText(x,y)
	{
		$("#eleX").html("Element[" + x + "]:");
		$("#eleY").html("Element[" + y + "]:");
	}
	
	$("#Restart").click(function($e){
		$e.preventDefault();
		$("#box0").stop(true).removeAttr("style");
		$("#box1").stop(true).removeAttr("style");
		$("#box3").stop(true).removeAttr("style");
		$("#box4").stop(true).removeAttr("style");
		$("#Play").removeAttr("disabled","disabled");
		$("#Play i").css("color","#2ab31b");
		$("#Pause").attr("disabled","disabled");
		$("#Pause i").css("color","#212529");
		$("#Resume").attr("disabled","disabled");
		$("#Resume i").css("color","#212529");
		$("#Slow").removeAttr("disabled","disabled");
		$("#Slow i").css("color","white");
		$("#Fast").removeAttr("disabled","disabled");
		$("#Fast i").css("color","white");				
		$("#eleX").html("Element[X]:");
		$("#eleY").html("Element[Y]:");
		resume_pos = 0;
		pause_animation = true;
		std_speed = 1000;
		delay_speed = 2000;
	});
	
	$("#Pause").click(function($e){
		$e.preventDefault();
		pause_animation = true;
		$("#Pause").attr("disabled","disabled");
		$("#Pause i").css("color","#212529");
		$("#Slow").removeAttr("disabled","disabled");
		$("#Slow i").css("color","white");
		$("#Fast").removeAttr("disabled","disabled");
		$("#Fast i").css("color","white");
		$("#Resume").removeAttr("disabled","disabled");
		$("#Resume i").css("color","#29a670");
	});
	
	$("#Slow").click(function($e){
		$e.preventDefault();
		if(std_speed == 1000) {
			std_speed = 2000;
			pauseShort = 2000;
			pauseLong = 3000;

		}
		else if(std_speed == 700) {
			std_speed = 1000;
			pauseShort = 1000;
			pauseLong = 2000;
		}
	});
	
	$("#Fast").click(function($e){
		$e.preventDefault();
		if(std_speed == 1000) {
			std_speed = 700;
			pauseShort = 700;
			pauseLong = 1400;

		}
		else if(std_speed == 2000) {
			std_speed = 1000;
			pauseShort = 1000;
			pauseLong = 2000;

		}
	});
	
	$("#Resume").click(function($e){
		$e.preventDefault();
		pause_animation = false;
		$("#Pause").removeAttr("disabled","disabled");
		$("#Pause i").css("color","#b31b1b");
		$("#Play").attr("disabled","disabled");
		$("#Slow").attr("disabled","disabled");
		$("#Slow i").css("color","#212529");
		$("#Fast i").css("color","#212529");
		switch(resume_pos) {
			case 1:
				step1();
				break;
			case 2:
				step2();
				break;
			case 3:
				step3();
				break;
			case 4:
				step4();
				break;
			case 5:
				step5();
				break;
			case 6:
				step6();
				break;
			case 7:
				step7();
				break;
			case 8:
				step8();
				break;
			case 9:
				step9();
				break;
			case 10:
				step10();
				break;
			case 11:
				step11();
				break;
			case 12:
				step12();
				break;
			case 13:
				step13();
				break;
			case 14:
				step14();
				break;
			case 15:
				step15();	
				break;
			case 16:
				step16();
		}
	});
});