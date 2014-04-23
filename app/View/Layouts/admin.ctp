<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', '7Maru');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php //echo $cakeDescription ?>
		<?php echo __('7maru'); ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-theme');
		echo $this->Html->css('docs');
		echo $this->Html->css('common');
		echo $this->Html->css('quiz');
		echo $this->Html->css('site_styles');
		
		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('jquery.gdocsviewer');
	?>
	<script>
		idle_time = <?php echo Configure::read('customizeConfig.limit_session_time'); ?> * 1000;
	</script>
	<?php 
		App::uses('Component', 'AuthComponent');
		$user = AuthComponent::user();
		if( !empty($user)){
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
			<?php echo $this->element('menu');?>
		</div>
		<div id="content" style='border:1px solid #ddd'>
			<?php echo $this->element('admin_menu') ?>
			<div class="content-body" style= "float:left; width: 80%">
			<?php 
				$flash = $this->Session->flash();
				if( !empty($flash)){
					echo '<div class="alert alert-success">'.$flash.'</div>';
				}
			?>		
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>

		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
