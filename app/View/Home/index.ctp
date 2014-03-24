<?php
/**
	Controller: Home
	Action : index
	@HoangDD
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
	echo $this->element('menu_intro');
?>
</div>
<?php
//-------------------------------------------------TAG--------------------------------------------------------------
// Page 2
$tags = array(
	'HotLesson' => array(
		'action' => 'HotLesson',
		'label' => 'Hot',
		),
	'NewLesson' => array(
		'action' => 'NewLesson',
		'label' => 'New',
		),
	'Bestseller' => array(
		'action' => 'Bestseller',
		'label' => 'Best seller',
		),
	'RecentLesson' => array(
		'action' => 'RecentLesson',
		'label' => 'Recent',
		)
	)
?>	
<?php echo $this->Html->scriptStart();?>
var tags = $.parseJSON('<?php echo json_encode($tags);?>');
var hot_count = 1;
$(document).ready(function(){
	$.ajax({
		'url' : '<?php echo $this->Html->url(array(
			"controller" => "Lesson", 
			"action" => "HotLesson",
			1
			));?>',
		complete : function(res){
			$('#hot-list').html(res.responseText);
			hot_count++;
		}
	});
	$('.next-button').click(function(){
		action = $(this).attr('action');
		switch(action){
			case 'HotLesson':
				count = hot_count;
				break;
			default:
				return;
		}
		if(count<0) return;
		$.ajax({
			'url' : '<?php echo $this->Html->url(array(
				"controller" => "Lesson", 
				"action" => "HotLesson",
				));?>/'+count,
			complete : function(res){
				if( res.responseText!=0 ){
					$('#hot-list').append(res.responseText);
					count++;
				}else{
					count = -1;
				}
				//update count
				switch(action){
					case 'HotLesson':
						hot_count = count;
						break;
					default:
						return;
				}
			}
		});
	});
});
<?php echo $this->Html->scriptEnd();?>

<?php 
foreach($tags as $tag) :
?>
	<hr>
	<div id='<?php echo $tag['action']?>' class="page">
		<button class='prev-button' action ='<?php echo $tag['action']?>' ><span class="glyphicon glyphicon-chevron-left"></span></button>
		<button class='next-button' action ='<?php echo $tag['action']?>' ><span class="glyphicon glyphicon-chevron-right"></span></button>
		<div class='lesson-bar' >
			<ul id ='hot-list' action='<?php echo $tag['action']?>'  class="bk-list clearfix">
			</ul>
		</div>
	</div>

<?php 
	break;
	endforeach;
?>
