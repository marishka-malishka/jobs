$(document).ready(function(){
	$('#comments .item .open_button').click(function(){
		$(this).siblings('.content').slideToggle(300);
		return false;
	});
});
