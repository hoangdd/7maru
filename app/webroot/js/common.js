function idle(){
	$('body').html('');
	$.ajax({
		'url' : "/7maru/Login/logout"
		});
	window.location = "/7maru/Login";
}
$(window).blur('focus', function(){
	setTimeout(idle, 30*1000);
});