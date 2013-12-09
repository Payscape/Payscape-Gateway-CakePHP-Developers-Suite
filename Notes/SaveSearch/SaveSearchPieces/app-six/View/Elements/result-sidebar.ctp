<?php $this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDLnnQUaavOoVb6xTlQhDEswKay4RwqyKM&sensor=false&libraries=places,geometry', array('inline' => false)); ?>
<?php $this->Html->script(array('map.js', 'search_map.js'), array('inline' => false)); ?>

<?php // no open form tag, the open form tag is on the main page ?>

	<div class="search-sidebar">
		<div class="map-cnt">
			<div class="row">
					<?php echo $this->Form->input('redo_search_map', array('type' => 'checkbox', 'label' => 'Redo Search in Map', 'class'=>'checkbox', 'checked'=>true));?>
			</div>
			<div id="sm_map_canvas" style="width:221px;height:208px;"></div>

			<?php
				$lat_lngs = array( );
				echo $this->Html->scriptblock('
					// initialize our map as soon as possible
					var sm_mapOptions = {
						center: new google.maps.LatLng(52, -125),
						zoom: 1,
						maxZoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID for satellite map
					};
					var sm_map = new google.maps.Map(document.getElementById("sm_map_canvas"), sm_mapOptions);
					var sm_bounds = new google.maps.LatLngBounds( );

					var user_activity = false;
					google.maps.event.addListener(sm_map, "mouseover", function( ) {
						user_activity = true;
					});
					google.maps.event.addListener(sm_map, "zoom_changed", function( ) {
						if (redo_search) {
							map_update(sm_map.getBounds( ));
						}
					});
					google.maps.event.addListener(sm_map, "dragend", function( ) {
						if (redo_search) {
							map_update(sm_map.getBounds( ));
						}

						if ( ! redo_search && user_activity && ! moved) {
							moved = true;
							show_redo_search_box( );
						}
					});
				');
			?>

		</div>

		<div class="search-options" id="search-ui">
		<?php
			if (isset($savedsearches)) {
				if ( ! isset($savedsearches[0]) || ($savedsearches[0] != "empty")) {
					?>

			<div class="row">searching saved criteria:<br>
				<?php echo $this->Form->input('saved_search_id', array('type' => 'select', 'label' => false, 'style' => 'width:200px', 'empty' => 'Saved Searches', 'options' => $savedsearches)); ?>
			</div>

					<?php
				}

				?>

			<div class="row">
				<label class="left">
					<?php 
					// echo $this->Html->link('Save Search', array('controller' => 'searches', 'action' => 'popup'), array('class' => 'thickbox')); 
					//echo $this->Html->link('Save Search', array('controller' => 'searches', 'action' => 'save_search'), array('class' => 'thickbox'));
					echo $this->Html->link('Save Search', array( 'controller' => 'searches', 'action' => 'save_search'), array('class' => 'SaveSearch')); 
					// array('controller' => 'searches', 'action' => 'save_search'), 'class' => 'SaveSearch')); 
					?>
				</label>
			</div>

				<?php
			}
		?>

			<div class="extended-search" id="accordion">
				<div class="s-title">
					<span class="right"></span>
					<h3>Home Size</h3>
				</div>
				<div class="search-category">
					<div class="category-inputs">
						<div class="row">
							<?php echo $this->Form->input('Search.bedrooms.min', array('type' => 'hidden')); ?>
							<?php echo $this->Form->input('Search.bedrooms.max', array('type' => 'hidden')); ?>
							<label class="block-label">Bedrooms</label>
							<span id="bedrooms">
								<div id="BedMin" class="min"></div><div id="BedMax" class="max"></div>
							</span>
							<div id="slider-range-Bed"></div>
						</div>
						<div class="row">
							<?php echo $this->Form->input('Search.bathrooms.min', array('type' => 'hidden')); ?>
							<?php echo $this->Form->input('Search.bathrooms.max', array('type' => 'hidden')); ?>
							<label class="block-label">Bathrooms</label>
							<span id="bathrooms">
								<div id="BathMin" class="min"></div><div id="BathMax" class="max"></div>
							</span>
							<div id="slider-range-Bath"></div>
						</div>
						<div class="row">
							<?php echo $this->Form->input('Search.square_footage.min', array('type' => 'hidden')); ?>
							<?php echo $this->Form->input('Search.square_footage.max', array('type' => 'hidden')); ?>
							<label class="block-label">Square Feet</label>
							<span id="square_footage">
								<div id="SqFtMin" class="min"></div><div id="SqFtMax" class="max"></div>
							</span>
							<div id="slider-range-SqFt"></div>
						</div>
					</div>
				</div>
				<div class="s-title">
					<span class="right"></span>
					<h3>Price</h3>
				</div>
				<div class="search-category">
					<div class="category-inputs">
						<div class="row">
							<?php echo $this->Form->input('Search.daily_rate.min', array('type' => 'hidden')); ?>
							<?php echo $this->Form->input('Search.daily_rate.max', array('type' => 'hidden')); ?>
							<span id="rate_daily">
								<div id="dailyRateMin" class="min"></div><div id="dailyRateMax" class="max"></div>
							</span>
							<div id="slider-range-price"></div>
						</div>
					</div>
				</div>

				<div class="s-title">
					<span class="right"></span>
					<h3>Amenities</h3>
				</div>
				<div class="search-category" id ="AmenityCheck">
					<?php echo $this->Form->input('amenities', array('multiple' => 'checkbox', 'div' => false, 'options' => $amenities)); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	