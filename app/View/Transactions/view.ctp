
<div class="row">

	<h2>Transaction #<?php echo $transaction['Transaction']['transactionid']; ?></h2>

	<div class="span7">
		<table class="transaction">
		<caption><h3>Customer</h3></caption>
		<tr>
			<th>Name</th><th>Phone</th><th>Fax</th><th>Email</th><th>Company</th><th>IP Address</th>
		</tr>
		<tr>
			<td><?php echo $transaction['Transaction']['firstname'];?>&nbsp;<?php echo $transaction['Transaction']['lastname']; ?></td>
			<td><?php echo $transaction['Transaction']['phone']; ?></td>
			<td><?php echo $transaction['Transaction']['fax']; ?></td>
			<td><?php echo $transaction['Transaction']['email']; ?></td>
			<td><?php echo $transaction['Transaction']['company']; ?></td>
			<td><?php echo $transaction['Transaction']['ipaddress']; ?></td>
		</tr>	
	</table>
	<hr>
	</div>
	
	<div class="span7">
		<table class="transaction">
			<caption><h3>Order</h3></caption>
			<tr>
				<th>Action</th><th>Id</th><th>Amount</th><th>Type</th><th>Time</th><th>Payment</th><th>Transaction ID</th><th>Order Id</th><th>Auth Code</th>
			</tr>
			<tr>
			<td>
		<?php if($transaction['Transaction']['type']=='auth'){ ?>
			 <?php echo $this->Html->link('Capture', array('controller' => 'transactions', 'action'=>'capture', $transaction['Transaction']['transactionid'])); ?><br>
		<?php } 	
			if($transaction['Transaction']['type']=='sale') { ?>
			 <?php echo $this->Html->link('Refund', array('controller' => 'transactions', 'action'=>'refund', $transaction['Transaction']['transactionid'])); ?><br>
             <?php echo $this->Html->link('Credit', array('controller' => 'transactions', 'action'=>'credit', $transaction['Transaction']['transactionid'])); ?><br>
			 <?php echo $this->Html->link('Update', array('controller' => 'transactions', 'action'=>'update', $transaction['Transaction']['transactionid'])); ?><br>
			 <?php echo $this->Html->link('Void', array('controller' => 'transactions', 'action'=>'void', $transaction['Transaction']['transactionid'])); ?><br>
		<?php } ?>
				</td>
				<td class="highlight"><?php echo $transaction['Transaction']['id']; ?></td>
				<td><?php echo $transaction['Transaction']['amount']; ?></td>
				<td><?php echo $transaction['Transaction']['type']; ?></td>
				
				<td><?php echo $transaction['Transaction']['time']; ?></td>
				<td><?php echo $transaction['Transaction']['payment']; ?></td>
				<td><?php echo $transaction['Transaction']['transactionid']; ?></td>
				<td><?php echo $transaction['Transaction']['orderid']; ?></td>
				<td><?php echo $transaction['Transaction']['authcode']; ?></td>
				
			</tr>
		
		</table>
		<hr>
	
	</div>

	
	<div class="span7">
	
	<table class="transaction">
	<caption><h3>Shipping</h3></caption>
	<tr>
		<th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Country</th>
	</tr>
	<tr>
		<td><?php echo $transaction['Transaction']['address1']; ?></td>
		<td><?php echo $transaction['Transaction']['city']; ?></td>
		<td><?php echo $transaction['Transaction']['state']; ?></td>
		<td><?php echo $transaction['Transaction']['zip']; ?></td>
		<td><?php echo $transaction['Transaction']['country']; ?></td>
	</tr>
	
	</table>
		<hr>
	
	</div>
	
	
	<div class="span7">
	<table class="transaction">
		<caption><h3>Payment</h3></caption>
		
<?php if($transaction['Transaction']['payment']=='credit card'){ ?>
	<tr>
		<th>Payment</th><th>Credit Card Number</th><th>Expiration</th><th>CVV</th>
		</tr>
	<tr>	
		<td><?php echo $transaction['Transaction']['payment']; ?></td>
		<td><?php echo $transaction['Transaction']['ccnumber']; ?></td>
		<td><?php echo $transaction['Transaction']['ccexp']; ?></td>
		<td><?php echo $transaction['Transaction']['cvv']; ?></td>
	</tr>

<?php } else { ?>
	<tr>
	<th>Checkname</th><th>Check Account </th><th>Routing Number</th><th>Account Type</th><th>Account Holder Type</th>
	</tr>
	<tr>
	<td><?php echo $transaction['Transaction']['checkname']; ?></td>
	<td><?php echo $transaction['Transaction']['checkaccount']; ?></td>
	<td><?php echo $transaction['Transaction']['checkaba']; ?></td>
	<td>	<?php echo $transaction['Transaction']['account_type']; ?></td>
	<td>	<?php echo $transaction['Transaction']['account_holder_type']; ?></td>
	
	</tr>
<?php } ?>

	
	</table>
		<hr>
	
	</div>
	<div class="span7">
	
		<table class="transaction">
	<caption><strong>Credentials</strong></caption>
	<tr>
		<th>Key ID</th><th>Hash</th><th>Sec Code</th><th>Processor ID</th>
	</tr>
	<tr>
		<td><?php echo $transaction['Transaction']['key_id']; ?>
		</td>
		<td><?php echo $transaction['Transaction']['hash']; ?></td>
		<td><?php echo $transaction['Transaction']['sec_code']; ?></td>
		<td><?php echo $transaction['Transaction']['processor_id']; ?></td>
	
	</tr>
	
	</table>
		<hr>
	
	</div>

	
	
	</div>
	<div class="clearfix"></div>
	
		<hr>

	

