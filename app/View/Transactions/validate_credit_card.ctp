<?php if($process==1){ ?>

<div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Validate Credit Card Transaction'); ?></legend>

				<?php 
		echo $this->Form->input('type', array('type'=>'hidden', 'value'=>'validate'));				
		echo $this->Form->input('ccnumber', array('type'=>'text', 'class'=>'required'));
		echo $this->Form->input('ccexp', array('type'=>'text', 'class'=>'required'));
		echo $this->Form->input('cvv', array('type'=>'text', 'class'=>'required'));

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