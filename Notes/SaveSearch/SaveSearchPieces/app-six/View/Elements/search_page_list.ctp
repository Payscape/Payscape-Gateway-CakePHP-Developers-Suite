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

					foreach ($properties as $key => $property) {
						$pr = $property['Property'];

						// pull out the lat longs for the map
						if ( ! empty($pr['area_latitude']) && ! empty($pr['area_longitude'])) {
							$lat_lngs[$pr['id']] = array($pr['area_latitude'], $pr['area_longitude']);
						}

						?>

					<li class="vfid_<?= $pr['id']; ?>">
						<div class="cf">
			
						
							<div class="thumb"><?php echo $this->Html->image(my_ife($property['PropertyImage'][0]['image']['list'], 'list_missing.png'), array('url' => array('class' => 'viewbox', 'controller' => 'properties', 'action' => 'view', $pr['id']))); ?></div>

							<div class="details">
								<h3><?php echo $this->Html->link($pr['title'], array('controller' => 'properties', 'action' => 'view', $pr['id'])); ?></h3>
								<p><?php echo excerpt($pr['description'], 15); ?></p>
								<div class="row icons">
									<?php echo $this->element('amenity_icons', array('prop' => $pr)); ?>
									<?php
										if ( ! empty($_SESSION['Auth']['User']['id'])) {
											if (in_array($pr['id'], $pid)) {
												echo $this->Html->link('<span>Add to wishlist</span>', 'javascript:void(0);', array('class' => 'wishlist-btn inactive', 'escape' => false));
											}
											else {
												echo $this->Html->link(
													$this->Html->tag('span', "Add to wishlist"),
													array('controller' => 'wishlists', 'action' => 'add_wishlist', $pr['id']),
													array('class' => 'wishlist-btn thickbox', 'escape' => false)
												);
											}
										}
										else {
											echo $this->Html->link(
												$this->Html->tag('span', "Add to wishlist"),
												array('controller' => 'users', 'action' => 'login_pop'),
												array('class' => 'wishlist-btn thickbox', 'escape' => false)
											);
										}
									?>
								</div>
							</div>
							<div class="price-cnt">
								<div class="price">
									$<?= number_format($pr['daily_rate']); ?> <span>Per night</span>
								</div>
								<?php echo (( ! empty($property['Discount'])) ? '<div class="offer">Multi-Night<br>Discount</div>' : '') ?>
							</div>
						</div>
					</li>

						<?php
					}
				?>