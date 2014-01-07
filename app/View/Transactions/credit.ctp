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
	
//	if(isset($transaction)){
//		debug($transaction);
//		exit();
//	}
	
?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Credit Transaction'); ?></legend>

				<?php 
						
		echo $this->Form->input('ccnumber', array('type'=>'text', 'value'=>$transaction['transactions']['ccnumber']));
		echo $this->Form->input('ccexp', array('type'=>'text', 'value'=>$transaction['transactions']['ccexp']));
		echo $this->Form->input('cvv', array('type'=>'text', 'value'=>$transaction['transactions']['cvv']));
		echo $this->Form->input('amount', array('type'=>'text', 'value'=>$transaction['transactions']['amount']));
		
		?>
		
<div class="input number"><label for="TransactionTax">Tax</label><input name="data[Transaction][tax]" step="any" type="text" id="TransactionTax" value="<?php echo $transaction['transactions']['tax']; ?>" />
</div>
<div class="input number"><label for="TransactionOrderID">Order ID</label><input name="data[Transaction][orderid]" step="any" type="text" id="TransactionOrderID" value="<?php echo $transaction['transactions']['transactionid']; ?>" />
</div>
<div class="input">
<label for="TransactionOrderDescription">Order Description</label><br>
<textarea name="data[Transaction][orderdescription]" step="any" id="TransactionOrderdescription"><?php echo $transaction['transactions']['orderdescription']?></textarea>
</div>
		<?php

		echo $this->Form->input('firstname', array('value'=>$transaction['transactions']['firstname']));
		echo $this->Form->input('lastname', array('value'=>$transaction['transactions']['lastname']));
		echo $this->Form->input('company', array('value'=>$transaction['transactions']['company']));
		echo $this->Form->input('address1', array('value'=>$transaction['transactions']['address1']));
		echo $this->Form->input('city', array('value'=>$transaction['transactions']['city']));
		echo $this->Form->input('state', array('value'=>$transaction['transactions']['state']));
		echo $this->Form->input('zip', array('value'=>$transaction['transactions']['zip']));
		echo $this->Form->input('country', array('value'=>$transaction['transactions']['country']));
		echo $this->Form->input('phone', array('value'=>$transaction['transactions']['phone']));
		echo $this->Form->input('fax', array('value'=>$transaction['transactions']['fax']));
		echo $this->Form->input('email', array('value'=>$transaction['transactions']['email']));
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
