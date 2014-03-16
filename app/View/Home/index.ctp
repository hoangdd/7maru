<?php
/**
	Controller: Home
	Action : index
	#1- Wireframe(12/2/2014 10:00 PM ) @HoangDD
*/
?>
<?php
	$roles = array('guest', 'student', 'teacher', 'admin');
	$sns_link = array(
		'fb' => 'http://www.facebook.com',
		'tw' => 'http://www.twitter.com',
		'gp' => 'http://plus.google.com'
		);
	$tags = array(
		'hot' => '#hot',
		'recent' => '#recent',
		'best buy' => '#bb',
		'etc' => '#etc'
		);
	$cover = array(
		'resource/intro.jpg',
		'resource/intro.jpg',
		'resource/intro.jpg',
	);
?>


<?php
// Page 1
?>

<style type="text/css">
	.nav-inverse nav a span{
		color: gray;
	}
	.intro-menu-fixed{
		position: fixed;
		top: 0px;
		z-index: 2 !important;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(window).scroll(function(){
			page1bottom = $('.page:first').offset().top + $('.page:first').height();
			narbottom = $('.nav.page-nav').offset().top + $('.nav.page-nav').height();
			if(narbottom>page1bottom){
				$('.page:first').addClass('nav-inverse');
			}else{
				$('.page:first').removeClass('nav-inverse');
			}

			if(narbottom>page1bottom+350){
				$('#intro-menu').addClass('intro-menu-fixed');
			}else{
				$('#intro-menu').removeClass('intro-menu-fixed');
			}
		})
	});
</script>
<div class="page">

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		    <div class="item active">
		      <?php echo $this->Html->image('resource/intro.jpg');?>
		      <div class="carousel-caption">
		      </div>
		    </div>
		    <div class="item">
		      <?php echo $this->Html->image('resource/intro2.jpg');?>
		      <div class="carousel-caption">
		      </div>
		    </div>
		    <div class="item">
		      <?php echo $this->Html->image('resource/intro.jpg');?>
		      <div class="carousel-caption">
		      </div>
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	</div>

	<div class="sns-connect">
		<?php 
			echo __('Connect us ');
			echo $this->Html->image('resource/facebook.png', 
					array(
						'alt' => 'Connect to facebook',
						'url' => $sns_link['fb'],
						'class' => 'sns-connect-image'
					));
			echo $this->Html->image('resource/twitter.png', 
					array(
						'alt' => 'Connect to twitter',
						'url' => $sns_link['tw'],
						'class' => 'sns-connect-image'
					));
			echo $this->Html->image('resource/google-plus.png', 
					array(
						'alt' => 'Connect to google plus',
						'url' => $sns_link['gp'],
						'class' => 'sns-connect-image'
					));
		?>
	</div>

<div class="nav page-nav">
	<nav class="cl-effect-5">
		<?php
			foreach ($tags as $key => $value) {
				echo "<a style='height:30px' href='".$value."'><span data-hover='".$key."'>".$key."</span></a>";
			}
		?>
	</nav>
</div> 

</div>
<div id='intro-menu'>
<?php
	echo $this->element('menu');
?>
</div>
<?php
// Page 2
?>	

<div id='hot' class="page">
	<div style="margin:auto;width:70%">
		<?php
			echo $this->element('lesson_list');
		?>
	</div>
</div>

<?php
// Page 3
?>	

<div class="page">
	<div id='recent' class="page">
		<div style="margin:auto;width:70%">
			<?php
				echo $this->element('lesson_list');
			?>
		</div>
	</div>
</div>


<?php
// Page 4
?>	

<div class="page">
	<div id='bb' class="page">
		<div style="margin:auto;width:70%">
			<?php
				echo $this->element('lesson_list');
			?>
		</div>
	</div>
</div>

<?php
// Page 5
?>	

<div class="page">
	<div id='etc' class="page">
		<div style="margin:auto;width:70%">
			<?php
				echo $this->element('lesson_list');
			?>
		</div>
	</div>
</div>
