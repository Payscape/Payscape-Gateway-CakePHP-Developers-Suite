<?php

	if ( ! count($properties)) {
		?>

		<p>We couldn't find any results. Here are some ideas:</p>
		<ul>
			<li>Expand the area of your search.</li>
			<li>Search for a city, address, or landmark.</li>
		</ul>

		<?php
	}

	$lat_lngs = $info_windows = array( );
	foreach ($properties as $key => $property) {
		$pr = $property['Property'];

		// pull out the lat longs for the map
		if ( ! empty($pr['area_latitude']) && ! empty($pr['area_longitude'])) {
			$lat_lngs[$pr['id']] = array($pr['area_latitude'], $pr['area_longitude']);
		}

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

		// generate our infowindow content
		$info_windows[$pr['id']] = '
			<div class="infowindow_wrapper">
				'.$this->Html->image(my_ife($property['PropertyImage'][0]['image']['map'], 'map_missing.png'), array('width' => 80, 'height' => 55)).'

				<div class="price">$'.number_format($pr['daily_rate']).'<span>per night</span></div>
				'.$multinight_image.'

				<div class="title">' . $this->Html->link($pr['title'], array('controller' => 'properties', 'action' => 'view', $pr['id'])) . '</div>
				<div>'.$property['PropertyType']['name'].' &ndash; '.$property['User']['first_name'].'</div>

				<div class="row icons">
					'.$this->element('amenity_icons', array('prop' => $pr)).'
				</div>

				<hr class="sexy" />

				'.$this->Html->link('View Property', array('controller' => 'properties', 'action' => 'view', $pr['id']), array('class' => 'btn')).'
				'.$wishlist_link.'
			</div>
		';
	}

	echo $this->Html->scriptblock('
		var info_windows = ' . json_encode($info_windows) . ';

		markers = place_markers(' . json_encode($lat_lngs) . ', {info_box: true});
	');


