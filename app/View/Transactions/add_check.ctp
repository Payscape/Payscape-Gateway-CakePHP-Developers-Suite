<?php

	/*
	 * Some values have been hard coded for testing.
	 * */

	$key_id = 449510;
	$order_id = "Test";
	
	$account_ach = '123123123'; // test Bank Account Number (ACH)
	$routing_ach = '123123123'; // test Bank Routing Number (ACH)
	$account_holder_type = 'business'; // test Payscape Account Holder Type (business / personal)
	$account_type = 'checking'; // test bank account type (checking / savings)
	$checkname = 'Test'; // 	
?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('New Check Transaction'); ?></legend>
	<?php
		echo $this->Form->input('type', array('value'=>$type));
		//echo $this->Form->input('key_id');
		?>
				
<div class="input number required">
	<label for="TransactionKeyID">Key ID</label><input name="data[Transaction][key_id]" step="any" type="text" id="TransactionKeyID" value="<?php echo $key_id; ?> required="required"/>
</div>
				<?php 	
		echo $this->form->input('order_id', array('value'=>$order_id))			
		echo $this->Form->input('account_ach', array('value'=>$account_ach));
		echo $this->Form->input('routing_ach', array('value'=>$rounting_ach));
		echo $this->Form->input('account_holder_type', array('value'=>$account_holder_type));
		echo $this->Form->input('account_type', array('value'=>$account_type));
		echo $this->Form->input('checkname', array('value'=>$checkname));
		

// defined in Payscape class		echo $this->Form->input('checkaba', array('value'=>$checkaba));
// defined in Payscape class		echo $this->Form->input('checkaccount', array('value'=>$checkaccount));
// defined in Payscape class		echo $this->Form->input('account_holder_type', array('value'=>$));
// defined in Payscape class		echo $this->Form->input('account_type');
// optional 	echo $this->Form->input('sec_code');
// optional 	echo $this->Form->input('processor_id');
		?>
		
<div class="input number required"><label for="TransactionAmount">Amount</label><input name="data[Transaction][amount]" step="any" type="text" id="TransactionAmount" required="required" value="2.00" />
</div>
		<?php 		
		echo $this->Form->input('cvv');
		echo $this->Form->input('payment', array('options'=>array('credit card', 'check')));
	//	echo $this->Form->input('ipaddress');
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
