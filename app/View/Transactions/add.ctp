<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Add Transaction'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('key_id');
		echo $this->Form->input('hash');
		echo $this->Form->input('time');
		echo $this->Form->input('ccnumber');
		echo $this->Form->input('ccexp');
		echo $this->Form->input('checkname');
		echo $this->Form->input('checkaba');
		echo $this->Form->input('chackaccount');
		echo $this->Form->input('account_holder_type');
		echo $this->Form->input('account_type');
		echo $this->Form->input('amount');
		echo $this->Form->input('cvv');
		echo $this->Form->input('payment');
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
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?></li>
	</ul>
</div>
