<?php
	echo $this->Html->css('flexpaper');
	echo $this->Html->script(array('flexpaper', 'flexpaper_handlers', 'flexpaper_handlers_debug','jwplayer/jwplayer'));	
	?>
<?php 
	if ($file['Data']['type'] == 'pdf'){		
?>
<div style="/*position:absolute;left:10px;top:10px*/;">
<div id="documentViewer" class="flexpaper_viewer" style="width:770px;height:500px"></div>
<script type="text/javascript">	
	function getDocumentUrl(document){
		// return "php/services/view.php?doc={doc}&format={format}&page={page}".replace("{doc}",document);
	}

	var startDocument = "Paper";

	$('#documentViewer').FlexPaperViewer(
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
				UIConfig : "http://localhost/7maru/js/UI_Zine.xml",

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

</div>

<?php 
	} else{
?>
?>
	<div id="container">loading </div>
	<script type="text/javascript">
		jwplayer("container").setup({	
		file: <?php echo "'".$this->Html->url(array('controller' => 'Data','action' => 'file',$file['Data']['file_id']))."'" ?>,
		type:<?php echo "'".$file['Data']['type']."'" ?>

	});
	</script>
<?php 
	}
?>