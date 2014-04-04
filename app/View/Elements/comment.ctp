<?php
	// @hoangdd - Comment layout
?>
<style type="text/css">
	.comment-area{
		min-height: 200px;

		/*debug mode*/
		border: solid 1px black;
	}
	.comment-area .comment{
		min-height: 100px;
		margin: 10px;

		/*debug mode*/
		border: solid 1px black;
	}
	.comment > .commentator-info{
		text-align: center;
		width: 100px;
		/*debug mode*/
		border: solid 1px black;
		// background-color: blue;
	}
	.commentator-info >.image-profile{
		width: 75px;
		height: 75px;
	}
	.commentator-info > a{
		display: block;
		text-decoration: none;
		width: 75px;
		overflow: hidden;
	}
	.comment .comment-content{

		/*debug mode*/
		border: solid 1px black;
	}
	.comment-content > textarea{
		width: 100%;
		display: none;
	}
	.comment-content > .action {
		margin-bottom: 50px;
	}
	.comment-content > .action > span{
		float: right;
		margin: 10px;
	}
	.comment-content > .action  .save-button,
	.comment-content > .action .create-button,
	.comment-content > .action .cancel-button,
	.comment-content > .action .cancel-edit-button {
		display: none;
	}
</style>
<?php

	//default <=> option

	$width = isset($width) ? $width : '100%';
	// $comma_id default -> null
	$current_user = AuthComponent::user();
?>
<?php echo $this->Html->scriptStart();?>
var comma_id = <?php echo($comments[0]['Comment']['coma_id']) ?>;
 $(document).ready(function(){
 	$(document).delegate('.comment a' , 'click', function(e){
 		e.preventDefault();
	});

 	$('.create-button').click(function(e){
 		e.preventDefault();
 		$('.new-comment').find('textarea').focus();
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
 				'controller' => 'User',
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
 				'controller' => 'User',
 				'action' => 'deleteComment'
 				));?>",
 			'type' : 'post',
 			'data' : {'comment_id': comment_id},
 			complete: function(res){
 					console.log(res);
 				if(res.responseText == 1){
 					alert("<?php echo __('Comment is deleted')?>");
 					$(comment).fadeOut(1000);
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
 				'controller' => 'User',
 				'action' => 'createComment'
 				));?>",
 			'type' : 'post',
 			'data' : {'comma_id':comma_id,'content':content},
 			complete: function(res){
 				console.log(res);
 				if(res.responseText == 0){
 					alert("<?php echo __('Had error! Please try again later')?>");
 				}else{
 					$('.new-comment').before(res.responseText);
 					//animate
 					$('.new-comment').prev().hide();
 					$('.new-comment').prev().fadeIn(1000);

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
<?
	if(isset($comma_id) || !empty($comments)) :
?>
	<div class = 'comment-area' style="width:<?php echo $width;?>">
		<div>
			<a href="#" class="create-button"> <?php echo __('Insert new comment');?></a>
		</div>
		<?php 
		foreach ($comments as $key => $value) : 
			$user = $value['User'];
			$comment = $value['Comment'];

			// > User da bi xoa, hoac khong ton tai
			if( !isset($user['user_id']) || empty ($user['user_id']))
				continue;

			echo $this->element('comment_element', array(
				'user' => $user,
				'comment' => $comment,
			));
		endforeach;
		?>
		<div class = 'comment new-comment'>
			<textarea style="width:100%" placeholder='<?php echo __("Insert your comment here");?>'></textarea>
			<div class='comment-content'>
				<div class="action">
					<span>
						<a class='create-button' href="#"><?php echo __('Save');?></a>
						<a class='cancel-button' href="#"><?php echo __('Cancel');?></a>
					</span>
				</div>
			</div>
		</div>
	</div>
<?php 
	endif;
	// end -> if(isset($comma_id) || !empty($comments)) :

	debug($comments);
?>
