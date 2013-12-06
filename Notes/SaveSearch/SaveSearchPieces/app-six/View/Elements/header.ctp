
 <!--[if IE 6]><?php echo $this->Html->script('warning'); ?><?php echo $this->Html->scriptblock('addOnLoad( function( ) { e("img/") } );'); ?><![endif]-->

	<div class="header">
		<div class="row">
			<div class="span6 offset6 text-right links">
				<?php if ( ! isset($Auth['User']['id'])) { ?>
					<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
					<?php echo $this->Html->link('Sign up', array('controller' => 'users', 'action' => 'add')); ?>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="span5">
				<?php echo $this->Html->image('logo.jpg', array('url' => '/', 'alt' => 'VacationFish')); ?>
			</div>
			<div class="span2">
				&nbsp;
			</div>
			<div class="span5 text-right links">
				<?php echo $this->Html->link('How It Works', '#'); ?>
				<?php echo $this->Html->link('Find Rentals', '#'); ?>
				<?php echo $this->Html->link('List Rentals', '#'); ?>
			</div>
		</div>
	</div>

	<div class="content">
		<?php if ($this->Session->check('flash')) { ?>
			<div class="alert alert-error"><?php echo $this->Session->flash( ); ?></div>
		<?php } ?>

