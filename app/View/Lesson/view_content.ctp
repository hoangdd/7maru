<?php
	echo $this->Html->script('jquery');
	echo $this->Html->css('flexpaper');
	echo $this->Html->script(array('flexpaper', 'flexpaper_handlers', 'flexpaper_handlers_debug','jwplayer/jwplayer','jwplayer/jwplayer.html5','jwplayer/jwpsrv', 'view_file_encrypt.js'));	
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
<div class="load-file">
<script type="text/javascript">
	$(document).ready(function(){
		if( typeof view_swf_file == 'function'){
			view_swf_file("<?php echo $file['Data']['file_id'].'?token='.$token;?>");
		}
	});
</script>
</div>
<?php 
	}
	if( in_array($ext, $config['audio']['extension']) || in_array($ext, $config['video']['extension']) ){
?>
<div class="load-file">
<script type="text/javascript">
	$(document).ready(function(){
		if( typeof view_media_file == 'function'){
			view_media_file("<?php echo $file['Data']['file_id'].'?token='.$token;?>", "<?php echo $file['Data']['type'];?>");
		}
	});
</script>
</div>
<?php 
	}
?>

<?php
if( in_array($ext, $config['img']['extension']) ){
?>
<div class="load-file">
<script type="text/javascript">
	$(document).ready(function(){
		if( typeof view_image_file == 'function'){
			view_image_file("<?php echo $file['Data']['file_id'].'?token='.$token;?>");
		}
	});
</script>
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

<script type="text/javascript">
	$("document").ready(function(){
		$('.load-file').remove();
		document.addEventListener("contextmenu", function(e){
	    e.preventDefault();
			}, false);
	})
</script>

