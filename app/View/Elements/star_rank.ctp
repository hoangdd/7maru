<?php

$__MAX_RANK = 5;
	//=======================
	//Option for width, height of star rank	
	// If option is null, use default value for it
$defaultWidth = 40;
$defaultHeight = 40;		
if (!isset($options['width'])){ 
	$options['width'] = $defaultWidth;	
}
if (!isset($options['height'])){
	$options['height'] = $defaultHeight;
}
// allow rating or not 
$rateAllow = 1; //default
if (isset($options['rateAllow']))
	$rateAllow = $options['rateAllow'];
	//=======================
	//image file name
$brightStarImage = 'star.png';
$blurStarImage = 'blurStar.png';
	//=======================
	// Caculate width to show rank
$containerWidth = $options['width'] * $__MAX_RANK;	
$containerHeight = $options['height'];
$brightStarWidth = 100*$options['stars'] / $__MAX_RANK;
$coma_id = $options['coma_id'];
$action = $this->Html->url(array('contronller' => 'lesson','action' => 'rate'));
$user_id = 'null';
if(isset($options['action']) && isset($options['user_id'])){
	$action = $options['action'];
	$user_id = $options['user_id'];	
}
	//=======================	
?>
<script type="text/javascript">
$(document).ready(function(){
	//==========================
	//to rating
	var containerWidth = <?php echo $containerWidth; ?>;
	var brightStarWidth = <?php echo $brightStarWidth; ?>;
	var coma_id = <?php echo $coma_id ?>;
	var maxWidth  = $("#star-container-"+coma_id).width();
	var action = <?php echo "'$action';"; ?>
	var user_id = <?php echo "'$user_id';"; ?>
	var coma_id = <?php echo "'$coma_id';"; ?>
	var rateAllow = <?php echo $rateAllow ?>;
	var rateText = {
		0 : '',
		1 : '<?php echo __("Normal")?>',
		2 : '<?php echo __("Good")?>',
		3 : '<?php echo __("Very good")?>',
		4 : '<?php echo __("Excellent")?>',
		5 : '<?php echo __("Awesome")?>',
	};
	if (rateAllow){
		$("#star-container-"+coma_id).mousemove(function(e){
			var mouseReLeftPos = (e.pageX - $(this).offset().left );
			var rate = 100 * Math.round(5 * mouseReLeftPos / containerWidth) / 5;				
			$("#bright-star-div-"+coma_id).width(rate + "%");	
		});	
		$("#star-container-"+coma_id).mouseleave(function(e){		
			$("#bright-star-div-"+coma_id).width(brightStarWidth + "%");
		})
		$("#star-container-"+coma_id+' .star-div').click(function(e){
			var mouseReLeftPos = (e.pageX - $(this).offset().left );
			var rate = 100 * Math.round(5 * mouseReLeftPos / containerWidth) / 5;	
			$('.rate-text').text(rateText[rate/20]);
			brightStarWidth = rate;
			$("#bright-star-div-"+coma_id).width(rate + "%");

		// ajax
			$.post(
				action, 
				{
					'coma_id': coma_id,
					'user_id': user_id,
					'rate': Math.round(rate / 20)
				},
				function(error, res){
					res;
				}
				);
	})
	}
	//==========================
})
</script>

<style>
.star-div{
	height: 100%;
	cursor:pointer;
	background-size: <?php echo $options['width'].'px '.$options['height'].'px' ?>;
}
div#star-container-<?php echo $coma_id ?>{
	margin:auto;
	width:<?php echo $containerWidth ?>px;
	height: <?php echo $containerHeight ?>px;	
	margin-bottom: 50px;
}
div#blur-star-div-<?php echo $coma_id ?>{
	width:100% ;	
	background-image: url(<?php echo $this->webroot.'img/'.$blurStarImage ?>); 
}
div#bright-star-div-<?php echo $coma_id ?>{
	width: <?php echo $brightStarWidth."%;" ?>;
	background-image: url(<?php echo $this->webroot.'img/'.$brightStarImage ?>); 
}

</style>
<div class="row text-center">
	<div id="star-container-<?php echo $coma_id ?>">
		<div>
			<?php echo __('Good!');?>
		</div>
		<div class="star-div" id = "blur-star-div-<?php echo $coma_id ?>">
			<div class="star-div" id = "bright-star-div-<?php echo $coma_id ?>">
			</div>
		</div>
		<div class='rate-text'>
		</div>
	</div>
</div>
