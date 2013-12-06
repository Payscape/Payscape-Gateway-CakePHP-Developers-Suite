<?php

$basic = $photos = $calendar = $terms = $tour = $contract = $packet = 'none';

if (empty($this->params['pass'][0]) || is_numeric($this->params['pass'][0])) {
	$basic = 'active';
}
else {
	${$this->params['pass'][0]} = 'active';
}

?>
<div class="viewall">
	<?php echo $this->Html->link(
		$this->Html->image('blue-back-arr.png', array('width' => '7', 'height' => '13')).'&nbsp;View All Listings',
		array('controller' => 'properties', 'action' => 'listings'),
		array('class' => 'white-btn', 'escape' => false)
	); ?>
</div>
<div class="sidenav">
	<ul>
		<li><?php echo $this->Html->link('Address and Description', array('controller' => 'properties', 'action' => 'create', 'basic', $id), array('class' => $basic)); ?></li>
		<li><?php echo $this->Html->link('Photos', array('controller' => 'properties', 'action' => 'create', 'photos', $id), array('class' => $photos)); ?></li>
		<li><?php echo $this->Html->link('Pricing and Terms', array('controller' => 'properties', 'action' => 'create', 'terms', $id), array('class' => $terms)); ?></li>
		<li><?php echo $this->Html->link('Calendar', array('controller' => 'properties', 'action' => 'create', 'calendar', $id), array('class' => $calendar)); ?></li>
	</ul>

<?php if ( ! empty($this->request->data['Property']['published'])) { ?>
	<ul>
		<li><?php echo $this->Html->link('Send a Tour', array('controller' => 'properties', 'action' => 'create', 'tour', $id), array('class' => $tour.' thickbox')); ?></li>
		<li><?php echo $this->Html->link('Send a Contract', array('controller' => 'properties', 'action' => 'create', 'contract', $id), array('class' => $contract.' thickbox')); ?></li>
		<li><?php echo $this->Html->link('Send a Welcome Packet', array('controller' => 'properties', 'action' => 'create', 'packet', $id), array('class' => $packet.' thickbox')); ?></li>
	</ul>
<?php } ?>
</div>