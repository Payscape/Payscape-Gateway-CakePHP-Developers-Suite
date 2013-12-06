<?php 
/*
	$requestData = $this->request['data'];
	
	if(!empty($requestData)){
		echo "<pre>";
		debug($requestData);
		
		foreach($requestData as $key=>$value){
			echo "key: $key, value: $value";
		}
		echo "</pre>";
		//exit();
	}
*/

//	debug($properties);
//	exit();



?>


<?php echo $this->Html->scriptblock('
	var addto_wishlist_url = "'.Router::url(array('controller' => 'wishlistitems', 'action' => 'add')).'";
	var ajax_load_search_url = "'.Router::url(array('controller' => 'searches', 'action' => 'ajax_load_search')).'";
', array('inline' => false)); ?>

<?php $this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDLnnQUaavOoVb6xTlQhDEswKay4RwqyKM&sensor=false&libraries=places,geometry', array('inline' => false)); ?>
<?php $this->Html->script(array('map.js', 'search_map.js', 'jquery.geocomplete.min.js', 'city.js'), array('inline' => false)); ?>
<?php

	$sliders = array(
		'square_footage' => array('500', '12000'),
		'bathrooms' => array('1', '10'),
		'bedrooms' => array('1', '10'),
		'daily_rate' => array('0', '1000'),
	);

	foreach ($sliders as $slider => $default) {
		$value = $default;

		if ( ! empty($this->request->data['Search'][$slider]['min'])) {
			$value[0] = $this->request->data['Search'][$slider]['min'];
		}

		if ( ! empty($this->request->data['Search'][$slider]['max'])) {
			$value[1] = $this->request->data['Search'][$slider]['max'];
		}

		${$slider} = implode(';', $value);
	}

	$this->Html->scriptblock('
		var sq_foot_val = "' . $square_footage . '";
		var bath_val = "' . $bathrooms . '";
		var bed_val = "' . $bedrooms . '";
		var daily_rate_val = "' . $daily_rate . '";
	', array('inline' => false));

?>

<?php
	// take the results returned and create a json object that can be used to inject the data
	echo $this->element('property_create_json', array('properties' => $properties));
?>

<section class="search-result-page">

	<?php echo $this->Form->create('Search', array('url' => '/'.$this->request->url)); ?>

		<div class="search-header">
			<div class="dest-input">
				<?php
					echo $this->Form->text('destination', array('id' => 'geocomplete', 'autocomplete' => 'off', 'placeholder' => 'Destination', 'data-geocomplete' => 'true'));
					echo $this->Form->hidden('city', array('data-geo' => 'locality'));
					echo $this->Form->hidden('state', array('data-geo' => 'administrative_area_level_1'));
					echo $this->Form->hidden('state_abbr', array('data-geo' => 'administrative_area_level_1_short'));
					echo $this->Form->hidden('country', array('data-geo' => 'country'));
					echo $this->Form->hidden('country_abbr', array('data-geo' => 'country_short'));
					echo $this->Form->hidden('latitude', array('data-geo' => 'lat'));
					echo $this->Form->hidden('longitude', array('data-geo' => 'lng'));
				?>
			</div>
			<div class="other-inputs">
				<?php
					echo $this->Form->input('start_date', array('type' => 'text', 'label' => 'Check In', 'div' => 'input-cnt', 'class'=>'datepicker'));
					echo $this->Form->input('end_date', array('type' => 'text', 'label' => 'Check out', 'div' => 'input-cnt', 'class' => 'datepicker'));
					echo $this->Form->input('sleeping_capacity', array('type' => 'select', 'label' => 'Guests', 'options' => $sleepingCapacities, 'div' => 'input-cnt', 'class' => 'ssc-results' ));
					echo $this->Form->input('rate_by', array('type' => 'hidden'));
				?>
			</div>

			<?php
				$minDate = 1;
				$maxDate = null;

				if ( ! empty($this->request->data['Search']['start_date'])) {
					$minDate = date('m/d/Y', strtotime($this->request->data['Search']['start_date']));
				}

				if ( ! empty($this->request->data['Search']['end_date'])) {
					$maxDate = date('m/d/Y', strtotime($this->request->data['Search']['end_date']));
				}

				echo $this->Html->scriptblock('
					$("#SearchStartDate").datepicker({
						minDate: 0,
						maxDate: '.json_encode($maxDate).',
						changeMonth: true,
						changeYear: true,
						onClose: function(selectedDate, inst) {
							if ("" == selectedDate) {
								var min_date = 1;
							}
							else {
								// add a day to make it more intuitive
								var min_date = new Date(inst.selectedYear, inst.selectedMonth, parseInt(inst.selectedDay) + 1, 12, 0, 0, 0);
							}

							$("#SearchEndDate").datepicker("option", "minDate", min_date);
						}
					});
					$("#SearchEndDate").datepicker({
						minDate: '.json_encode($minDate).',
						changeMonth: true,
						changeYear: true,
						onClose: function(selectedDate) {
							if ("" == selectedDate) {
								var max_date = null;
							}
							else {
								// subtract a day to make it more intuitive
								var max_date = new Date(inst.selectedYear, inst.selectedMonth, parseInt(inst.selectedDay) - 1, 12, 0, 0, 0);
							}

							$("#SearchStartDate").datepicker("option", "maxDate", max_date);
						}
					});
				');
			?>

			<?php echo $this->Form->submit('Search', array('div' => 's-btn')) ?>

			<div class="search-tabs">
				<a href="#"  id="list-view" class="first active">List</a>
				<a href="#" id="photo-view">Photo</a>
				<a href="#"  id="map-view" class="last">Map</a>
			</div>
		</div>
		<!-- .search-result-content -->
		<div class="search-result-content">
		<!-- bof: left -->
		<div style="width:225px; float:left;" id="results-left;">
		
					<?php echo $this->element('result-sidebar'); ?>
		
		</div>
		<!-- eof: left -->
		<!-- bof: right -->
<div style="width:720px; float:right;">
			<!-- bof: search data -->
			<div class="search-data">
				<div class="sort-by-cnt">
					<?php echo $this->Form->select('sort', array(
							'id' => 'Newest',
							'asc' => 'Low to High',
							'desc' => 'High to Low',
						), array(
							'empty' => 'Sort By',
							'style' => 'width: 120px',
						)); ?>
				</div>

<!-- ====== DESC LIST ================================================================ -->

				<div id="ajxResults" class="searchresult searchresult-lists"></div>

<!-- ====== PHOTO LIST ================================================================ -->

				<div id="ajxResultsP" class="searchresult searchresult-photo-lists" style="display:none" ></div>

<!-- ====== MAP ================================================================ -->

				<div id="properties-box-map" class="searchresult searchresult-map" style="display:none">
					<div class="map" id="map_canvas" style="width:100%;height:600px;"></div>
					<?php echo $this->Form->input('map_ne', array('type' => 'hidden')); ?>
					<?php echo $this->Form->input('map_sw', array('type' => 'hidden')); ?>
					<?php echo $this->Form->input('map_zoom', array('type' => 'hidden')); ?>

					<?php
						echo $this->Html->scriptblock('
							// initialize our map as soon as possible
							var mapOptions = {
								mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID for satellite map
							};
							map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
							bounds = new google.maps.LatLngBounds( );

							google.maps.event.addListener(map, "zoom_changed", function( ) {
								if (redo_search) {
									map_update(map.getBounds( ));
								}
							});
							google.maps.event.addListener(map, "dragend", function( ) {
								if (redo_search) {
									map_update(map.getBounds( ));
								}
							});
						');
					?>
				</div>
		
           
<div id="ajxPage" class="row paging results-counter results-paging" style="margin:20px; width:600px;">
			
           
				
</div>

<div class="row paging-links">

		

     
     
            <script type="text/javascript">
			
				$( page ).each(function( index ) {
				console.log( index + ": " + $(this).text() );
				});
                </script>
 
</div>			
					<script type="text/javascript">
					$('#ajxPage span a').on({
						click:function(evt){
							evt.preventDefault();

							$('#ajxResults, #ajxResultsP').animate({opacity:0.5});

							$.post(
								$(this).attr('href'),
								$('#SearchResultsForm').serialize( ),
								function (res) {
									return_data = $.parseJSON(res);
									update_content(false);
									results_jqXHR = false;
								}
							);

						}
					
					
					});
					</script>
					<script type="text/javascript">
	
					var page_num = <?php echo $post_page;?> 
					//$page_number = filter_var($_POST["page"]
	
					var paginationMessage = "<?php echo $this->Paginator->counter( ' {:start} to {:end} of {:count} listings ' ); ?>"
						$("#paginationMessage").html(paginationMessage);
					 $('#ajxSize').html(page_num);


			
					</script>
  	


<div class="row">

</div>
					
					
				
</div><!-- eof: search data -->
		
</div><!-- eof: right -->			
		
	</div>	<!-- /.search-result-content -->	
	

	<?php echo $this->Form->end( ); ?>
</section>




<?php echo $this->Html->script('results.js'); ?>

