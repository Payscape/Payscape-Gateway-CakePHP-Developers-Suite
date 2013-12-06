<?php 
	/*
	 * remaining Alternative Minimum Nights slots
	 * 
	 * */
?>			
<!--  bof: Remaining Alternative Slots -->			
<?php if($minimum_nights_counter < $max_minimum_nights){ 
	$k = 800;
	
	$remainder = (int) $max_minimum_nights - $minimum_nights_counter; 
	$miv_at_remainder = $miv_counter;
	?>			
				<div class="removable">		
				<!--  AVAILABLE SLOTS  -->				

				<?php for ($j = 1; $j <= $remainder; $j++) { ?>
	<?php $miv_next = (int) $miv_counter + 1; ?>
 
  <h5 id="minimum_nightsMessage<?php echo $k; ?>"></h5>
	<div id="minimum_nightsContainer<?php echo $k; ?>">
	<div class="row">
		<div class="left">
			Alternate Minimum Night Stay:
				<select name="minimum_nights" class="high_season_price" id="minimum_nights_amount<?php echo $k; ?>" title="Number of Nights and Start Date are Required.">					</div>
			<option value="1" selected="selected">1</option>
			<option value="2" >2</option>
			<option value="3" >3</option>
			<option value="4" >4</option>
			<option value="5" >5</option>
			<option value="6" >6</option>
			<option value="7" >7</option>
			<option value="8" >8</option>
			<option value="9" >9</option>
			<option value="10" >10</option>
			<option value="11" >11</option>
			<option value="12" >12</option>
			<option value="13" >13</option>
			<option value="14" >14</option>
			<option value="15" >15</option>
			<option value="16" >16</option>
			<option value="17" >17</option>
			<option value="18" >18</option>
			<option value="19" >19</option>
			<option value="20" >20</option>
			<option value="21" >21</option>
			<option value="22" >22</option>
			<option value="23" >23</option>
			<option value="24" >24</option>
			<option value="25" >25</option>
			<option value="26" >26</option>
			<option value="27" >27</option>
			<option value="28" >28</option>
			<option value="29" >29</option>
			<option value="30" >30</option>
			<option value="31" >31</option>				
</select><span> nights</span>			
		</div>
		<div class="left" style="width: 360px;">
							Dates from:
							<?php echo $this->Form->input("start_date$k",
										array(
											'type' => 'text',
											'label' => false,
											'div' => false,
											'style'  => 'width:100px;display:inline;',
											'class' => 'datepicker high_season_price',
											'id' => "startDate$k"
										));
							?>&nbsp;to
							<?php echo $this->Form->input("end_date$k",
										array(
											'type' => 'text',
											'label' => false,
											'div' => false,
											'style'  => 'width:100px;display:inline;',
											'class' => 'datepicker high_season_price',
									'id' => "endDate$k",
										));
					
						
							?>
									<input type="text" style="width:20px;" id="id<?php echo $k; ?>">
					</div>
					<div class="left">
		<span class="btn btn-primary" id="saveMinimumNights<?php echo $k; ?>">Save Minimum Night Stay</span>
		<span class="btn btn-info" id="updateMinimumNights<?php echo $k; ?>">Update  Minimum Night Stay</span>
		<span class="btn btn-danger" id="deleteMinimumNights<?php echo $k; ?>">Delete  Minimum Night Stay</span>
					</div>


	
<?php if($miv_counter < $max_minimum_nights){?>
<div style="width:800px; margin-top:20px; float:left;">
<span class="btn" id="hide_show<?php echo $k; ?>">Add Another</span> Alternate Minimum Nights Stay #<?php echo $minimum_nights_counter_display; ?>
</div>
	<?php } ?>	

	


		</div>	<!-- row -->	
					
				
<script>

		
$(function() {
	$("#saveMinimumNights<?php echo $k; ?>").show();
	$("#updateMinimumNights<?php echo $k; ?>").hide();
	$("#deleteMinimumNights<?php echo $k; ?>").hide();
	
	// add
	$("#saveMinimumNights<?php echo $k; ?>").live('click', function(s<?php echo $k; ?>) {
	var minimum_nights_amount<?php echo $k; ?> = $("#minimum_nights_amount<?php echo $k; ?>").val();
	var startdate<?php echo $k; ?> = $("#startDate<?php echo $k; ?>").val();
	var propertyid<?php echo $k; ?> = <?php echo $property_id; ?>;
	var enddate<?php echo $k; ?> = $("#endDate<?php echo $k; ?>").val();
	var weight<?php echo $k; ?> = 2;
	var parentid<?php echo $k; ?> = 2;

		  $.post(ROOT_URL+'nights/add', {
			"data[Night][minimum_nights]": minimum_nights_amount<?php echo $k; ?>,
			"data[Night][start_date]": startdate<?php echo $k; ?>,
			"data[Night][property_id]": propertyid<?php echo $k; ?>,
			"data[Night][end_date]": enddate<?php echo $k; ?>,			
			"data[Night][weight]": weight<?php echo $k; ?>,
			"data[Night][parent_id]": 2
			
	        }, function (data) {

	        	 var obj = $.parseJSON(data);

	        	 var minimum_nightsid<?php echo $k; ?> = obj.id;
	        	 var message<?php echo $k; ?> = obj.message;
	        	 
	            $("#id<?php echo $k; ?>").val( minimum_nightsid<?php echo $k; ?> );
	            $("#minimum_nightsMessage<?php echo $k; ?>").html( message<?php echo $k; ?> );  
               });

			$("#saveMinimumNights<?php echo $k; ?>").hide();
			$("#updateMinimumNights<?php echo $k; ?>").fadeIn();
			$("#deleteMinimumNights<?php echo $k; ?>").fadeIn();

	        // json returns this
	        // {"id":"137","message":"Your Alternative / Holiday Night has been saved."}    
			// 

	});
});
	// update
	
		$("#updateMinimumNights<?php echo $k; ?>").live('click', function(u<?php echo $k; ?>) {
			var minimum_night_amount<?php echo $k; ?> = $("#minimum_night_amount<?php echo $k; ?>").val();
			var startdate<?php echo $k; ?> = $("#startDate<?php echo $k; ?>").val();
			var propertyid<?php echo $k; ?> = <?php echo $property_id; ?>;
			var enddate<?php echo $k; ?> = $("#endDate<?php echo $k;?>").val();
			var weight<?php echo $k; ?> = 2;
			//var minimum_nightsid<?php echo $k; ?> = $("#id<?php echo $k; ?>").val();
			//var minimum_nightsid<?php echo $k; ?> = $("#id<?php echo $minimum_nights_counter1; ?>").val();
	//		var minimum_nightsid<?php echo $k; ?> = 28;
			var minimum_nightsid<?php echo $k; ?> = $("#id<?php echo $k; ?>").val();
			var parentid<?php echo $k; ?> = 2;

		  $.post(ROOT_URL+"nights/edit/"+minimum_nightsid<?php echo $k; ?>, {
				"data[Night][id]": minimum_nightsid<?php echo $k; ?>,
				"data[Night][minimum_nights]": minimum_nights_amount<?php echo $k; ?>,
				"data[Night][start_date]": startdate<?php echo $k; ?>,
				"data[Night][property_id]": propertyid<?php echo $k; ?>,
				"data[Night][end_date]": enddate<?php echo $k; ?>,
				"data[Night][weight]": weight<?php echo $k; ?>,
				"data[Night][parent_id]": parentid<?php echo $k; ?>
				
				
		        },  function (data) {

		        	 var obj = $.parseJSON(data);

		        	 var minimum_nightsid<?php echo $k; ?> = obj.id;
		        	 var message<?php echo $k; ?> = obj.message;
			            $("#id<?php echo $k; ?>").val( minimum_nightsid<?php echo $k; ?> );
			            $("#minimum_nightsMessage<?php echo $k; ?>").html( message<?php echo $k; ?> );  
			            
				    $("#id<?php echo $k; ?>").empty().append( obj.id );
		            $("#minimum_nightsMessage<?php echo $k; ?>").html( obj.message );
				

	                });
	// delete
			$("#deleteMinimumNights<?php echo $k; ?>").live('click', function(d<?php echo $k; ?>) {
			var minimum_nightsid<?php echo $k; ?> = $("#id<?php echo $k; ?>").val();	
			var propertyid<?php echo $k; ?> = <?php echo $property_id; ?>;

			alert(minimum_nightsid<?php echo $k; ?>);

		$.post(ROOT_URL+"nights/remove_night/"+minimum_nightsid<?php echo $k; ?>, {
			"data[Night][id]": minimum_nightsid<?php echo $k; ?>,
			"data[Night][property_id]": propertyid<?php echo $k; ?>
	
	        }, function (data) {
	            $("#minimum_nightsMessage<?php echo $k; ?>").html(data);
	        });		

        	$("#minimum_nightsContainer<?php echo $k; ?>").fadeOut();
		});		

       

});		
							
</script>
	
</div>	<!-- minimum_nightsContainer -->
			<?php 
				$miv_counter++;
				$minimum_nights_counter++;	
				$k++;
				$minimum_nights_counter_display++;		
	} // $j;				 
							?>
			</div><!-- removable  -->
			<?php }// if ?>	