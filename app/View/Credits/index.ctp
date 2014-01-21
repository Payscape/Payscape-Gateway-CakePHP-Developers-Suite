<div class="credits index">
	<h2><?php echo __('Credits'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_id'); ?></th>
			<th><?php echo $this->Paginator->sort('transactionid'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($credits as $credit): ?>
	<tr>
		<td><?php echo h($credit['Credit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($credit['Transaction']['id'], array('controller' => 'transactions', 'action' => 'view', $credit['Transaction']['id'])); ?>
		</td>
		<td><?php echo h($credit['Credit']['transactionid']); ?>&nbsp;</td>
		<td><?php echo h($credit['Credit']['credit_amount']); ?>&nbsp;</td>
		<td><?php echo h($credit['Credit']['credit_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $credit['Credit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $credit['Credit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $credit['Credit']['id']), null, __('Are you sure you want to delete # %s?', $credit['Credit']['id'])); ?>
		</td>
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
		<li><?php echo $this->Html->link(__('New Credit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
