<?php
	echo $this->Html->script('jquery');
	echo $this->Html->css('flexpaper');
	echo $this->Html->script(array('flexpaper', 'flexpaper_handlers', 'flexpaper_handlers_debug','jwplayer/jwplayer','jwplayer/jwplayer.html5','jwplayer/jwpsrv'));	
?>
<div id="player" class="flexpaper_viewer" style="width:770px;height:500px"></div>	
<?php 
	if ($file['Data']['type'] == 'pdf'){		
?>
<script type="text/javascript">
	var startDocument = "Paper";
	$('#player').FlexPaperViewer(
			{ config : {

				SWFFile : "<?php echo $this->Html->url(array(
							'controller' => 'Data',
							'action' => 'file',
							$file['Data']['file_id']
						)
					);?>",
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
	} else{
?>
	<script type="text/javascript">
		jwplayer("player").setup({	
		file: <?php echo "'".$this->Html->url(array('controller' => 'Data','action' => 'file',$file['Data']['file_id']))."'" ?>,
		type:<?php echo "'".$file['Data']['type']."'" ?>,
		flashplayer: "/7maru/js/jwplayer/jwplayer.flash.swf",
		primary:"flash",
		startparam: "starttime",

	});
	</script>
<?php 
	}
?>

<?php //playlist ?>
<div>
	
</div>

<?php //comment ?>
<div>
	<?php
		$option = array(
			'width' => '480px', 
			'file_id' => $file['Data']['file_id'],
			'comments' => !empty($comments) ? $comments : array(),
		);
		echo $this->element('comment', $option);
	?>
</div>
