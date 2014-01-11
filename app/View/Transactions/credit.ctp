<?php


?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
	<legend>Process Credit for Transaction ID #<?php echo $transaction['transactions']['transactionid']; ?></legend>
			<input name="action" value="credit" type="hidden" id="TransactionAction"/>
				
			<div class="input text"><label for="Transactionid">Transaction ID: #<?php echo $transaction['transactions']['transactionid']; ?></label>
				</div>
			<div class="input text"><label for="Orderid">Order ID: <?php echo $transaction['transactions']['orderid']; ?></label></div>
			<div class="input text"><label for="TransactionType">Type: credit</label></div>	
		
			<div class="input number required"><label for="TransactionAmount">Amount: <?php echo $transaction['transactions']['amount']; ?></label></div>
			
			<div class="input text"><label for="TransactionPayment">Payment: <?php echo $transaction['transactions']['payment']; ?></label></div>
			<div class="input number"><label for="TransactionTax">Tax: <?php echo $transaction['transactions']['tax']; ?></label></div>
			<div class="input number"><label for="TransactionOrderID">Order ID: <?php echo $transaction['transactions']['orderid']; ?></label></div>
			<div class="input"><label for="TransactionOrderDescription">Order Description: </label><br>
			<p><?php echo $transaction['transactions']['orderdescription']; ?></p></div>
		<!--  optional user information -->	
			<div class="input text"><label for="TransactionFirstname">First Name: <?php echo $transaction['transactions']['firstname']; ?></label></div>
	 		<div class="input text"><label for="TransactionLastname">Last Name: <?php echo $transaction['transactions']['lastname']; ?></label></div>
	 		<div class="input text"><label for="TransactionCompany">Company: <?php echo $transaction['transactions']['company']; ?></label></div>
	 		<div class="input text"><label for="TransactionAddress1">Address: <?php echo $transaction['transactions']['address1']; ?></label></div>
	 		<div class="input text"><label for="TransactionCity">City: <?php echo $transaction['transactions']['city']; ?></label></div>
	 		<div class="input text"><label for="TransactionState">State: <?php echo $transaction['transactions']['state']; ?></label></div>
	 		<div class="input text"><label for="TransactionZip">Zip: <?php echo $transaction['transactions']['zip']; ?></label></div>
	 		<div class="input text"><label for="TransactionCountry">Country: <?php echo $transaction['transactions']['country']; ?></label></div>
	 		<div class="input tel"><label for="TransactionPhone">Phone: <?php echo $transaction['transactions']['phone']; ?></label></div>
	 		<div class="input text"><label for="TransactionFax">Fax: <?php echo $transaction['transactions']['fax']; ?></label></div>
	 		<div class="input email"><label for="TransactionEmail">Email: <?php echo $transaction['transactions']['email']; ?></label></div>	
	
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?></li>
	</ul>
</div>
