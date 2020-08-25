$(document).ready(function(){
	$(".inputbox").focus(function(){
		$(this).css("background-color", "#FD6");
	});
	$(".inputbox").blur(function(){
		$(this).css("background-color", "white");
	});
});