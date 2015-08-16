document.ontouchmove = function(event){
    event.preventDefault();
    event.stopPropagation();
}




// JavaScript Document
$(function() {
	$('.headback').click(function(){
		//history.back();
		});
	$('.pbuy').click(function(){
		location.href='http://jmall.jd.com/p75125.html';
		console.log(location.href);
		});
		
	
		
	
});
