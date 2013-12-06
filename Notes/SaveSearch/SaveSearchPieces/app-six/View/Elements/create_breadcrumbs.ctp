<?php

	$one = $two = $three = '';
	${$step} = ' class="active"';

	$id = my_ife($this->request->data['Property']['id']);

?>

	<ul class="create-listing breadcrumb">
		<li<?php echo $one; ?>>
			<?php echo $this->Html->link('Step One', array('controller' => 'properties', 'action' => 'create', 'one', $id)); ?> <span class="divider">/</span>
		</li>
		<li<?php echo $two; ?>>
			<?php echo $this->Html->link('Step Two', array('controller' => 'properties', 'action' => 'create', 'two', $id)); ?> <span class="divider">/</span>
		</li>
		<li<?php echo $three; ?>>
			<?php echo $this->Html->link('Step Three', array('controller' => 'properties', 'action' => 'create', 'three', $id)); ?>
		</li>
   </ul>
