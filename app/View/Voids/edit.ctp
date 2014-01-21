<div class="voids form">
<?php echo $this->Form->create('Void'); ?>
	<fieldset>
		<legend><?php echo __('Edit Void'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('transaction_id');
		echo $this->Form->input('transactionid');
		echo $this->Form->input('void_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Void.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Void.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Voids'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
