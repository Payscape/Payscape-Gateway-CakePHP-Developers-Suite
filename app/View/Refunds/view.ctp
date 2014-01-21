<div class="refunds view">
<h2><?php echo __('Refund'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($refund['Refund']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction'); ?></dt>
		<dd>
			<?php echo $this->Html->link($refund['Transaction']['id'], array('controller' => 'transactions', 'action' => 'view', $refund['Transaction']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transactionid'); ?></dt>
		<dd>
			<?php echo h($refund['Refund']['transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refund Amount'); ?></dt>
		<dd>
			<?php echo h($refund['Refund']['refund_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refund Date'); ?></dt>
		<dd>
			<?php echo h($refund['Refund']['refund_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Refund'), array('action' => 'edit', $refund['Refund']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Refund'), array('action' => 'delete', $refund['Refund']['id']), null, __('Are you sure you want to delete # %s?', $refund['Refund']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Refunds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Refund'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
