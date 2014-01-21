<div class="voids view">
<h2><?php echo __('Void'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($void['Void']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction'); ?></dt>
		<dd>
			<?php echo $this->Html->link($void['Transaction']['id'], array('controller' => 'transactions', 'action' => 'view', $void['Transaction']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transactionid'); ?></dt>
		<dd>
			<?php echo h($void['Void']['transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Void Date'); ?></dt>
		<dd>
			<?php echo h($void['Void']['void_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Void'), array('action' => 'edit', $void['Void']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Void'), array('action' => 'delete', $void['Void']['id']), null, __('Are you sure you want to delete # %s?', $void['Void']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Voids'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Void'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
