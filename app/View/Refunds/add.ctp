<div class="refunds form">
<?php echo $this->Form->create('Refund'); ?>
	<fieldset>
		<legend><?php echo __('Add Refund'); ?></legend>
	<?php
		echo $this->Form->input('transaction_id');
		echo $this->Form->input('transactionid');
		echo $this->Form->input('refund_amount');
		echo $this->Form->input('refund_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Refunds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
