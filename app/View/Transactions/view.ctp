
<div class="row">

	<h2>Transaction #<?php echo $transaction['Transaction']['transactionid']; ?></h2>

	<div class="span7">
		<table class="transaction">
		<caption><strong>Customer</strong></caption>
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
			<caption><strong>Order</strong></caption>
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
		<?php if($transaction['Transaction']['type']=='refund'){ ?>
			<tr>
			<td colspan="8"><strong>Refund Transaction ID: <?php echo $transaction['Transaction']['refund_transactionid']; ?></strong></td>
			</tr>
			<?php } ?>
		<?php 
			if($transaction['Transaction']['type']=='validate'){ 
				if($transaction['Transaction']['validated']==1){
				
				?>
			<tr>
			<td colspan="8"><strong>Credit Card Validated</strong></td>
			</tr>
			<?php 
					}
				} 	
		?>
			
		</table>
		<hr>
	
	</div>

	
	<div class="span7">
	
	<table class="transaction">
	<caption><strong>Shipping</strong></caption>
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
	<tr>
		<td colspan="3"><strong>Carrier: <?php echo $transaction['Transaction']['shipping_carrier']; ?></strong></td>
		<td colspan="2"><strong>Tracking Number: <?php echo $transaction['Transaction']['tracking_number']; ?></strong></td>
	</tr>
	
	</table>
		<hr>
	
	</div>
	
	
	<div class="span7">
	<table class="transaction">
		<caption><strong>Payment</strong></caption>
		
<?php if($transaction['Transaction']['payment']=='credit card'){ ?>
	<tr>
		<th>Payment</th>
		</tr>
	<tr>	
		<td><?php echo $transaction['Transaction']['payment']; ?></td>
	</tr>

<?php } else { ?>
	<tr>
	<th>Account Type</th><th>Account Holder Type</th>
	</tr>
	<tr>
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
		<th>Sec Code</th><th>Processor ID</th>
	</tr>
	<tr>
		
		<td><?php echo $transaction['Transaction']['sec_code']; ?></td>
		
	</tr>
	
	</table>
		<hr>
	
	</div>

	
	
	</div>
	<div class="clearfix"></div>
	
		<hr>

	

