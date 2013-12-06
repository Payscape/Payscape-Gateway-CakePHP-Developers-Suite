
//this is a sample json_encode PHP

// json returns this
// {"id":"137","message":"Your Discount has been saved."}   

here is how we retrieve our data from our json_response

$(function() {
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

});


 


TheObject = {
    getArray: function(callback) {
        var groups = new Array;
        $.ajax({
              type: "POST",
              url: "link.php",
              success: function (data){
                  var counter = 0;
                  $('g',data).each(function(){    
                      var group_name = $(this).find("name").text();
                      var group_id = $(this).find("id").text();
                      var group = {
                         id: group_id,
                         name: group_name
                      }
                      groups[counter] = group;
                      counter++;
                  });
                  callback.call(this,groups);
              }
         });
     }
}

TheObject.getArray(function(a) {
    // this code runs when the ajax call is complete
    alert(a);
});