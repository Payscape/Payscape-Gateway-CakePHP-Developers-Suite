<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Add Transaction'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('time');
		echo $this->Form->input('account_holder_type');
		echo $this->Form->input('account_type');
		echo $this->Form->input('sec_code');
		echo $this->Form->input('amount');
		echo $this->Form->input('tax');
		echo $this->Form->input('payment');
		echo $this->Form->input('orderdescription');
		echo $this->Form->input('ipaddress');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('company');
		echo $this->Form->input('address1');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('country');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		echo $this->Form->input('orderid');
		echo $this->Form->input('transactionid');
		echo $this->Form->input('authcode');
		echo $this->Form->input('capture_transactionid');
		echo $this->Form->input('capture');
		echo $this->Form->input('refund_transactionid');
		echo $this->Form->input('tracking_number');
		echo $this->Form->input('shipping_carrier');
		echo $this->Form->input('validated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Refunds'), array('controller' => 'refunds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Refund'), array('controller' => 'refunds', 'action' => 'add')); ?> </li>
	</ul>
</div>
