<?php
    $token = 'xxx';
	echo $this->Html->script('jquery');
	echo $this->Html->css('flexpaper');
	echo $this->Html->script(array('flexpaper', 'flexpaper_handlers', 'flexpaper_handlers_debug','jwplayer/jwplayer','jwplayer/jwplayer.html5','jwplayer/jwpsrv', 'view_file.js'));	
?>
<ul class="nav nav-tabs" id="lessonMenuTab">
  <li class="active"><a href="#lessonName" data-toggle="tab"><b><?php echo __('Lesson');?></b></a></li>
  <li><a href="#studentList" data-toggle="tab"><b><?php echo __('Buying Lists');?></b></a></li>
  <li><a href="#rate" data-toggle="tab"><b><?php echo __('Liking Lists');?></b></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="lessonName"><h1><?php if(!empty($lessonName)) echo($lessonName); ?></h1></div>
  <div class="tab-pane" id="studentList">
  		<div class="panel panel-default">
  			<div class="panel-heading">
  				<?php 
  					echo $this->Html->link(__('Block Student List'), array(
						'controller' => 'Teacher',
						'action' => 'addBlockStudent'
					));
  				?>
  			</div>
		  <!-- Table -->
		  <table class="table">
		  	<thead>
		  		<tr>
		  			<td>
		  				<b><?php echo __('No');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Username');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('First Name');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Last Name');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Block');?></b>
		  			</td>
		  		</tr>
		  	</thead>
		  	<tbody>
			    <?php 
			    	if( !empty($stdList)){
			    		$i = 0;
			    		foreach ($stdList as $key => $value) :
				?>
							<td><?php echo($i+1);?></td>
							<td>
								<?php echo $this->Html->link($value['User']['username'], array(
										'controller' => 'Student',
										'action' => 'Profile',
										$value['User']['user_id']
									), array());
								?>
							</td>
							<td><?php echo($value['User']['firstname'])?></td>
							<td><?php echo($value['User']['lastname'])?></td>
							<td><?php echo $this->Html->link(__('Block'),array('controller' => 'Teacher','action' => 'addBlockStudent',$value['User']['user_id']),array('class' => 'block_link'));
							?>
							</td>
			</tbody>
			<?php
					$i++;
					endforeach;
				}
		    ?>
		  </table>
		</div>
  </div>
  <div class="tab-pane" id="rate">
  	<div class="panel panel-default">
		  <!-- Table -->
		  <table class="table">
		  	<thead>
		  		
		  		<tr>
		  			<td>
		  				<b><?php echo __('No');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Username');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Liked Point');?></b>
		  			</td>
		  		</tr>

		  	</thead>
		  	<tbody>
			    <?php 
			    	if( !empty($rateList)){
			    		$i = 0;
			    		foreach ($rateList as $key => $value) :
				?>
							<td><?php echo($i+1);?></td>
							<td>
								<?php echo $this->Html->link($value['User']['username'], array(
										'controller' => 'Student',
										'action' => 'Profile',
										$value['User']['user_id']
									), array());
								?>
							</td>
							<td><?php echo($value['RateLesson']['rate'])?></td>
			</tbody>
			<?php
					$i++;
					endforeach;
				}
		    ?>
		  </table>
	</div>
  </div>
</div>
<hr>

<!-- =================================== -->

<script>
$(document).ready(function(){
	$('a.block_link').click(function(){
		var src = $(this).attr('href');
		var a = $(this);
		$.get(
			src,            	
			function(data){
				console.log(data);
				if (data.trim() == '1') {
					alert("<?php echo __('Successful') ?>");
					var tr = a.parent().parent();
					tr.replaceWith("");
				}else{
					alert("<?php echo __('Error') ?>");
				}
			}
			);
		return false;
	})
});
</script>

<!-- =================================== -->

<script type="text/javascript">
  $('#lessonMenuTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

<!--==================================== -->

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
		// $('.load-file').remove();
		document.addEventListener("contextmenu", function(e){
	    e.preventDefault();
			}, false);
	})
</script>
