<?php 
	$current_user = AuthComponent::user();
?>

<div class='comment' comment_id = <?php echo $comment['comment_id']?>>
	<div class ='commentator-info'>
		<?php 
		echo $this->Html->image(IMAGE_PROFILE_LINK.$user['profile_picture'], array(
			'class' => 'image-profile'
			));
		echo $this->Html->link($user['username'],'#',  array());
		?>
	</div>
	<div class='comment-content'>
		<!-- Khong duoc enter, de so sanh noi dung -->
		<p><?php echo $comment['content'];?></p>
		<textarea placeholder='<?php echo __("Insert your new comment content here");?>'><?php echo $comment['content'];?></textarea>
		<div class="action">
			<span>
				<?php if($current_user['user_id'] == $user['user_id']) :?>
					<!-- my comment -->
					<a class='edit-button' href="#"><?php echo __('Edit');?></a>
					<a class='save-button' href="#"><?php echo __('Save');?></a>
					<a class='cancel-edit-button' href="#"><?php echo __('Cancel');?></a>
					<a class='delete-button' href="#"><?php echo __('Delete');?></a>
				<?php else : ?>
					<!-- other's comment -->
				<?php endif;?>
				<?php echo $comment['created'];?>
			</span>
		</div>
	</div>
</div>