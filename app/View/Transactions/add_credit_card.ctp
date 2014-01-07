<?php

	/*
	 * Some values have been hard coded for testing.
	 * */


	$time = gmdate("YmdHis");
	$key_id = 449510;
	$hash = "5C8EEBB1302087B11CFAE6F557072A28";
	$order_id = "Test";
	
	$ccnumber = "4111111111111111";
	
	$cvv = "123";
	
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
		<legend><?php echo __('Sale Credit Card Transaction'); ?></legend>

				<?php 
						
		echo $this->Form->input('ccnumber', array('value'=>$ccnumber));
		echo $this->Form->input('ccexp', array('value'=>'1010'));
		echo $this->Form->input('cvv', array('value'=>$cvv));
		?>
		
<div class="input number required"><label for="TransactionAmount">Amount</label><input name="data[Transaction][amount]" step="any" type="text" id="TransactionAmount" required="required" value="2.00" />
</div>
<div class="input number"><label for="TransactionTax">Tax</label><input name="data[Transaction][tax]" step="any" type="text" id="TransactionTax" />
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
