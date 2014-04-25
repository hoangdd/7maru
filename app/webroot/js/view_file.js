var startDocument = "Paper";
function view_swf_file(id){
	$('#player').FlexPaperViewer(
		{ config : {
			SWFFile : '/7maru/Data/file/'+id,
			Scale : 0.6,
			ZoomTransition : 'easeOut',
			ZoomTime : 0.5,
			ZoomInterval : 0.2,
			FitPageOnLoad : true,
			FitWidthOnLoad : false,
			FullScreenAsMaxWindow : false,
			ProgressiveLoading : false,
			MinZoomSize : 0.2,
			MaxZoomSize : 5,
			SearchMatchAll : false,
			InitViewMode : 'Portrait',
			RenderingOrder : 'flash,html',
			StartAtPage : '',
			ViewModeToolsVisible : true,
			ZoomToolsVisible : true,
			NavToolsVisible : true,
			CursorToolsVisible : true,
			SearchToolsVisible : true,
			WMode : 'window',
			localeChain: 'en_US'
		}}
	);
};

function view_media_file(id, file_type){
	jwplayer("player").setup({	
		file: '/7maru/Data/file/'+id,
		type: file_type,
		flashplayer: "/7maru/js/jwplayer/jwplayer.flash.swf",
		// startparam: "starttime",
		autostart : true,
		width: '100%',
	});
	var isComplete = false;

	$('#player').click(function(){
		if(isComplete){
			$('#player').css({'opacity':0});
			window.location.reload();
			return false;
		}
	});
	jwplayer("player").onComplete(function(){
		isComplete = true;
	});
}
function view_image_file(id){
	$('#player').css({
		'width' : '100%',
		'height' : '750px',
		'overflow' : 'auto',
	});
	$('#player').html('<img src="/7maru/Data/file/'+id+'" alt="Smiley face" width="100%">');
}
