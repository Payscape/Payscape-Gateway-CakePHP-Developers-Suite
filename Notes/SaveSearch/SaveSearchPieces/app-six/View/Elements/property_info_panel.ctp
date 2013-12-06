<div class="property-header">
		<div class="thumb">
		<?php echo $this->Html->image(my_ife($Property['PropertyImage'][0]['image']['manage'], 'manage_missing.png'), array('url' => array('controller' => 'properties', 'action' => 'view', $Property['Property']['id']), 'width'=> '114', 'height'=>'74')); ?>
	</div>
		<div class="details">
		<h1><?php echo $this->Html->link($Property['Property']['title'], array('controller' => 'properties', 'action'=> 'view', $Property['Property']['id'])); ?></h1>
		<h2><?php echo $Property['Property']['address'].', '.$Property['Property']['city']; ?></h2>
		</div>
</div>
