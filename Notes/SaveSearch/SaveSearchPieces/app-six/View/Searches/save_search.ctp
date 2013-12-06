<?php
$this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDLnnQUaavOoVb6xTlQhDEswKay4RwqyKM&sensor=false&libraries=places,geometry', array('inline' => false));
$this->Html->script(array('jquery.geocomplete.min.js', 'city.js'), array('inline' => false));
//$this->Html->script('savesearch.js'); 

$this->extend('/Common/dashboard');

$this->start('the_stuff');

	$this->Html->scriptblock('
			var cities_url = "'.Router::url(array('controller' => 'cities', 'action' => 'autocomplete')).'";
			var current_url = "/'.$this->request->url.'";
	', array('inline' => false));

?>

	<span class="right"><?php if ('index' == $type) { echo $this->Html->link('Create New Search' , array('controller' => 'searches' , 'action' => 'save_search', 'new') , array('class' => 'white-btn')); } ?> </span>
	<h2 class="indent"><?php echo $user_info['User']['first_name']."'s";?> Saved Searches <?php if (count($savedsearches)) { ?><span class="counter"><?php echo count($savedsearches); ?></span><?php } ?></h2>
	<div class="clear">&nbsp;</div>

	<div class="saved-search-cnt">

	<?php if ('new' == $type) { ?>

		<div class="white-box">

			<?php echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'save_search', 'new'), 'class' => 'SaveSearch')); ?>

				<div class="search-title">
					<span class="left">
						<?php echo $this->Form->input('name', array('class' => 'search validate[required]', 'data-prompt-position' => 'topLeft:-180', 'label' => false, 'type' => 'text', 'placeholder' => 'Enter title for saved search')); ?>
					</span>

					<div class="seperator"></div>
				</div>
				<div class="search-form">
					<div class="row">
						<label class="left-label"><?php echo __('Guests'); ?></label>
						<div class="value">
							<?php echo $this->Form->input('Search.data.sleeping_capacity', array('type' => 'select', 'label' => false, 'style' => 'width:80px:')); ?>
						</div>
					</div>

					<div class="seperator"></div>

					<div class="ss-slider-cnt">
						<div class="equal-col left">
							<div class="row">
								<label class="left-label"><?php echo __('Bedrooms'); ?></label>
								<?php echo $this->Form->input('Search.data.bedrooms.min', array('type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.bedrooms.max', array('type' => 'hidden', 'class' => 'max_form')); ?>
								<span id="bedrooms">
									<div class="minmax-wrapper">
										<div id="BedMin" class="min"></div><div class="search-dash">-</div><div id="BedMax" class="max"></div></div>
										<div class="clear"></div>
								</span>
								<div class="slider-range-Bed slip"></div>
							</div>
							<div class="row">
								<label class="left-label"><?php echo __('Square Feet'); ?></label>
								<?php echo $this->Form->input('Search.data.square_footage.min', array('type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.square_footage.max', array('type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-SqFt slip"></div>
							</div>
						</div>
						<div class="equal-col right">
							<div class="row">
								<label class="left-label"><?php echo __('Bathrooms'); ?></label>
								<?php echo $this->Form->input('Search.data.bathrooms.min', array('type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.bathrooms.max', array('type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-Bath slip"></div>
							</div>
							<div class="row">
								<label class="left-label"><?php echo __('Price'); ?></label>
								<?php echo $this->Form->input('Search.data.daily_rate.min', array('type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.daily_rate.max', array('type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>	
								</span>
								<div class="slider-range-price slip"></div>
							</div>
						</div>
					</div>

					<div class="seperator"></div>

					<div class="row">
						<label class="block-label"><?php echo __('Amenities'); ?></label>
						<div class="checkbox-list"><?php echo $this->Form->input('Search.data.amenities', array('multiple' => 'checkbox', 'div' => false, 'label' => false)); ?></div>
					</div>

					<div class="seperator"></div>

					<div class="row">
						<?php echo $this->Form->submit('Save Search', array(
							'div' => false,
							'class' => 'pink-btn',
							'value' => 'Save Changes'
						)); ?>

						<?php echo $this->Html->link('Cancel', array('controller' => 'searches', 'action' => 'save_search'), array('class' => 'white-btn')); ?>
					</div>
				</div>

				<div class="row">
					<div class="search-cnt" style ="position: relative;top:-5px;">

					<?php
						echo $this->Form->input('Search.go.destination', array(
							'div' => false,
							'label' => false,
							'type' => 'text',
							'class' => 's-input',
							'placeholder' => 'Search for a place to stay.',
							'autocomplete' => 'off',
							'data-geocomplete' => 'true',
						));

						echo $this->Form->hidden('Search.go.city', array('data-geo' => 'locality'));
						echo $this->Form->hidden('Search.go.state', array('data-geo' => 'administrative_area_level_1'));
						echo $this->Form->hidden('Search.go.state_abbr', array('data-geo' => 'administrative_area_level_1_short'));
						echo $this->Form->hidden('Search.go.country', array('data-geo' => 'country'));
						echo $this->Form->hidden('Search.go.country_abbr', array('data-geo' => 'country_short'));
						echo $this->Form->hidden('Search.go.latitude', array('data-geo' => 'lat'));
						echo $this->Form->hidden('Search.go.longitude', array('data-geo' => 'lng'));

						echo $this->Form->submit('search-icon.png', array(
							'div' => false,
							'class' => 'search-btn'
						));
					?>

					</div>
				</div>

			<?php echo $this->Form->end( ); ?>

		</div>

	<?php } else { ?>

		<?php
			$i = 0;
			foreach ($savedsearches as $savedsearch) {
				$ss = $savedsearch['Search'];
				$ss['data'] = unserialize($ss['data']);

				++$i;

				?>

		<div class="white-box">

			<?php echo $this->Form->create('Search'.$i, array('url' => array('controller' => 'searches', 'action' => 'save_search'), 'class' => 'SaveSearch')); ?>
				<?php echo $this->Form->hidden('Search.id', array('value' => $ss['id'])); ?>

				<div class="search-title">
					<span class="left">
						<?php echo $this->Form->input('Search.name', array('value' => $ss['name'], 'class' => 'search validate[required]', 'data-prompt-position' => 'topLeft:-180', 'label' => false, 'type' => 'text', 'placeholder' => 'Enter title for saved search')); ?>
					</span>

					<span class="right actions-link"></span>

					<div class="seperator"></div>
				</div>
				<div class="search-form">
					<div class="row">
						<label class="left-label"><?php echo __('Guests'); ?></label>
						<div class="value">
							<?php echo $this->Form->input('Search.data.sleeping_capacity', array('value' => $ss['data']['sleeping_capacity'], 'type' => 'select', 'label' => false, 'style' => 'width:80px:')); ?>
						</div>
					</div>

					<div class="seperator"></div>

					<div class="ss-slider-cnt">
						<div class="equal-col left">
							<div class="row">
								<label class="left-label"><?php echo __('Bedrooms'); ?></label>
								<?php echo $this->Form->input('Search.data.bedrooms.min', array('value' => $ss['data']['bedrooms']['min'], 'type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.bedrooms.max', array('value' => $ss['data']['bedrooms']['max'], 'type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-Bed slip"></div>
							</div>
							<div class="row">
								<label class="left-label"><?php echo __('Square Feet'); ?></label>
								<?php echo $this->Form->input('Search.data.square_footage.min', array('value' => $ss['data']['square_footage']['min'], 'type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.square_footage.max', array('value' => $ss['data']['square_footage']['max'], 'type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-SqFt slip"></div>
							</div>
						</div>
						<div class="equal-col right">
							<div class="row">
								<label class="left-label"><?php echo __('Bathrooms'); ?></label>
								<?php echo $this->Form->input('Search.data.bathrooms.min', array('value' => $ss['data']['bathrooms']['min'], 'type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.bathrooms.max', array('value' => $ss['data']['bathrooms']['max'], 'type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-Bath slip"></div>
							</div>
							<div class="row">
								<label class="left-label"><?php echo __('Price'); ?></label>
								<?php echo $this->Form->input('Search.data.daily_rate.min', array('value' => $ss['data']['daily_rate']['min'], 'type' => 'hidden', 'class' => 'min_form')); ?>
								<?php echo $this->Form->input('Search.data.daily_rate.max', array('value' => $ss['data']['daily_rate']['max'], 'type' => 'hidden', 'class' => 'max_form')); ?>
								<span>
									<div class="minmax-wrapper"><div class="min"></div><div class="search-dash">-</div><div class="max"></div></div><div class="clear"></div>
								</span>
								<div class="slider-range-price slip"></div>
							</div>
						</div>
					</div>

					<?php
						echo $this->Html->scriptblock('
							$(document).ready( function( ) {
								$("#Search'.$i.'SaveSearchForm .slider-range-Bed").slider("values", ['.$ss['data']['bedrooms']['min'].', '.$ss['data']['bedrooms']['max'].']);
								$("#Search'.$i.'SaveSearchForm .slider-range-SqFt").slider("values", ['.$ss['data']['square_footage']['min'].', '.$ss['data']['square_footage']['max'].']);
								$("#Search'.$i.'SaveSearchForm .slider-range-Bath").slider("values", ['.$ss['data']['bathrooms']['min'].', '.$ss['data']['bathrooms']['max'].']);
								$("#Search'.$i.'SaveSearchForm .slider-range-price").slider("values", ['.$ss['data']['daily_rate']['min'].', '.$ss['data']['daily_rate']['max'].']);
								//update_slider_text( );
							});
						');
					?>

					<div class="seperator"></div>

					<div class="row">
						<label class="block-label"><?php echo __('Amenities'); ?></label>
						<div class="checkbox-list"><?php echo $this->Form->input('Search.data.amenities', array('selected' => $ss['data']['amenities'], 'multiple' => 'checkbox', 'div' => false, 'label' => false)); ?></div>
					</div>

					<div class="seperator"></div>

					<div class="row">
						<?php echo $this->Form->submit('Save Search', array(
							'div' => false,
							'class' => 'pink-btn',
							'value' => 'Save Changes'
						)); ?>

						<?php echo $this->Html->link('Cancel', array('controller' => 'searches', 'action' => 'save_search'), array('class' => 'white-btn')); ?>

						<?php echo $this->Html->link('Delete Search', array('controller' => 'searches', 'action' => 'delete_saved_search', $ss['id']), array('class' => 'redtext'), 'Are you sure, You want to delete ?'); ?>
					</div>
				</div>

				<div class="row">
					<div class="search-cnt" style="position:relative;top:-5px;">

					<?php
						echo $this->Form->input('Search.go.destination', array(
							'div' => false,
							'label' => false,
							'type' => 'text',
							'class' => 's-input',
							'placeholder' => 'Search for a place to stay.',
							'autocomplete' => 'off',
							'data-geocomplete' => 'true',
						));

						echo $this->Form->hidden('Search.go.city', array('data-geo' => 'locality'));
						echo $this->Form->hidden('Search.go.state', array('data-geo' => 'administrative_area_level_1'));
						echo $this->Form->hidden('Search.go.state_abbr', array('data-geo' => 'administrative_area_level_1_short'));
						echo $this->Form->hidden('Search.go.country', array('data-geo' => 'country'));
						echo $this->Form->hidden('Search.go.country_abbr', array('data-geo' => 'country_short'));
						echo $this->Form->hidden('Search.go.latitude', array('data-geo' => 'lat'));
						echo $this->Form->hidden('Search.go.longitude', array('data-geo' => 'lng'));

						echo $this->Form->submit('search-icon.png', array(
							'div' => false,
							'class' => 'search-btn'
						));
					?>

					</div>
				</div>

			<?php echo $this->Form->end( ); ?>

		</div>

				<?php
			}

			if ( ! $savedsearches) {
				?>

		<div class="white-box">
			<h2><span><?php echo __("You don't have any saved searches yet."); ?></span></h2>
		</div>

				<?php
			}

			echo $this->Html->scriptblock('
				$(".white-box .search-form").hide( );
				$(".white-box .seperator").hide( );
				$(".search-cnt").hide( );
			');
		}

	?>

	</div>

	<?php //=  $this->Html->script('savesearch.js'); ?>
	
	<?php $this->Html->script('savesearch.js'); ?>

<?php $this->end( ); ?>

<?php 
//$this->Html->script('savesearch.js');

?>