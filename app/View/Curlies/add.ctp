<div class="curlies form">
<?php echo $this->Form->create('Curly'); ?>
	<fieldset>
		<legend><?php echo __('Add Curly'); ?></legend>
	<?php
		echo $this->Form->input('curly');
		echo $this->Form->input('postdate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Curlies'), array('action' => 'index')); ?></li>
	</ul>
</div>
