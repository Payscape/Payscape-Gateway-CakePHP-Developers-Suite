<?php

	/*
	 * Some values have been hard coded for testing.
	 * */

	$checkaccount = '123123123'; // test Bank Account Number (ACH)
	$checkaba = '123123123'; // test Bank Routing Number (ACH)
	$account_holder_type = 'business'; // test Payscape Account Holder Type (business / personal)
	$account_type = 'checking'; // test bank account type (checking / savings)
	$checkname = 'Test'; // 	
	
	// for testing
	if(isset($result_array)){
		echo "INCOMING: <br>";
		debug($incoming);
	}	
	if(isset($result_array)){
		echo "RESULT ARRAY: <br>";
		debug($result_array);
	}
?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Sale Check Transaction'); ?></legend>

				
<div class="input select"><label for="TransactionAccountHolderType">Account Holder Type</label>
	<select name="data[Transaction][account_holder_type]" id="TransactionAccountHolderType">
		<option value="personal" selected="selected">Personal</option>
		<option value="business">Business</option>
	</select>
</div>

<div class="input select"><label for="TransactionAccountType">Account Type</label>
	<select name="data[Transaction][account_type]" id="TransactionAccountType">
		<option value="checking" selected="selected">checking</option>
		<option value="savings">savings</option>
	</select>
</div>
				<?php 	
			
	
?>		
<?php 		
		
		echo $this->Form->input('checkname', array('value'=>$checkname));
		echo $this->Form->input('checkaccount', array('value'=>$checkaccount));
		echo $this->Form->input('checkaba', array('value'=>$checkaba));		


		?>
		
<div class="input number required"><label for="TransactionAmount">Amount</label>
<input name="data[Transaction][amount]" step="any" type="text" id="TransactionAmount" required="required" value="2.00" />
</div>
<div class="input number required"><label for="TransactionTax">Tax</label>
<input name="data[Transaction][tax]" step="any" type="text" id="TransactionTax" />
</div>	
<div class="input number"><label for="TransactionOrderID">Order ID</label><input name="data[Transaction][orderid]" step="any" type="text" id="TransactionOrderID" />
</div>


<div class="input">
<label for="TransactionOrderDescription">Order Description</label><br>
<textarea name="data[Transaction][orderdescription]" step="any" id="TransactionOrderdescription"></textarea>
</div>

<?php 		
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
