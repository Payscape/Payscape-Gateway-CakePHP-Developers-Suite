<script>
 
$(document).ready(function(){

<?php 
	for ($ii = 1; $ii <= $max_discounts; $ii++) { 				
?>	 
        $("#discountContainer<?php echo $ii; ?>").hide();
        $("#show_hide<?php echo $ii; ?>").show();
 
    $("#show_hide<?php echo $ii; ?>").click(function(){
    $("#discountContainer<?php echo $ii; ?>").slideToggle();
    });

<?php 
		}
?>
 
});
 
</script>