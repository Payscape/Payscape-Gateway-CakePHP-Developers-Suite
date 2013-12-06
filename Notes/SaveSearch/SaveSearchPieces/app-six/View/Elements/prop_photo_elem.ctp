<?php $pr = $property['Property']; ?>

	<li class="vfid_<?= $pr['id']; ?>">
		<?php echo (( ! empty($property['Discount'])) ? '<div class="offer">Multi-Night<br>Discount</div>' : '') ?>
		<div class="thumb">
			<?php echo $this->Html->image(ife($property['PropertyImage'][0]['image']['list'], 'list_missing.png'), array('url' => array('controller' => 'properties', 'action' => 'view', $pr['id']), 'width' => '215', 'height' => '143')); ?>
		</div>

		<h2><?php echo $this->Html->link($pr['title'], array('controller' => 'properties', 'action' => 'view', $pr['id'])); ?></h2>
		<p class="prop-photo-title" title="<?php echo excerpt($pr['description']); ?>"><?php echo excerpt($pr['description'], 5); ?></p>
		<div class="row icons"><?php echo $this->element('amenity_icons', array('prop' => $pr)); ?></div>
		<div class="price">$<?= number_format($pr['daily_rate']); ?></div>
	</li>

