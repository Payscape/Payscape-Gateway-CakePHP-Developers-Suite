<?php
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
	<h3><?php echo $capture_message; ?></h3>

	<?php if($process==1){ ?>
<div class="transactions form">

<?php echo $this->Form->create('Transaction', array('url' => array('controller'=>'transactions', 'action' => 'capture', $transactionid), 'accept-charset'=>'utf-8', 'id'=>'Transaction')); ?>
<div style="display:none;">
<input type="hidden" name="_method" value="POST"/>
</div>	
<fieldset>
		<legend>Capture Auth Transaction</legend>
	<?php echo $this->Form->input('action', array('type' => 'hidden', 'value'=>'capture')); ?>			
		
	<div class="input text"><label for="TransactionType">Type:</label> Capture. 	</div>				

	<div class="input number required">
	
<?php echo $this->Form->input('transactionid', array('value' => $transactionid, 'type'=>'text', 'required'=>'required')); ?>
	</div>
	
	<div class="input number required">

<?php echo $this->Form->input('amount', array('value' => $amount, 'type'=>'text', 'required'=>'required')); ?>	
<span style="font-style:italic">(less than or equal to Authorized Amount)</span>
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
        
     
