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
	//=======================
	//image file name
$brightStarImage = 'star.png';
$blurStarImage = 'blurStar.png';
	//=======================
	// Caculate width to show rank
$containerWidth = $options['width'] * $__MAX_RANK;	
$containerHeight = $options['height'];
$brightStarWidth = 100*$options['stars'] / $__MAX_RANK;
	//=======================	
?>
<script>
$(document).ready(function(){
	//==========================
	//to rating
	var containerWidth = <?php echo $containerWidth; ?>;
	var brightStarWidth = <?php echo $brightStarWidth; ?>;
	var maxWidth  = $("#star-container").width();
	$("#star-container").mousemove(function(e){
		var mouseReLeftPos = (e.pageX - $(this).offset().left );
		var rate = 100 * mouseReLeftPos / containerWidth;				
		$("#bright-star-div").width(rate + "%");	
	});	
	$("#star-container").mouseleave(function(e){		
			$("#bright-star-div").width(brightStarWidth + "%");
	})
	$("#star-container").click(function(e){
		var mouseReLeftPos = (e.pageX - $(this).offset().left );
		var rate = 100 * mouseReLeftPos / containerWidth;				
		brightStarWidth = rate;		
		$("#bright-star-div").width(rate + "%");
	})

	//==========================
})
</script>

<style>
.star-div{
	height: 100%;
	background-size: <?php echo $options['width'].'px '.$options['height'].'px' ?>;
}
div#star-container{
	margin:auto;
	width:<?php echo $containerWidth ?>px;
	height: <?php echo $containerHeight ?>px;	
}
div#blur-star-div{
	width:100% ;	
	background-image: url(<?php echo $this->webroot.'img/'.$blurStarImage ?>); 
}
div#bright-star-div{
	width: <?php echo $brightStarWidth."%;" ?>;
	background-image: url(<?php echo $this->webroot.'img/'.$brightStarImage ?>); 
}

</style>
<div class="row text-center" id='star-wrapper'>
	<div id="star-container">
		<div class="star-div" id = "blur-star-div">
			<div class="star-div" id = "bright-star-div">
			</div>
		</div>
	</div>
</div>
