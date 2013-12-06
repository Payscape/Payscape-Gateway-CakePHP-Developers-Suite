<?php

$filter_items       = ife($filter_items, array( ));
$filter_item        = ife($filter_item, false);
$filter_comparisons = ife($filter_comparisons, array( ));
$filter_compare     = ife($filter_compare, false);
$filter_selects     = ife($filter_selects, array('Loading...'));
$filter_select      = ife($filter_select, false);
$filter_value       = ife($filter_value, false);

$this->Html->scriptblock('var FILTER_ROOT_URL = "'.$this->Html->url(array('controller' => $this->request['params']['controller'])).'";', array('inline' => false));
$this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', array('inline' => false));

?>

<div id="admin_filter" style="float:right;">
	<?php echo $this->Form->create('AdminFilter', array('url' => array('controller' => $this->request['params']['controller'], 'action' => 'index'))); ?>
		<?php echo $this->Form->select('item', $filter_items, $filter_item, array('escape' => false), true); ?>
		<?php echo $this->Form->select('compare', $filter_comparisons, $filter_compare, array('escape' => false)); ?>
		<?php echo $this->Form->select('select', $filter_selects, $filter_select, array('style' => 'width:200px;', 'escape' => false)); ?>
		<?php echo $this->Form->text('value', array('value' => $filter_value)); ?>
		<?php echo $this->Form->submit('Filter', array('div' => false)); ?>
	<?php echo $this->Form->end( ); ?>
</div><!-- #filter -->

<?php echo $this->Html->script('admin_filter.js'); ?>

