<div class="transactions index">
	<h2><?php echo __('Transactions'); ?></h2>
	
	<?php if(count($transactions > 0)){?>
	
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('key_id'); ?></th>
			<th><?php echo $this->Paginator->sort('hash'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th><?php echo $this->Paginator->sort('ccnumber'); ?></th>
			<th><?php echo $this->Paginator->sort('ccexp'); ?></th>
			<th><?php echo $this->Paginator->sort('checkname'); ?></th>
			<th><?php echo $this->Paginator->sort('checkaba'); ?></th>
			<th><?php echo $this->Paginator->sort('chackaccount'); ?></th>
			<th><?php echo $this->Paginator->sort('account_holder_type'); ?></th>
			<th><?php echo $this->Paginator->sort('account_type'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('cvv'); ?></th>
			<th><?php echo $this->Paginator->sort('payment'); ?></th>
			<th><?php echo $this->Paginator->sort('ipaddress'); ?></th>
			<th><?php echo $this->Paginator->sort('firstname'); ?></th>
			<th><?php echo $this->Paginator->sort('lastname'); ?></th>
			<th><?php echo $this->Paginator->sort('company'); ?></th>
			<th><?php echo $this->Paginator->sort('address1'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($transactions as $transaction): ?>
	<tr>
		<td><?php echo h($transaction['Transaction']['id']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['type']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['key_id']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['hash']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['time']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['ccnumber']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['ccexp']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['checkname']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['checkaba']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['chackaccount']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['account_holder_type']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['account_type']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['amount']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['cvv']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['payment']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['ipaddress']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['lastname']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['company']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['address1']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['city']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['state']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['zip']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['country']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['phone']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['fax']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['email']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php } else { ?>
	<tr><td colspan="25">No current Transactions to display</td></tr>
<?php } ?>	
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
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?></li>
	</ul>
</div>
