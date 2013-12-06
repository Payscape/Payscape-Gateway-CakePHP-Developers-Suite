<?php $this->Html->script('add_sort.js', array('inline' => false)); ?>

<?php
/*
	$count = count($this->request->data['Discount']);
	$values = range(5, 60, 5);
	$values = array_combine($values, $values);
*/
$count = count($this->request->data['Discount']);

$max_discounts = 10;




$values = range(0, .6, .05);
$percents = array(0,5,10,15,20,25,30,35,40,45,50,55,60);
$values = array_combine($values, $percents);

?>		



<script type="text/css">

 
<?php 
		for ($iii = 1; $iii <= $max_discounts; $iii++) { 
?>

.show_hide<?php echo $iii; ?> {
    display:none;
}
<?php 
}
?>
</script>

<div class="addable" id="discounts">
					
<?php $div_counter = 1; ?>
					
<?php if ( empty($this->request->data['Discount'])) { 

	$discount_counter1 = 1;
	$discount_counter = 0;
	?>				
		
		<?php 
		/*
		 * for new Multi-Night Discounts
		 * 
		 * */
		?>
	<div class="removable">
					<?php for ($i = 1; $i <= $max_discounts; $i++) { ?>
					
	<div class="row">
 <?php echo "<br>discount counter1: $discount_counter1<br>"; ?>
 COUNTER: <?php echo $div_counter; ?><br>
					<h3> <span class="btn" id="show_hide<?php echo $div_counter; ?>">Show/hide</span> Create Multi-Night Discount #<?php echo $discount_counter1; ?></h3>
					<h5 id="discountMessage<?php echo $discount_counter1; ?>"></h5>
		<div id="discountContainer<?php echo $div_counter; ?>">		
					<strong>Nights booked:</strong> 
							<?php
//								echo $this->Form->input('Discount.' . $discount_counter . '.id', array('type' => 'hidden', 'value' => $disc1['id']));
							echo $this->Form->input("lower_bound$i", array(
									'name' => "lower_bound$i",
									'type' => 'text',
									'label' => false,
									'div' => false,
									'maxlength' => 3,
									'style'  => 'width:20px',
									'id' => "lowerbound$i",
							));
							?>
						<strong> Discount = </strong> 
							<?php
							echo $this->Form->input("discountamount$i", array(
									'name' => "discountamount$i",
									'type' => 'select',
									'options' => $values,
									'label' => false,
									'div' => false,
									'style' => 'width:70px',
									'id' => "discountamount$i",
							));
							?>
					<strong>% off</strong>
	
	<span class="btn btn-primary" id="saveDiscount<?php echo $discount_counter1; ?>">Save Discount</span>
	<span class="btn btn-info" id="updateDiscount<?php echo $discount_counter1; ?>">Update Discount</span>
	<span class="btn btn-danger" id="deleteDiscount<?php echo $discount_counter1; ?>">Delete Discount</span>
	
	<input type="hidden" style="width:20px;" id="id<?php echo $discount_counter1; ?>"></div>
						<?php //echo $this->Html->image('btn-minus.png', array('alt' => 'Delete', 'title' => 'Delete This Entry', 'class' => 'image-minus delete')); ?>
					
					<div class="seperator-big"></div>
			</div>			
		
<script>						
							
$(function() {

	$("#saveDiscount<?php echo $discount_counter1; ?>").show();
	$("#updateDiscount<?php echo $discount_counter1; ?>").hide();
	$("#deleteDiscount<?php echo $discount_counter1; ?>").hide();

	
// add
		$("#saveDiscount<?php echo $discount_counter1; ?>").live('click', function(a<?php $i; ?>) {
		var discountamount<?php echo $i; ?> = $("#discountamount<?php echo $i; ?>").val();
		var lbound<?php echo $i; ?> = $("#lowerbound<?php echo $i; ?>").val();
		var propertyid<?php echo $i; ?> = <?php echo $property_id; ?>;
		var discounttype<?php echo $i; ?> = "Multi-Night";
		var weight<?php echo $i; ?> = 79;

	
		//var data = {"data[Discount][discount]": discountamount, "data[Discount][lower_bound]": lbound, "data[Discount][property_id]": propertyid, "data[Discount][discount_type]": discounttype};
	
			  $.post(ROOT_URL+"discounts/add", {
	
			"data[Discount][discount]": discountamount<?php echo $i; ?>,
			"data[Discount][lower_bound]": lbound<?php echo $i; ?>,
			"data[Discount][property_id]": propertyid<?php echo $i; ?>,
			"data[Discount][discount_type]": discounttype<?php echo $i; ?>,
			"data[Discount][weight]": weight<?php echo $i; ?>
			
			
	        }, function (data) {

	        	 var obj = $.parseJSON(data);

	        	 var discountid<?php echo $i; ?> = obj.id;
	        	 var message<?php echo $i; ?> = obj.message;

	        			
	        //	 $("#did<?php echo $i; ?>").data("did<?php echo $i; ?>", discountid<?php echo $i; ?>);
		         $("#discountMessage<?php echo $discount_counter1; ?>").empty().append( message<?php echo $i; ?> );  
		    	 $("#id<?php echo $discount_counter1; ?>").val( obj.id );
			   		
			   });

				$("#saveDiscount<?php echo $discount_counter1; ?>").hide();
				$("#updateDiscount<?php echo $discount_counter1; ?>").fadeIn();
				$("#deleteDiscount<?php echo $discount_counter1; ?>").fadeIn();
      
					
	});

	


		// update

			$("#updateDiscount<?php echo $discount_counter1; ?>").live('click', function(u<?php echo $i; ?>) {
			var discountamount<?php echo $i; ?> = $("#discountamount<?php echo $i; ?>").val();
			var lbound<?php echo $i; ?> = $("#lowerbound<?php echo $i; ?>").val();
			var propertyid<?php echo $i; ?> = <?php echo $property_id; ?>;
			var discounttype<?php echo $i; ?> = "Multi-Night";
			var weight<?php echo $i; ?> = 145;


			var discountid<?php echo $i;?> = $("#id<?php echo $discount_counter1; ?>").val();
			var did<?php echo $i; ?> = $("#id<?php echo $discount_counter1; ?>").val();
						

			$.post(ROOT_URL+"discounts/edit/"+discountid<?php echo $i; ?>, {
			"data[Discount][id]": did<?php echo $i; ?>,
			"data[Discount][discount]": discountamount<?php echo $i; ?>,
			"data[Discount][discount]": discountamount<?php echo $i; ?>,
			"data[Discount][lower_bound]": lbound<?php echo $i; ?>,
			"data[Discount][property_id]": propertyid<?php echo $i; ?>,
			"data[Discount][discount_type]": discounttype<?php echo $i; ?>,
			"data[Discount][weight]": weight<?php echo $i; ?>
				
				
		        },  function (data) {
		            $("#discountMessage<?php echo $discount_counter1; ?>").append(data);
		        });
  		});

	// delete

			$("#deleteDiscount<?php echo $discount_counter1; ?>").live('click', function(d<?php echo $i; ?>) {
				var discountid<?php echo $i;?> = $("#id<?php echo $discount_counter1; ?>").val();
				var did<?php echo $i; ?> = $("#id<?php echo $discount_counter1; ?>").val();
				
				var propertyid<?php echo $i; ?> = <?php echo $property_id; ?>;

			$.post(ROOT_URL+"discounts/remove_discount/"+discountid<?php echo $i;?>, {
				"data[Discount][id]": did<?php echo $i;?>,
				"data[Discount][property_id]": propertyid<?php echo $i; ?>
		
		        }, function (data) {
		            $("#discountMessage<?php echo $discount_counter1; ?>").html(data);
		        });		

	        	$("#discountContainer<?php echo $div_counter; ?>").fadeOut();
			});	
			
});
							
</script>

<?php $div_counter++; ?>	
<?php $discount_counter++;?>
<?php $discount_counter1++; ?>
		<?php } // $i?>
			</div><!-- removable -->
<?php } // empty data['Discount'] ?>	
			
		
			
<?php 
	/*
	 * for saved Multi-Night Discounts
	 * 
	 * */
?>		
	
			<?php 
			
			// if Discounts have been created, display them. 
			// for these we want to submit to edit rather than add. 
			
			if ( ! empty($this->request->data['Discount'])) { ?>
<?php $discount_counter = 0; ?>	
<?php $discount_counter_display = (int) $discount_counter + 1; ?>		
<?php $discount_counter2 = 10; ?>
		
		<div class="removable">
				<?php foreach ($this->request->data['Discount'] as $discount) { ?>
		
		<div class="row">
 COUNTER: <?php echo $div_counter; ?><br>
		
	<h3> <span class="btn" id="show_hide<?php echo $div_counter; ?>">Show/hide</span> My Saved Multi-Night Discount #<?php echo $discount_counter_display; ?></h3>
		
					<h5 id="discountMessage<?php echo $discount_counter2; ?>"></h5>
					
					<div id="discountContainer<?php echo $div_counter; ?>">
					 <?php //echo "<br>discount counter2: $discount_counter2"; ?><br>
					
					
					<strong>Nights: </strong> 
							<?php
						
							echo $this->Form->input("lower_bound$discount_counter2", array(
									'type' => 'text',
									'value' => $discount['lower_bound'],
									'label' => false,
									'div' => false,
									'maxlength' => 3,
									'style'  => 'width:20px',
									'id' => "lowerbound$discount_counter2",
							));
						
				
							?>
						 <strong> = Discount of </strong> 
							<?php
							
							echo $this->Form->input("discountamount$discount_counter2", array(
									'name' => "discountamount",
									'type' => 'select',
									'options' => $values,
									'default' => $discount['discount'],
									'label' => false,
									'div' => false,
									'style' => 'width:70px',
									'id' => "discountamount$discount_counter2",
							));
							?>
						<strong> % off </strong>
						<span class="btn btn-info" id="updateDiscount<?php echo $discount_counter2;?>">Update Discount</span>
						
						<span class="btn btn-danger" id="deleteDiscount<?php echo $discount_counter2;?>">Delete Discount</span>
			</div>
	</div>
<script>
	$(function() {

		$("#updateDiscount<?php echo $discount_counter2; ?>").show();
		$("#deleteDiscount<?php echo $discount_counter2; ?>").show();
		
			$("#updateDiscount<?php echo $discount_counter2; ?>").live('click', function(u<?php echo $discount_counter2; ?>) {
			var discountamount<?php echo $discount_counter2; ?> = $("#discountamount<?php echo $discount_counter2; ?>").val();
			var lbound<?php echo $discount_counter2; ?> = $("#lowerbound<?php echo $discount_counter2; ?>").val();
			var propertyid<?php echo $discount_counter2; ?> = <?php echo $property_id; ?>;
			var discounttype<?php echo $discount_counter2; ?> = "Multi-Night";
			var weight<?php echo $discount_counter2; ?> = 185;
			var discountid<?php echo $discount_counter2;?> = <?php echo $discount['id']; ?>;

	//		var data = {"data[Discount][discount]": discountamount, "data[Discount][lower_bound]": lbound, "data[Discount][property_id]": propertyid, "data[Discount][discount_type]": discounttype};
		
-		  $.post(ROOT_URL+"discounts/edit/"+<?php echo $discount['id']; ?>, {
				"data[Discount][id]": discountid<?php echo $discount_counter2;?>,

				"data[Discount][discount]": discountamount<?php echo $discount_counter2; ?>,
				"data[Discount][lower_bound]": lbound<?php echo $discount_counter2; ?>,
				"data[Discount][property_id]": propertyid<?php echo $discount_counter2; ?>,
				"data[Discount][discount_type]": discounttype<?php echo $discount_counter2; ?>,
				"data[Discount][weight]": weight<?php echo $discount_counter2; ?>
				
				
		        },  function (data) {
		            $("#discountMessage<?php echo $discount_counter2; ?>").append(data);
		        });
  		});
			

		$("#deleteDiscount<?php echo $discount_counter2; ?>").live('click', function(d<?php echo $discount_counter2; ?>) {
				var discountid<?php echo $discount_counter2; ?> = <?php echo $discount['id']; ?>;
				var propertyid<?php echo $discount_counter2; ?> = <?php echo $property_id; ?>;

			$.post(ROOT_URL+"discounts/remove_discount/"+discountid<?php echo $discount_counter2; ?>, {
				"data[Discount][id]": discountid<?php echo $discount_counter2; ?>,
				"data[Discount][property_id]": propertyid<?php echo $discount_counter2; ?>
		
		        }, function (data) {
		            $("#discountMessage<?php echo $discount_counter2; ?>").html(data);
		        });		

	        	$("#discountContainer<?php echo $div_counter; ?>").fadeOut();
			});	
			
	});

	
</script>					
					<div class="seperator-big"></div>
		

				<?php 
				$div_counter++;
				$discount_counter2++;
				$discount_counter++;	
				$discount_counter_display++;		
							} 
							?>
		</div><!-- removeable -->
			<?php } ?>
<?php 
	/*
	 * remaining Multi-Night Discount slots
	 * 
	 * */
?>			
			
<?php if($discount_counter < $max_discounts){ 
	$discount_counter3 = 100;
	
	$remainder = (int) $max_discounts - $discount_counter; 

	?>			
				<div class="removable">			
				
<?php //echo "<br>remainder: $remainder"; ?>
 <?php //echo "<br>discount_counter: $discount_counter"; ?>
 <?php //echo "<br>max discounts: $max_discounts"; ?>

<?php for ($i = 1; $i <= $remainder; $i++) { ?>
<?php //echo "<br>discount counter: $discount_counter"; ?>
<?php //echo "<br>discount counter3: $discount_counter3"; ?>
	<div class="row">
 COUNTER: <?php echo $div_counter; ?><br>
	<h3> <span class="btn" id="show_hide<?php echo $div_counter; ?>">Show/hide</span> Add Multi-Night Discount #<?php echo $discount_counter_display; ?></h3>
					<h5 id="discountMessage<?php echo $discount_counter3; ?>"></h5>
	<div id="discountContainer<?php echo $div_counter; ?>">
				<strong>Nights booked: </strong>
				<input id="lBound<?php echo $discount_counter3; ?>" type="text" name="lBound<?php echo $discount_counter3; ?>" style="width:20px;">

						<strong> Discount = </strong> 
						 
		<select name="discounta<?php echo $discount_counter3; ?>" id="discounta<?php echo $discount_counter3; ?>" style="width:70px;">
		<option value="0">0</option>
		<option value="0.05">5</option>
		<option value="0.1">10</option>
		<option value="0.15">15</option>
		<option value="0.2">20</option>
		<option value="0.25">25</option>
		<option value="0.3">30</option>
		<option value="0.35">35</option>
		<option value="0.4">40</option>
		<option value="0.45">45</option>
		<option value="0.5">50</option>
		<option value="0.55">55</option>
		<option value="0.6">60</option>
		</select>							 
						 
		

						<strong>% off</strong>
		<span class="btn btn-primary" id="saveDiscount<?php echo $discount_counter3; ?>">Save Discount</span>
		<span class="btn btn-info" id="updateDiscount<?php echo $discount_counter3; ?>">Update Discount</span>
		<span class="btn btn-danger" id="deleteDiscount<?php echo $discount_counter3; ?>">Delete Discount</span>
					
	<input type="hidden" style="width:20px;" id="id<?php echo $discount_counter3; ?>">
	
</div>	<!-- discountContainer -->	
	
	</div>	<!-- row -->	
					<div class="seperator-big"></div>
					
<script>

		
$(function() {
	$("#saveDiscount<?php echo $discount_counter3; ?>").show();
	$("#updateDiscount<?php echo $discount_counter3; ?>").hide();
	$("#deleteDiscount<?php echo $discount_counter3; ?>").hide();
	
	// add
	$("#saveDiscount<?php echo $discount_counter3; ?>").live('click', function(s<?php echo $discount_counter3; ?>) {
	var discount<?php echo $i; ?> = $("#discounta<?php echo $discount_counter3; ?>").val();
	var lBound<?php echo $i; ?> = $("#lBound<?php echo $discount_counter3; ?>").val();
	var propertyid<?php echo $i; ?> = <?php echo $property_id; ?>;
	var discounttype<?php echo $i; ?> = "Multi-Night";
	var weight<?php echo $i; ?> = 285;

		  $.post(ROOT_URL+'discounts/add', {
			"data[Discount][discount]": discount<?php echo $i; ?>,
			"data[Discount][lower_bound]": lBound<?php echo $i; ?>,
			"data[Discount][property_id]": propertyid<?php echo $i; ?>,
			"data[Discount][discount_type]": discounttype<?php echo $i; ?>,			
			"data[Discount][weight]": weight<?php echo $i; ?>
			
	        }, function (data) {

	        	 var obj = $.parseJSON(data);

	        	 var discountid<?php echo $i; ?> = obj.id;
	        	 var message<?php echo $i; ?> = obj.message;
		            $("#id<?php echo $discount_counter3; ?>").val( discountid<?php echo $i; ?> );
		            $("#discountMessage<?php echo $discount_counter3; ?>").html( message<?php echo $i; ?> );  

			//    $("#id<?php echo $i; ?>").empty().append( obj.id );
	        //    $("#discountMessage<?php echo $i; ?>").html( obj.message );
			

                });

			$("#saveDiscount<?php echo $discount_counter3; ?>").hide();
			$("#updateDiscount<?php echo $discount_counter3; ?>").fadeIn();
			$("#deleteDiscount<?php echo $discount_counter3; ?>").fadeIn();

	        // json returns this
	        // {"id":"137","message":"Your Discount has been saved."}    
			// 

	});

	// update
	
		$("#updateDiscount<?php echo $discount_counter3; ?>").live('click', function(u<?php echo $discount_counter3; ?>) {
			var discountamount<?php echo $discount_counter3; ?> = $("#discounta<?php echo $discount_counter3; ?>").val();
			var lbound<?php echo $discount_counter3; ?> = $("#lBound<?php echo $discount_counter3; ?>").val();
			var propertyid<?php echo $discount_counter3; ?> = <?php echo $property_id; ?>;
			var discounttype<?php echo $discount_counter3; ?> = "Multi-Night";
			var weight<?php echo $discount_counter3; ?> = 185;
			var discountid<?php echo $discount_counter3; ?> = $("#id<?php echo $discount_counter3; ?>").val();

	//		var data = {"data[Discount][discount]": discountamount, "data[Discount][lower_bound]": lbound, "data[Discount][property_id]": propertyid, "data[Discount][discount_type]": discounttype};
		
-		  $.post(ROOT_URL+"discounts/edit/"+discountid<?php echo $discount_counter3; ?>, {
				"data[Discount][id]": discountid<?php echo $discount_counter3; ?>,
				"data[Discount][discount]": discountamount<?php echo $discount_counter3; ?>,
				"data[Discount][lower_bound]": lbound<?php echo $discount_counter3; ?>,
				"data[Discount][property_id]": propertyid<?php echo $discount_counter3; ?>,
				"data[Discount][discount_type]": discounttype<?php echo $discount_counter3; ?>,
				"data[Discount][weight]": weight<?php echo $discount_counter3; ?>
				
				
		        },  function (data) {
		            $("#discountMessage<?php echo $discount_counter3; ?>").append(data);
		        });
  		});

	// delete

		$("#deleteDiscount<?php echo $discount_counter3; ?>").live('click', function(d<?php echo $discount_counter3; ?>) {
			var discountid<?php echo $discount_counter3; ?> = $("#id<?php echo $discount_counter3; ?>").val();
			var propertyid<?php echo $discount_counter3; ?> = <?php echo $property_id; ?>;

		$.post(ROOT_URL+"discounts/remove_discount/"+discountid<?php echo $discount_counter3; ?>, {
			"data[Discount][id]": discountid<?php echo $discount_counter3; ?>,
			"data[Discount][property_id]": propertyid<?php echo $discount_counter3; ?>
	
	        }, function (data) {
	            $("#discountMessage<?php echo $discount_counter3; ?>").html(data);
	        });		

        	$("#discountContainer<?php echo $div_counter; ?>").fadeOut();
		});	
		

		
});
							
</script>

			<?php 
				$discount_counter++;	
				$discount_counter3++;
				$discount_counter_display++;		
	} // $i;				 
							?>
			</div><!-- removable  -->
			<?php }// if ?>				
		

			
					<div class="seperator-big"></div>
				
		<div class="row">
			
							<a href="javascript:history.go(0);"><span class="btn btn-primary">Reset Multi-Night Discounts</span></a>
							<p>
							<br><span style="font-size:13px; font-style:italic;">Use this feature when you have Deleted Multi-Night Discounts
							<br>to Refresh the list of your total Multi-Night Discounts.</span>
							</p>
		</div>
			<?php //$this->Html->scriptblock('counters["discount"] = '.(count($this->request->data['Discount']) + 1).';', array('inline' => false)); ?>

		</div> <!-- .addable -->
		<!-- /////////////////////////////////// -->
	

<script>
$(document).ready(function(){
    $("#discountContainer1").hide();
    $("#show_hide1").show();

$('#show_hide1').click(function(){
$("#discountContainer1").slideToggle();
});
	 
    $("#discountContainer2").hide();
    $("#show_hide2").show();

$('#show_hide2').click(function(){
$("#discountContainer2").slideToggle();
});

 
    $("#discountContainer3").hide();
    $("#show_hide3").show();

$('#show_hide3').click(function(){
$("#discountContainer3").slideToggle();
});

 
    $("#discountContainer4").hide();
    $("#show_hide4").show();

$('#show_hide4').click(function(){
$("#discountContainer4").slideToggle();
});

 
    $("#discountContainer5").hide();
    $("#show_hide5").show();

$('#show_hide5').click(function(){
$("#discountContainer5").slideToggle();
});

 
    $("#discountContainer6").hide();
    $("#show_hide6").show();

$('#show_hide6').click(function(){
$("#discountContainer6").slideToggle();
});

 
    $("#discountContainer7").hide();
    $("#show_hide7").show();

$('#show_hide7').click(function(){
$("#discountContainer7").slideToggle();
});

 
    $("#discountContainer8").hide();
    $("#show_hide8").show();

$('#show_hide8').click(function(){
$("#discountContainer8").slideToggle();
});

 
    $("#discountContainer9").hide();
    $("#show_hide9").show();

$('#show_hide9').click(function(){
$("#discountContainer9").slideToggle();
});

 
    $("#discountContainer10").hide();
    $("#show_hide10").show();

$('#show_hide10').click(function(){
$("#discountContainer10").slideToggle();
});


});

</script>	
