<?php

	$pr = $property['Property'];

	$multinight_image = (( ! empty($property['Discount'])) ? '<div class="offer">Multi-Night<br>Discount</div>' : '');

	$wishlist_link = $this->Html->link(
		$this->Html->tag('span', 'Add to wishlist'),
		array('controller' => 'users', 'action' => 'login_pop'),
		array('class' => 'wishlist-btn thickbox', 'escape' => false)
	);

	if ( ! empty($_SESSION['Auth']['User']['id'])) {
		if (in_array($pr['id'], $pid)) {
			$wishlist_link = $this->Html->link('<span>Add to wishlist</span>', 'javascript:void(0);', array('class' => 'wishlist-btn inactive', 'escape' => false));
		}
		else {
			$wishlist_link = $this->Html->link(
				$this->Html->tag('span', "Add to wishlist"),
				array('controller' => 'wishlists', 'action' => 'add_wishlist', $pr['id']),
				array('class' => 'wishlist-btn thickbox', 'escape' => false)
			);
		}
	}

?>

	<div class="infowindow_wrapper">
		<div class="infowindow-top">
			<div class="infowindow-top-left">
				<?php echo $this->Html->image(my_ife($property['PropertyImage'][0]['image']['map'], 'map_missing.png'), array('width' => 80, 'height' => 55)); ?>
			</div>
			<div class="infowindow-top-right">
				<span class="price">$<?php echo number_format($pr['daily_rate']); ?></span><br /><span class="per-night">per night</span><br />
				<?php echo $multinight_image; ?>
			</div>
			<div class="clearBoth"></div>
		</div>
			<div class="title">
				<?php echo $this->Html->link($pr['title'], array('controller' => 'properties', 'action' => 'view', $pr['id'])); ?>
			</div>
			
			<div class="infowindow-property-details">
				<?php echo $property['PropertyType']['name'].' &ndash; '.$property['User']['first_name']; ?>
			</div>
	
			<div class="row icons">
				<?php echo $this->element('amenity_icons', array('prop' => $pr)); ?>
			</div>
	
			<hr class="sexy" />
		<div class="infowindow-bottom">
			<div class="infowindow-bottom-left">
				<?php echo $this->Html->link('View Property', array('controller' => 'properties', 'action' => 'view', $pr['id']), array('class' => 'btn')); ?>
			</div>
			<div class="infowindow-bottom-right">
				<?php echo $wishlist_link; ?>
			</div>
			<div class="clearBoth"></div>
		</div>
	</div>