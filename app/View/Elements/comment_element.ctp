<?php 
	$current_user = AuthComponent::user();
?>


<?php if(!empty($comment)) : ?>
<hr>
<div class='comment' comment_id = <?php echo $comment['comment_id']?>>
	<div>
		<div class ='commentator-info'>
			<?php 
			echo $this->Html->image(IMAGE_PROFILE_LINK.$user['profile_picture'], array(
				'class' => 'image-profile',
				));
			echo '<b>'.$this->Html->link($user['username'],'#',  array()).'</b>';
			?>
		</div>
		<div class='comment-content'>
			<p><?php echo $comment['content'];?></p>
			<textarea placeholder='<?php echo __("Insert your new comment content here");?>'><?php echo $comment['content'];?></textarea>
		</div>
	</div>
	<div>
		<div >
		</div>
		<div class="action">
				<hr>
				<span class="created-time">
					<?php echo $comment['created'];?>
				</span>
				<?php if(isset($current_user['user_id']) && $current_user['user_id'] == $user['user_id']) :?>
					<!-- my comment -->
					<a class='edit-button' href="#"><?php echo __('Edit');?></a>
					<a class='save-button' href="#"><?php echo __('Save');?></a>
					<a class='cancel-edit-button' href="#"><?php echo __('Cancel');?></a>
					<a class='delete-button' href="#"><?php echo __('Delete');?></a>
				<?php else : ?>
					<!-- other's comment -->
				<?php endif;?>
			
		</div>
	</div>
</div>
<?php endif;?>