<div class="transactions index">
	<h2><?php echo __('Transactions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>

	
		<th class="actions"><?php echo __('Actions'); ?></th>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th>Name</th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
		
			<th><?php echo $this->Paginator->sort('time'); ?></th>
	
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
		
			<th><?php echo $this->Paginator->sort('payment'); ?></th>
		
			<th>Order ID</th>
		
	</tr>
	<?php foreach ($transactions as $transaction): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transaction['Transaction']['id'])); ?>
		<?php if($transaction['Transaction']['type']=='auth'){?>
		<br>	<?php echo $this->Html->link(__('Capture'), array('action' => 'capture', $transaction['Transaction']['transactionid'])); ?>		
		<?php } ?>	
		</td>
		<td><?php echo h($transaction['Transaction']['id']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['firstname']); ?>&nbsp;<?php echo h($transaction['Transaction']['lastname']); ?></td>
		
		
		<td class="highlight"><?php echo h($transaction['Transaction']['type']); ?>&nbsp;</td>
		
		<td><?php echo h($transaction['Transaction']['time']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['amount']); ?>&nbsp;</td>
	
		<td><?php echo h($transaction['Transaction']['payment']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['orderid']); ?>&nbsp;</td>
		

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New CC Transaction'), array('action' => 'add_credit_card')); ?></li>
				<li><?php echo $this->Html->link(__('New eCheck Transaction'), array('action' => 'add_check')); ?></li>
				<li><?php echo $this->Html->link(__('New Auth Transaction'), array('action' => 'auth')); ?></li>		
	</ul>
</div>
