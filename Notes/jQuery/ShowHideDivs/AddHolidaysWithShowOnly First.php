div class="addable" id="holidays">
					
<?php $piv_counter = 1; ?>
					
<?php if (empty($holidays_check)) { 
	
	


	$holiday_counter1 = 1;
	$holiday_counter = 0;
	?>				
		
		<?php 
		/*
		 * for new Alternative / Holiday Prices
		 * 
		 * */
		?>
	<div class="removable">
					<?php for ($j = 1; $j <= $max_holidays; $j++) { ?>
					
<div class="row">
<?php 
//echo "<br>holiday_counter: $holiday_counter<br>"; 
//echo "<br>holiday counter1: $holiday_counter1<br>"; 
//echo "COUNTER:$piv_counter<br>;" 
 ?>
 <?php $piv_next = (int) $piv_counter + 1;?>
		<div id="holidayContainer<?php echo $piv_counter; ?>">	

					<h5 id="holidayMessage<?php echo $holiday_counter1; ?>"></h5>
		
		<div class="left">
							Alternative / Holiday Nightly Rate:
							$<?php echo $this->Form->input("price$j", array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'holiday_price', 'style'=>'width:30px;', 'title' => 'Price and Start Date are Required.', 'id'=>"holidayamount$j")); ?>
						</div>
						<div class="left" style="width: 360px;">
							Dates from:
							<?php echo $this->Form->input("start_date$j",
							array(
								'type' => 'text',
								'label' => false,
								'div' => false,
								'style'  => 'width:100px;display:inline;',
								'class' => 'datepicker high_season_price',
								'id' => "startDate$j"
										));
							?>&nbsp;to
							<?php echo $this->Form->input("end_date$j",
								array(
									'type' => 'text',
									'label' => false,
									'div' => false,
									'style'  => 'width:100px;display:inline;',
									'class' => 'datepicker high_season_price',
									'id' => "endDate$j",
								));
					
						
							?>
					</div>
					<div class="left">
					
	<span class="btn btn-primary" id="savePrice<?php echo $holiday_counter1; ?>">Save Price</span>
	<span class="btn btn-info" id="updatePrice<?php echo $holiday_counter1; ?>">Update Price</span>
	<span class="btn btn-danger" id="deletePrice<?php echo $holiday_counter1; ?>">Delete Price</span>
					</div>
	<input type="hidden" style="width:20px;" id="id<?php echo $holiday_counter1; ?>">
						<?php //echo $this->Html->image('btn-minus.png', array('alt' => 'Delete', 'title' => 'Delete This Entry', 'class' => 'image-minus delete')); ?>
	
<?php if($piv_counter < $max_holidays){?>
<div class="clearfix"></div>
<div style="float:left; width:800px; margin-top:20px;">			
	<h4><span class="btn" id="hide_show<?php echo $piv_next; ?>">Add Another</span> Alternative / Holiday Price #<?php echo $piv_next; ?></h4>
	<div class="seperator-big"></div>
</div>
<?php } ?>	
		
		</div><!-- holidayContainer -->	

	
		

		
			
<script>						
							
$(function() {

	$("#savePrice<?php echo $holiday_counter1; ?>").show();
	$("#updatePrice<?php echo $holiday_counter1; ?>").hide();
	$("#deletePrice<?php echo $holiday_counter1; ?>").hide();

	
// add
		$("#savePrice<?php echo $holiday_counter1; ?>").live('click', function(a<?php $j; ?>) {
		var holidayamount<?php echo $j; ?> = $("#holidayamount<?php echo $j; ?>").val();
		var startdate<?php echo $j; ?> = $("#startDate<?php echo $j; ?>").val();
		var propertyid<?php echo $j; ?> = <?php echo $property_id; ?>;
		var enddate<?php echo $j; ?> = $("#endDate<?php echo $j; ?>").val();
		var weight<?php echo $j; ?> = 2;
		var parentid<?php echo $j; ?> = 2;

			  $.post(ROOT_URL+"prices/add", {
			"data[Price][property_id]": propertyid<?php echo $j; ?>,	  
			"data[Price][parent_id]": parentid<?php echo $j; ?>	,  	
			"data[Price][price]": holidayamount<?php echo $j; ?>,
			"data[Price][start_date]": startdate<?php echo $j; ?>,
			"data[Price][end_date]": enddate<?php echo $j; ?>,
			"data[Price][weight]": weight<?php echo $j; ?>,

			
			
	        }, function (data) {

	        	
	        	var obj = $.parseJSON(data);

	        	 var holidayid<?php echo $j; ?> = obj.id;
	        	 var message<?php echo $j; ?> = obj.message;

	        			
	     $("#holidayMessage<?php echo $holiday_counter1; ?>").empty().append( message<?php echo $j; ?> );  
		 $("#id<?php echo $holiday_counter1; ?>").val( obj.id );
			   	
	     //   	$("#holidayMessage<?php echo $holiday_counter1; ?>").html( veeber );
		   		
			   });

		$("#savePrice<?php echo $holiday_counter1; ?>").hide();
		$("#updatePrice<?php echo $holiday_counter1; ?>").fadeIn();
		$("#deletePrice<?php echo $holiday_counter1; ?>").fadeIn();
      
					
	});

	


		// update

			$("#updatePrice<?php echo $holiday_counter1; ?>").live('click', function(u<?php echo $j; ?>) {
			var holidayamount<?php echo $j; ?> = $("#holidayamount<?php echo $j; ?>").val();
			var startdate<?php echo $j; ?> = $("#startDate<?php echo $j; ?>").val();
			var propertyid<?php echo $j; ?> = <?php echo $property_id; ?>;
			var enddate<?php echo $j; ?> = $("#endDate<?php echo $j; ?>").val();
			var weight<?php echo $j; ?> = 2;
			var parentid<?php echo $j; ?> = 2;

			var holidayid<?php echo $j;?> = $("#id<?php echo $holiday_counter1; ?>").val();
			var did<?php echo $j; ?> = $("#id<?php echo $holiday_counter1; ?>").val();
						

			$.post(ROOT_URL+"prices/edit/"+holidayid<?php echo $j; ?>, {
				"data[Price][id]": holidayid<?php echo $j; ?>,			
				"data[Price][price]": holidayamount<?php echo $j; ?>,
				"data[Price][start_date]": startdate<?php echo $j; ?>,
				"data[Price][property_id]": propertyid<?php echo $j; ?>,
				"data[Price][end_date]": enddate<?php echo $j; ?>,
				"data[Price][weight]": weight<?php echo $j; ?>,
				"data[Price][parent_id]": parentid<?php echo $j; ?>
											
				
		        },  function (data) {
		            $("#holidayMessage<?php echo $holiday_counter1; ?>").append(data);
		        });
  		});

	// delete

			$("#deletePrice<?php echo $holiday_counter1; ?>").live('click', function(d<?php echo $j; ?>) {
				var holidayid<?php echo $j;?> = $("#id<?php echo $holiday_counter1; ?>").val();
				var did<?php echo $j; ?> = $("#id<?php echo $holiday_counter1; ?>").val();
				
				var propertyid<?php echo $j; ?> = <?php echo $property_id; ?>;

			$.post(ROOT_URL+"prices/remove_price/"+holidayid<?php echo $j;?>, {
				"data[Price][id]": did<?php echo $j;?>,
				"data[Price][property_id]": propertyid<?php echo $j; ?>
		
		        }, function (data) {
		            $("#holidayMessage<?php echo $holiday_counter1; ?>").html(data);
		        });		

	        	$("#holidayContainer<?php echo $piv_counter; ?>").fadeOut();
			});	
			
});
							
</script>

</div><!-- row -->	
<?php $piv_counter++; ?>	
<?php $holiday_counter++;?>
<?php $holiday_counter1++; ?>
		<?php } // $i?>
		
<?php } // empty holidays_check ?>	
			
		</div><!-- removable -->