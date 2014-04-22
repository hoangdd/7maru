if(typeof(idle_time) === 'undefined' ) idle_time =  60 * 1000 ;
var flag = false;
// var window_focus = ;
var isTyping = false;
var isMouseMoving = false;
function idle(){
	$('body').html('');
	$.ajax({
		'url' : "/7maru/Login/logout",
		complete : function(){
			window.location = "/7maru/Login";
		}
		});
	$.ajax({
		'url' : "/7maru/Admin/logout",
		complete : function(){
			window.location = "/7maru/Admin/Login";
		}
		});
	// console.log("die");
}
$(window).focus(function(){
	if(flag){
		idle();
	}
	// window_focus = true;
});
timeout = setTimeout(forceLogout, idle_time);
$(window).blur('focus', function(){
	resetTimeout();
	// window_focus = false;
});
$(document).on('mousemove',function(){
	resetTimeout();
})
$(document).on('keydown',function(){
	resetTimeout();
})

function resetTimeout(){
	if(flag){
		idle();
	} else {
		clearTimeout(timeout);
		timeout = setTimeout(forceLogout, idle_time);
	}
}

function forceLogout(){
	flag = true;
	if(document.hasFocus()){
		idle();
	}
}