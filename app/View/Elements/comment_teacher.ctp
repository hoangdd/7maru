<?php 
/* @hoangdd */
?>
<?php
	// @hoangdd - Comment layout
?>

<?php
	echo $this->Html->css('comment');
	if(empty($teacher_id)) die;
	//default <=> option
	$width = isset($width) ? $width : '100%';
	// $teacher_id default -> null
	$current_user = AuthComponent::user();

	//
	if( !isset($canComment) )
		$canComment = false;

?>

<?php if(isset($teacher_id)) : ?>
<?php echo $this->Html->scriptStart();?>
var teacher_id = <?php echo '"'.$teacher_id.'"'; ?>;
 $(document).ready(function(){
 	$(document).delegate('.comment a' , 'click', function(e){
 		e.preventDefault();
	});

 	$('.create-button').click(function(e){
 		e.preventDefault();
		$('html body').animate({
			'scrollTop': $('.new-comment').offset().top
		},400,function(){
	 		$('.new-comment').find('textarea').focus();
		});
 	});

 	$(document).delegate('.edit-button', 'click', function(){
 		comment = $(this).parents('.comment');
 		comment_id = comment.attr('comment_id');
 		content_children = comment.find('.comment-content').children();
 		$(content_children[0]).hide();
 		$(content_children[1]).show();
 		$(this).hide();
 		$(this).next().show();
 		$(this).next().next().show();
 	});
 	$(document).delegate('.save-button', 'click',function(){
 		saveButton = $(this);
		comment = saveButton.parents('.comment');
		comment_id = comment.attr('comment_id');
		content_children = comment.find('.comment-content').children();
		if($(content_children[1]).val() == ''){
			if(confirm("<?php echo __('Comment\'s content can not be empty. Do you want delete this comment?');?>")){
				//delete button
				saveButton.next().next().click();
			}else{
				//cancelbutton
				saveButton.next().click();
			}
		}
		//no changes
		if($(content_children[0]).text() == $(content_children[1]).val() ){
			//cancelbutton
			saveButton.next().click();
			return;
		}
 		$.ajax({
 			'url' : "<?php echo $this->Html->url(array(
 				'controller' => 'Student',
 				'action' => 'editComment'
 				));?>",
 			'type' : 'post',
 			'data' : {'comment_id':comment_id, 'content':$(content_children[1]).val()},
 			complete: function(res){
 				if(res.responseText == 1){
 					saveButton.prev().show();
	 				saveButton.hide();
	 				saveButton.next().hide();
	 				$(content_children[0]).text($(content_children[1]).val());
			 		alert("<?php echo __('Comment is updated')?>");
			 		$(content_children[0]).fadeIn(1000);
			 		$(content_children[1]).hide();	
 				}else{

 				}
 			}
 		});
 	});
 	$(document).delegate('.cancel-edit-button' , 'click', function(){
 		cancelEditButton = $(this);
 		cancelEditButton.hide();
 		cancelEditButton.prev().hide();
 		cancelEditButton.prev().prev().show();
 		comment = cancelEditButton.parents('.comment');
		comment_id = comment.attr('comment_id');
		content_children = comment.find('.comment-content').children();
		$(content_children[1]).val($(content_children[0]).text());
 		$(content_children[0]).show();
 		$(content_children[1]).hide();
 	});

 	$(document).delegate('.delete-button', 'click' , function(){
 		isAccepted = confirm("<?php echo __('Are you sure to delete this comment ');?>");
 		if( !isAccepted ) return; //cancel
 		deleteButton = $(this);
 		comment = deleteButton.parents('.comment');
 		comment_id = comment.attr('comment_id');
 		$.ajax({
 			'url' : "<?php echo $this->Html->url(array(
 				'controller' => 'Student',
 				'action' => 'deleteComment'
 				));?>",
 			'type' : 'post',
 			'data' : {'comment_id': comment_id},
 			complete: function(res){
 					console.log(res);
 				if(res.responseText == 1){
 					alert("<?php echo __('Comment is deleted')?>");
 					$(comment).fadeOut(1000);
 					//remove <hr> tag
 					$(comment).next().fadeOut(1000);
 				}else{
 					alert("<?php echo __('Had error! Please try again later')?>");
 				}
 			}
 		});
 	});

 	$('.new-comment textarea').keyup(function(){
 		if( $(this).val() !=''){
 			$('.new-comment .create-button').fadeIn(300);
 			$('.new-comment .cancel-button').fadeIn(300);
 		}else{
 			$('.new-comment .create-button').fadeOut(300);
 			$('.new-comment .cancel-button').fadeOut(300);
 		}
 	});

 	$('.new-comment .create-button').click(function(){
 		content = $('.new-comment textarea').val();
 		if(content == '') return;
 		$.ajax({
 			'url' : "<?php echo $this->Html->url(array(
 				'controller' => 'Student',
 				'action' => 'createComment'
 				));?>",
 			'type' : 'post',
 			'data' : {'teacher_id':teacher_id,'content':content},
 			complete: function(res){
 				if(res.responseText == 0){
 					alert("<?php echo __('Had error! Please try again later')?>");
 				}else{
 					// truoc ('.new-comment') co 1 <hr>
 					$('.new-comment').prev().before(res.responseText);
 					//animate
 					$('.new-comment').prev().prev().hide();
 					$('.new-comment').prev().prev().fadeIn(1000);

 					$('.new-comment textarea').val('');
 					$('.new-comment textarea').keyup();
 				}
 			}
 		});
 	});

 	$('.new-comment .cancel-button').click(function(e){
 		 	$('.new-comment .create-button').fadeOut(300);
 			$('.new-comment .cancel-button').fadeOut(300);
 			$('.new-comment textarea').val('');
 	});
 })
<?php echo $this->Html->scriptEnd();?>
	<div class = 'comment-area' style="width:<?php echo $width;?>">
		<div class='header'>
			<div><?php echo __('Comment');?></div>
			<?php if ($canComment && isset($_SESSION['Auth']['User']['user_id'])){ ?>
			<a href="#" class="create-button"> <?php echo __('Insert new comment');?></a>
			<?php } ?>
		</div>
		<?php 
		if(!empty($comments)) :
			foreach ($comments as $key => $value) : 
				$user = $value['User'];
				$comment = $value['CommentTeacher'];

				// > User da bi xoa, hoac khong ton tai
				if( !isset($user['user_id']) || empty ($user['user_id']))
					continue;
				echo $this->element('comment_element', array(
					'user' => $user,
					'comment' => $comment,
				));
			endforeach;
			endif; //if(!empty($comments)) :
		?>
		<hr>
		<?php if ( $canComment && isset($_SESSION['Auth']['User']['user_id'])){ ?>
		<div class = 'new-comment'>
			<textarea placeholder='<?php echo __("Insert your comment here");?>'></textarea>
			<div>
				<div class="action">
					<a class='create-button' href="#"><?php echo __('Save');?></a>
					<a class='cancel-button' href="#"><?php echo __('Cancel');?></a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
<?php 
	endif;
	// end -> if(isset($teacher_id)) 
	// debug($comments);
?>
