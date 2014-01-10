 
	

	<?php if($process==1){ ?>
<div class="transactions form">

<?php echo $this->Form->create('Transaction', array('url' => array('controller'=>'transactions', 'action' => 'refund', $transactionid), 'accept-charset'=>'utf-8', 'id'=>'Transaction')); ?>
<div style="display:none;">
<input type="hidden" name="_method" value="POST"/>
</div>	
<fieldset>
		<legend>Refund Sale Credit Card <br>for Transaction ID <?php echo $transactionid; ?></legend>
	<?php echo $this->Form->input('action', array('type' => 'hidden', 'value'=>'refund')); ?>			
		<?php echo $this->Form->input('transactionid', array('type'=>'hidden', 'value'=>$transactionid)); ?>
	<div class="input text"><label for="TransactionType">Type:</label> Refund. 	</div>				

	<div class="input number required">
		Transaction ID: <?php echo $transactionid; ?>
	</div>
	<div class="input number required">
		Authorized Amount: <?php echo $amount; ?>
	</div>
	
	
	<div class="input number required">
<span style="font-style:italic">(Required only if Refund Amount is less than Authorized Amount)</span>
<?php echo $this->Form->input('amount', array('type'=>'text', 'value'=>'0.00')); ?>	

	</div>

</fieldset>
<?php echo $this->Form->end('Submit' ); ?>
</div>

	<?php } ?>


        
     
