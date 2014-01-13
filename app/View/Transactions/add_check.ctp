<?php if($process==1){ ?>

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
		
		echo $this->Form->input('checkname', array('type'=>'text'));
		echo $this->Form->input('checkaccount', array('type'=>'text'));
		echo $this->Form->input('checkaba', array('type'=>'text'));	
		echo $this->Form->input('amount', array('type'=>'text'));
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