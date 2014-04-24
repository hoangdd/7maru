<?php
/**
 intro layout
 @author : HoangDD
 @create : 21/2
 */
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('7maru'); ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap', 'bootstrap-theme', 'intro', 'component', 'normalize'));
		echo $this->Html->script(array('jquery', 'bootstrap'));
	?>
	<script type="text/javascript">
	idle_time = <?php echo Configure::read('customizeConfig.limit_session_time'); ?> * 1000;
	</script>
	<?php 
		App::uses('Component', 'AuthComponent');
		$user = AuthComponent::user();
		if( !empty($user)){
			if($user['role'] == 'R4' )
				echo '<script type="text/javascript"> user_is_admin = true;</script>';
			else
				echo '<script type="text/javascript"> user_is_admin = false;</script>';
			echo $this->Html->script(array('common.js'));
		}
	?>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">

			<?php //echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
