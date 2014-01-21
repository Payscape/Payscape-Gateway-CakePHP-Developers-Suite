<div class="transactions view">
<h2><?php echo __('Transaction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Holder Type'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['account_holder_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Type'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['account_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sec Code'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['sec_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['payment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orderdescription'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['orderdescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ipaddress'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['ipaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orderid'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['orderid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transactionid'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Authcode'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['authcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capture Transactionid'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['capture_transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capture'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['capture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refund Transactionid'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['refund_transactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tracking Number'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['tracking_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Carrier'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['shipping_carrier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validated'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['validated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction'), array('action' => 'edit', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Refunds'), array('controller' => 'refunds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Refund'), array('controller' => 'refunds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Refunds'); ?></h3>
	<?php if (!empty($transaction['Refund'])): ?>
	<table>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Transaction Id'); ?></th>
		<th><?php echo __('Transactionid'); ?></th>
		<th><?php echo __('Refund Amount'); ?></th>
		<th><?php echo __('Refund Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($transaction['Refund'] as $refund): ?>
		<tr>
			<td><?php echo $refund['id']; ?></td>
			<td><?php echo $refund['transaction_id']; ?></td>
			<td><?php echo $refund['transactionid']; ?></td>
			<td><?php echo $refund['refund_amount']; ?></td>
			<td><?php echo $refund['refund_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'refunds', 'action' => 'view', $refund['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'refunds', 'action' => 'edit', $refund['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'refunds', 'action' => 'delete', $refund['id']), null, __('Are you sure you want to delete # %s?', $refund['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Refund'), array('controller' => 'refunds', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
