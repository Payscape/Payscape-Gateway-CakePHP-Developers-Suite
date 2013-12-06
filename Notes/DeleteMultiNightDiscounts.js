
this is from 2

			var discountid<?php echo $discount_counter1; ?> = <?php echo $discount['id']; ?>;
			var propertyid<?php echo $discount_counter1; ?> = <?php echo $property_id; ?>;

		$.post(ROOT_URL+"discounts/remove_discount/"+discountid<?php echo $discount_counter1; ?>, {
			"data[Discount][id]": discountid<?php echo $discount_counter1; ?>,
			"data[Discount][property_id]": propertyid<?php echo $discount_counter1; ?>
	
	        }, function (data) {
	            $("#discountMessage<?php echo $discount_counter1; ?>").html(data);
	        });		

        	$("#discountContainer<?php echo $discount_counter1; ?>").fadeOut();
		});	
		
		http://localhost:8082/vfish22.localdomain/public_html/discounts/edit/?data%5BDiscount%5D%5Bdiscount%5D=0.3&data%5BDiscount%5D%5Bdiscount_type%5D=Multi-Night&data%5BDiscount%5D%5Blower_bound%5D=6&data%5BDiscount%5D%5Bproperty_id%5D=886&data%5BDiscount%5D%5Bweight%5D=145
		
		http://localhost:8082/vfish22.localdomain/public_html/discounts/remove_discount/?data%5BDiscount%5D%5Bid%5D=&data%5BDiscount%5D%5Bproperty_id%5D=886
		
		
		http://localhost:8082/vfish22.localdomain/public_html/discounts/edit/?data%5BDiscount%5D%5Bdiscount%5D=0.25&data%5BDiscount%5D%5Bdiscount_type%5D=Multi-Night&data%5BDiscount%5D%5Blower_bound%5D=6&data%5BDiscount%5D%5Bproperty_id%5D=886&data%5BDiscount%5D%5Bweight%5D=145
		
		
	
// this is from 3
			
			<script>

		$(document).ready(function()
		{
			$("#saveDiscount<?php echo $discount_counter3; ?>").show();
			$("#updateDiscount<?php echo $discount_counter3; ?>").hide();
			$("#deleteDiscount<?php echo $discount_counter3; ?>").hide();
				
		});	

				
		$(function() {
			
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
				            $("#id<?php echo $discount_counter3; ?>").empty().append( discountid<?php echo $i; ?> );
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
					var discountid<?php echo $discount_counter3; ?> = $("#did<?php echo $discount_counter3; ?>").val();

			//		var data = {"data[Discount][discount]": discountamount, "data[Discount][lower_bound]": lbound, "data[Discount][property_id]": propertyid, "data[Discount][discount_type]": discounttype};
				
		-		  $.post(ROOT_URL+"discounts/edit/"+discountid<?php echo $discount_counter3; ?>, {

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
					var discountid<?php echo $discount_counter3; ?> = <?php echo $discount['id']; ?>;
					var propertyid<?php echo $discount_counter3; ?> = <?php echo $property_id; ?>;

				$.post(ROOT_URL+"discounts/remove_discount/"+discountid<?php echo $discount_counter3; ?>, {
					"data[Discount][id]": discountid<?php echo $discount_counter3; ?>,
					"data[Discount][property_id]": propertyid<?php echo $discount_counter3; ?>
			
			        }, function (data) {
			            $("#discountMessage<?php echo $discount_counter3; ?>").html(data);
			        });		

		        	$("#discountContainer<?php echo $discount_counter3; ?>").fadeOut();
				});	
				

				
		});
									
		</script>			