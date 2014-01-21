<div class="credits view">
<h2><?php echo __('Credit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($credit['Credit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction'); ?></dt>
		<dd>
			<?php echo $this->Html->link($credit['Transaction']['id'], array('controller' => 'transactions', 'action' => 'view', $credit['Transaction']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transactionid'); ?></dt>
		<dd>
			<?php echo h($credit['Credit']['transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Amount'); ?></dt>
		<dd>
			<?php echo h($credit['Credit']['credit_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Date'); ?></dt>
		<dd>
			<?php echo h($credit['Credit']['credit_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Credit'), array('action' => 'edit', $credit['Credit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Credit'), array('action' => 'delete', $credit['Credit']['id']), null, __('Are you sure you want to delete # %s?', $credit['Credit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Credits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Credit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
