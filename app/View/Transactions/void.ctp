<?php
	echo $void_message;
	
?>
	

	<?php if($process==1){ ?>
<div class="transactions form">

<?php echo $this->Form->create('Transaction', array('url' => array('controller'=>'transactions', 'action' => 'void', $transactionid), 'accept-charset'=>'utf-8', 'id'=>'Transaction')); ?>
<div style="display:none;">
<input type="hidden" name="_method" value="POST"/>
</div>	
<fieldset>
		<legend>Void for Credit Card Transaction ID <?php echo $transactionid; ?></legend>
	<?php echo $this->Form->input('action', array('type' => 'hidden', 'value'=>'void')); ?>			
		
	<div class="input text"><label for="TransactionType">Type:</label> Void. 	</div>				

	<div class="input text">
	<label for="TransactionID">Transaction ID:</label> <?php echo $transactionid; ?>
<?php echo $this->Form->input('transactionid', array('value' => $transactionid, 'type'=>'hidden', 'required'=>'required')); ?>
	</div>
	
	<div class="input text">
		<label for="TransactionAmount">Amount:</label> <?php echo $amount; ?>
	</div>

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
        
     
