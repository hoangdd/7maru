
	<li class='lesson-book'>
		<div class="bk-book book bk-bookdefault">
			<div class="bk-front" style="background-image: url(<?php echo $lesson['image'];?>);	">
			</div>
		</div>
		<div class="bk-info">
			<button>Buy</button>
			<button>View page</button>
			<h3>
				<span>
					<?php echo $lesson['author']['firstname'].' '.$lesson['author']['lastname']?>
				</span>
				<span>
					<?php echo $lesson['title']; ?>
				</span>
			</h3>
			<p>
				<?php echo $lesson['description'];?>
			</p>
		</div>
				<?php echo '...'; ?>
	</li>
