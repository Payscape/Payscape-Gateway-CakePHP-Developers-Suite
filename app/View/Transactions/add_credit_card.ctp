<?php 

/* for testing 
	if(isset($incoming)){
		echo "INCOMING:";		
		debug($incoming);
	}
	
	if(isset($result_array)){
		echo "RESULT ARRAY:";
		debug($result_array);
		
	}
*/	

	if($process==1){
?>
<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Sale Credit Card Transaction'); ?></legend>

				<?php 
						
		echo $this->Form->input('ccnumber', array('type'=>'text'));
		echo $this->Form->input('ccexp', array('type'=>'text'));
		echo $this->Form->input('cvv', array('type'=>'text'));
		echo $this->Form->input('amount', array('type'=>'text'));
		echo $this->Form->input('tax', array('type'=>'text'));
		echo $this->Form->input('orderid', array('type'=>'text'));
		?>
		
<div class="input">
<label for="TransactionOrderDescription">Order Description</label><br>
<textarea name="data[Transaction][orderdescription]" id="TransactionOrderdescription"></textarea>
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
<?php } ?>