<?php

	/*
	 * Some values have been hard coded for testing.
	 * */

	$ccnumber = "4111111111111111";
	$ccexp = "1010";
	$cvv = "123";
	$amount = "5.00";
	$tax = ".35";
	
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
		<legend><?php echo __('Validate Credit Card Transaction'); ?></legend>

				<?php 
		echo $this->Form->input('type', array('type'=>'text', 'value'=>'validate'));				
		echo $this->Form->input('ccnumber', array('type'=>'text', 'class'=>'required', 'value'=>$ccnumber));
		echo $this->Form->input('ccexp', array('type'=>'text', 'class'=>'required', 'value'=>$ccexp));
		echo $this->Form->input('cvv', array('type'=>'text', 'class'=>'required', 'value'=>$cvv));

		echo $this->Form->input('orderid', array('type'=>'text'));
		?>
		


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
