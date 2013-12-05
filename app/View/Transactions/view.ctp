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
		<dt><?php echo __('Key Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['key_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hash'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['hash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ccnumber'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['ccnumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ccexp'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['ccexp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkname'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['checkname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkaba'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['checkaba']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chackaccount'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['chackaccount']); ?>
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
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cvv'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['cvv']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['payment']); ?>
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
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction'), array('action' => 'edit', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?> </li>
	</ul>
</div>
