<?php
/**
	Controller: Home
	Action : index
	@HoangDD
*/
?>
<?php
	echo $this->Html->css('component');
	echo $this->Html->css('lesson');
?>
<?php
	$role = $user['role'];
	$sns_link = array(
		'fb' => 'http://www.facebook.com',
		'tw' => 'http://www.twitter.com',
		'gp' => 'http://plus.google.com'
		);
	switch ($role) {
		case 'R1':
		// Admin...
		$tags = array(
			'HotLesson' => array(
				'action' => 'HotLesson',
				'label' => __('Hot'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "HotLesson",
					)
				),
				),
			'NewLesson' => array(
				'action' => 'NewLesson',
				'label' => __('New'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "NewLesson",
					)
				),
				),
			'Bestseller' => array(
				'action' => 'Bestseller',
				'label' => __('Best'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "Bestseller",
					)
				),
				),
			);
		break;

		case 'R2':
		// teacher...
		$tags = array(
			'RecentLesson' => array(
				'action' => 'RecentLesson',
				'label' => __('Recent'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "RecentLesson",
					)
				),
				)
			);
		break;

		case 'R3':
		// student...
		$tags = array(
			'HotLesson' => array(
				'action' => 'HotLesson',
				'label' => __('Hot'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "HotLesson",
					)
				),
				),
			'NewLesson' => array(
				'action' => 'NewLesson',
				'label' => __('New'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "NewLesson",
					)
				),
				),
			'Bestseller' => array(
				'action' => 'Bestseller',
				'label' => __('Best'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "Bestseller",
					)
				),
				),
			'RecentLesson' => array(
				'action' => 'RecentLesson',
				'label' => __('Recent'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "RecentLesson",
					)
				),
				)
			);
		break;

		case 'R4':
		// guest...
		$tags = array(
			'HotLesson' => array(
				'action' => 'HotLesson',
				'label' => __('Hot'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "HotLesson",
					)
				),
				),
			'NewLesson' => array(
				'action' => 'NewLesson',
				'label' => __('New'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "NewLesson",
					)
				),
				),
			'Bestseller' => array(
				'action' => 'Bestseller',
				'label' => __('Best'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "Bestseller",
					)
				),
				),
			'RecentLesson' => array(
				'action' => 'RecentLesson',
				'label' => __('Recent'),
				'page' => 1,
				'max' => -1,
				'view' => 1,
				'url' => $this->Html->url(array(
					"controller" => "Lesson", 
					"action" => "RecentLesson",
					)
				),
				)
			);
		break;

		default:
					// code...
		$tags = array(
			);
		break;
		}
			
	$cover = array(
		'resource/intro.jpg',
		'resource/intro.jpg',
		'resource/intro.jpg',
	);
?>


<?php
// Page 1
?>
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

			if( narbottom > page1bottom + 350 ){
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
			if(isset($value['action'])&&isset($value['label']))
				echo "<a style='height:30px' href='#".$value['action']."'><span data-hover='".$value['label']."'>".$value['label']."</span></a>";
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

?>	
<?php echo $this->Html->scriptStart();?>
var tags = $.parseJSON('<?php echo json_encode($tags);?>');
$(document).ready(function(){
	function firstLoad(){
		for (var key in tags) {
			if(typeof key != 'undefined'){
				tagObject = tags[key];
				$.ajax({
					'url' : tagObject.url+'/1',
					'async' : false, //importain
					complete : function(res){
						if( res.responseText != 0 ){
							$('#'+tagObject.action).find('ul.bk-list').html(res.responseText);
							tagObject.page++;
						}else{
							$('#'+tagObject.action).find('ul.bk-list').html('<?php echo $this->Html->image("no_data.png");?>');
						}
					}
				});
			}
		}
	}
	//first loading
	firstLoad();

	$('.next-button').click(function(){
		var action = $(this).attr('action');
		var listObject, list;

		//get current state
		listObject = tags[action];
		list = $('#'+listObject.action).find('ul.bk-list');
		url = listObject.url+'/'+ listObject.page;




		if( listObject.max > 0 && listObject.page >= listObject.max ){
			//load xong tat ca, xu li slide
			if(listObject.view >= listObject.page - 1) return; //in the end
			n = 4*listObject.view;
			child = list.find('li:nth('+n+')');
			list.animate({'left': list.offset().left-child.offset().left+30}, 600);
			listObject.view++;
			return;
		}
		//ajax load them trang
		$.ajax({
			'url' : url,
			complete : function(res){
				if( res.responseText!=0 ){
					//append data
					list.append(res.responseText);
					n = 4*listObject.view;
					child = list.find('li:nth('+n+')');
					list.animate({'left': list.offset().left-child.offset().left+30}, 600);
					listObject.page++;
					listObject.view++;
				}else{
					//end => set max
					console.log('het cmnr roi');
					listObject.max = listObject.page;
				}
			}
		});
	});
	
	$('.prev-button').click(function(){
		var action = $(this).attr('action');
		var listObject, list;
		//get current state
		listObject = tags[action];
		list = $('#'+listObject.action).find('ul.bk-list');
		
		if( listObject.view > 1){
			//slide back
			n = 4*listObject.view-8;
			if( n < 0 ) return; //at first
			child = list.find('li:nth('+n+')');
			list.animate({'left': list.offset().left-child.offset().left+30}, 600);
			listObject.view--;
		}
	})
});
<?php echo $this->Html->scriptEnd();?>

<?php 
foreach($tags as $tag) :
?>
	<hr>
	<div id='<?php echo $tag['action']?>' class="page">
		<div class='lesson-wrapper'>
			<a class='control-button left prev-button' action ='<?php echo $tag['action']?>' ><span class="glyphicon glyphicon-chevron-left"></span></a>

			<div class='lesson-bar'>
				<ul action='<?php echo $tag['action']?>'  class="bk-list clearfix">
				</ul>
			</div>

			<a class='control-button right next-button' action ='<?php echo $tag['action']?>' ><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>

<?php 
endforeach;
?>

<script>
	$(document).ready(function(){
		$(".buy-button").click(function(){			
			var r = confirm("<?php echo __('Confirm') ?>");
			var id = $(this).attr('id');
			var coma_id = id.slice(11);
			var result = false;
			if (r == true){  				  		
					$.get(
						"<?php echo $this->Html->url(array('controller' => 'Lesson','action' => 'buy')) ?>" + "/" +  coma_id,
						function(data){							
							if (data.trim() === "1"){
								alert("<?php echo __('Transaction successfully') ?>");							
								result = true;
							}							
						}
					);
				if (result){
					//deactive button
				}
	  		}	  		
  		})
	});
</script>
