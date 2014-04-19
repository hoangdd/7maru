<?php
	echo $this->Html->script('jquery');
	echo $this->Html->css('flexpaper');
	echo $this->Html->script(array('flexpaper', 'flexpaper_handlers', 'flexpaper_handlers_debug','jwplayer/jwplayer','jwplayer/jwplayer.html5','jwplayer/jwpsrv'));	
?>
<?php 
	echo $this->element('playlist', array('current' => $file['Data']['file_id'],'list' => $list));

	$config = Configure::read('dataFile');
	$ext = pathinfo($file['Data']['path'], PATHINFO_EXTENSION);
?>
<div class="player-wrapper">
	<div id="player" class="flexpaper_viewer"></div>	
</div>
<?php 
	if( in_array($ext, $config['swf']['extension']) ){
?>
<script type="text/javascript">
	var startDocument = "Paper";
	$('#player').FlexPaperViewer(
			{ config : {
				SWFFile : <?php echo "'".$this->Html->url(array('controller' => 'Data','action' => 'file',$file['Data']['file_id']))."'" ?>,
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
</script>

<?php 
	}
	if( in_array($ext, $config['audio']['extension']) || in_array($ext, $config['video']['extension']) ){
?>
	<script type="text/javascript">
		jwplayer("player").setup({	
		file: <?php echo "'".$this->Html->url(array('controller' => 'Data','action' => 'file',$file['Data']['file_id']))."'" ?>,
		type:<?php echo "'".$file['Data']['type']."'" ?>,
		flashplayer: "/7maru/js/jwplayer/jwplayer.flash.swf",
		primary:"flash",
		startparam: "starttime",
		width: '100%',
	});
	</script>
<?php 
	}
?>

<?php
if( in_array($ext, $config['img']['extension']) ){
?>
<div style="width:100%;height:750px;overflow:auto">
	<?php
		$img = $this->Html->url(
			array(
				'controller' => 'Data',
				'action' => 'file',
				$file['Data']['file_id']
				)
			);
		echo '<img src="'.$img.'" alt="Smiley face" width="100%">';
	?>
</div>
<?php
}
?>

<?php //comment ?>
<?php
	$option = array(
		'width' => '100%', 
		'file_id' => $file['Data']['file_id'],
		'comments' => !empty($comments) ? $comments : array(),
	);
	echo $this->element('comment', $option);
?>

<script>
	$("document").ready(function(){
		document.addEventListener("contextmenu", function(e){
	    e.preventDefault();
			}, false);
	})
</script>

