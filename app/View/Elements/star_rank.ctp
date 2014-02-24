<?php
	$__MAX_RANK = 5;		
	$defaultWidth = 40;
	$defaultHeight = 40;	
	$starsImage = 'star.png';
	$starsBlurImage = 'blurStar.png';
	if (!isset($options['width'])) $options['width'] = $defaultWidth;
	if (!isset($options['height'])) $options['height'] = $defaultHeight;			
	$containerWidth = $options['width'] *5;
	$rateWidth = 100*$options['stars']/$__MAX_RANK;
	$backgroundSize = "background-size:".$options['width']."px;"." ".$options['height']."px;";
	$backgroundStarsImage = "background-image: url(./img/".$starsImage.");";
	$backgroundStarsBlurImage = "background-image: url(./img/".$starsBlurImage.");";
	$divBrightStarSize = "width:".$rateWidth."%;"."height: 100%;";
	$divBlurStarSize = "width:100%;height: 100%;";
	$styleContainer = "'"."width: ".$containerWidth."px;height:".$options['height']."px;"."'"; 
	$styleBrightStar = "'".$divBrightStarSize.$backgroundStarsImage.$backgroundSize."'";
	$styleBlurStar = "'".$divBlurStarSize.$backgroundStarsBlurImage.$backgroundSize."'";


?>

<div style=<?php echo $styleContainer; ?>  >

	<div class="star-div" style = <?php echo $styleBlurStar; ?> >
	<div class="star-div" style=  <?php echo $styleBrightStar; ?> >

	</div>
	</div>
</div>

<style>
	.star-div{
		position:relative;
		top: 0;left:0;		
		height:100%;
	}
</style>