<div class="curlies view">
<h2><?php echo __('Curly'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($curly['Curly']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Curly'); ?></dt>
		<dd>
			<?php echo h($curly['Curly']['curly']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postdate'); ?></dt>
		<dd>
			<?php echo h($curly['Curly']['postdate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Curly'), array('action' => 'edit', $curly['Curly']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Curly'), array('action' => 'delete', $curly['Curly']['id']), null, __('Are you sure you want to delete # %s?', $curly['Curly']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Curlies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curly'), array('action' => 'add')); ?> </li>
	</ul>
</div>
