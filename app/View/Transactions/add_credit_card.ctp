<?php

	/*
	 * Some values have been hard coded for testing.
	 * */

	$type = "sale"; 
	$time = gmdate("YmdHis");
	$key_id = 449510;
	$hash = "5C8EEBB1302087B11CFAE6F557072A28";
	$order_id = "Test";
	
	$ccnumber = "4111111111111111";
	
	$cvv = "123";
	
?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('New Credit Card Transaction'); ?></legend>
	<?php
		echo $this->Form->input('type', array('value'=>$type));

		?>
				
<div class="input number required"><label for="TransactionKeyID">Key ID</label>
<input name="data[Transaction][key_id]" step="any" type="text" id="TransactionKeyID" value="<?php echo $key_id; ?>" required="required"/>
</div>
				<?php 
						
		echo $this->Form->input('ccnumber', array('value'=>$ccnumber));
		echo $this->Form->input('ccexp', array('value'=>'1010'));

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
		echo $this->Form->input('cvv', array('value'=>$cvv));
		
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
