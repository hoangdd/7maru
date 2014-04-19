<?php 
	echo $this->Html->script(array('jwplayer/jwplayer','jwplayer/jwplayer.html5','jwplayer/jwpsrv'));	
?>
<div class="player-wrapper">
	<div id="bg-player" class="flexpaper_viewer"></div>	
</div>
<script type="text/javascript">
	jwplayer("bg-player").setup({	
		file: '/7maru/files/bg.mp4',
		type: 'mp4',
		primary:"flash",
		autostart : 'true',
		startparam: "starttime",
		width: '100%',
		height: '1000px'
	});
</script>
