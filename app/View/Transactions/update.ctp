<?php

?>

	<?php if($process==1){ ?>
<div class="transactions form">

<?php echo $this->Form->create('Transaction', array('url' => array('controller'=>'transactions', 'action' => 'update', $transactionid), 'accept-charset'=>'utf-8', 'id'=>'Transaction')); ?>
<div style="display:none;">
<input type="hidden" name="_method" value="POST"/>
</div>	
<fieldset>
		<legend>Update Transaction ID #<?php echo $transactionid; ?></legend>
	<?php echo $this->Form->input('action', array('type' => 'hidden', 'value'=>'update')); ?>			
		
	<div class="input text"><label for="TransactionType">Type:</label> Update. 	</div>				

	<div class="input number required">
	
<?php echo $this->Form->input('transactionid', array('value' => $transactionid, 'type'=>'text', 'required'=>'required')); ?>
	</div>
	<div><strong>Tracking Number: <?php echo $transaction['transactions']['tracking_number']; ?></strong></div>
	<?php 
		echo $this->Form->input('tracking_number', array('type'=>'text'));

			$shipping_carrier = array(
					'dhl'=>'DHL',
					'fedex'=>'FedEx',
					'usps'=>'US Postal Service',
					'ups'=>'United Parcel Service',	
			);
?>
	<div><strong>Shipping Carrier: <?php echo $transaction['transactions']['shipping_carrier']; ?> </strong> </div>
<?php 
		echo $this->Form->input('shipping_carrier', array(
				'type'=>'select',
				'empty'=>'Select...',
				'options'=>$shipping_carrier,
		));
	
	?>
	

</fieldset>
<?php echo $this->Form->end('Submit' ); ?>
</div>

	<?php } ?>

<div class="actions">
	<h3>Actions</h3>
	<ul>
	<li><?php echo $this->Html->link('List Transactions', array('controller' => 'transactions', 'action'=>'index')); ?></li>
		
	</ul>
</div>
        
     
