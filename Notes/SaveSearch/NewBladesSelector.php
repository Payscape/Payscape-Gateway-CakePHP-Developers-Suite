<?php 
//session_start();
	//print_r($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>California Cold Saw Online New Blade Selector</title>

<meta name="keywords" content="cold, saw, blade, selection, calculator, online, number of teeth, grind, recommendation" />
<meta name="description" content="Welcome to the California Cold Saw Online New Blade Selectpr. Here you may 
select your Cold Saw Blade Specifications, including Diameter, Thickness, Bore, Pinholes and Number of Teeth using
our unique online tools to assist you in determining the Grind and Number of Teeth for your Cold Saw Blade selection. You may also choose number of teeth yourself if you prefer and still see the recommended Grind for your selection." />

<meta name="author" content="CaliforniaColdSaw.com" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style_imagehover.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/stylesheet_custom.css" />
<!--[if IE] -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/stylesheet_ie_fix.css" />
<!--  [endif] -->
<link rel="stylesheet" media="print" href="<?php echo base_url(); ?>css/print_stylesheet.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>select.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>SpryAssets/SpryMenuBarHorizontal.css" type="text/css" />
<style type="text/css">
ul.bore_images {
	float: left;
	list-style: none;
	margin: 0; padding: 10px;
	width: 360px;
}
ul.bore_images li {
	margin: 0; padding: 5px;
	float: left;
	position: relative;  /* Set the absolute positioning base coordinate */
	width: 92px;
	height: 96px;
}
ul.bore_images li img {
	width: 92px; height: 96px; /* Set the small thumbnail size */
	-ms-interpolation-mode: bicubic; /* IE Fix for Bicubic Scaling */
	border: 1px solid #ddd;
	padding: 5px;
	background: #f0f0f0;
	position: absolute;
	left: 0; top: 0;
}
/*	background:url(<?php echo base_url(); ?>images/bg316x332.png) no-repeat center center;  /* Image used as background on hover effect */
ul.bore_images li img.hover {
	border: none; /* Get rid of border on hover */
	z-index:900;
}

</style>

<script type="text/javascript">
	function Biopopup(strurl)
	{
		window.open(strurl,'Bio','width=550, height=500,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,left=0,top=0')
	} 
</script> 
<script src="<?php echo base_url(); ?>SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>jscript/jscript_imagehover.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	
	$("#thickness_message").hide();
    $("#bore_message").hide();
    $("#material_message").hide();
    $("#tooth_count_message").hide();
    $("#switch").hide();

    $("#recommend").hide();
    $("#self").hide();
    
    $("#diameter_message").show();

    $('#thickness').hide();
    $('#bore').hide();
    $('#hub').hide();
    $('#pinholes').hide();
    $('#machine').hide();
    $('#blade_surface').hide();
    $("div.blockMsg").text("New Blade Selector");
    
    $("div.instructions").text("Once your blade selection is complete, you will be able to add it to your cart.");
    $("#diameter1").removeClass("passive").addClass("active");
    $("#material").hide();
    $("#calc_id").hide();
    $("#pricing_id").hide();
    $("#calc_message").hide(); 

    $("#round_tubing_diameter").hide(); 
    $("#round_wall_thickness").hide(); 
    $("#square_flat_width_across").hide(); 
    $("#square_flat_wall_thickness").hide(); 
    $("#square_diagonal_wall_thickness").hide(); 
    $("#structurals_average_thickness").hide();
    $("#solids_width_across").hide(); 

    $("#auto_tooth_material_shape").hide();
$('.acc_container').hide(); //Hide/close all containers
	

		$("ul.bore_images li").hover(function() {
			$(this).css({'z-index' : '10'}); /*Add a higher z-index value so this image stays on top*/ 
			$(this).find('img').addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/
				.animate({
					marginTop: '0px', /* The next 4 lines will vertically align this image */ 
					marginLeft: '0px',
					top: '0%',
					left: '0%',
					width: '296px', /* Set new width */
					height: '312px', /* Set new height */
					padding: '20px'
				}, 200); /* this value of "200" is the speed of how fast/slow this hover animates */
		
			} , function() {
			$(this).css({'z-index' : '0'}); /* Set z-index back to 0 */
			$(this).find('img').removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
				.animate({
					marginTop: '0', /* Set alignment back to default */
					marginLeft: '0',
					top: '0',
					left: '0',
					width: '92px', /* Set width back to default */
					height: '96px', /* Set height back to default */
					padding: '5px'
				}, 400);
		
			
		});

});


// begin ccs.js
$(function () {
    $("#diameter_id").ready(function () {
        var diameter = $("select#diameter_id").val();
    });
    $("#diameter_id").change(function () {
        var diameter = $("#diameter_id").val();
        var thickness = "";
        var bore = "";
        var hub = "";
        var pinholes = "";
        $("#thickness").show();
        $("#bore").hide();
        $("#hub").hide();
        $("#pinholes").hide();
        $("#machine").hide();
        $("#bore_message").hide();
        $("#diameter_message").hide();
        $("#thickness_message").fadeIn("slow");
        $("#machine").hide();
        $("#material").hide();
        $("#calc_id").hide();
        $("#calc_message").hide();
        $("#pricing_id").hide();
 //       $("div.blockMsg").text("Blade Thickness");
        $("td.#diameter1").removeClass("active").addClass("passive");
        $("td.#thickness1").removeClass("passive").addClass("active");
        $("td.#bore1").removeClass("active").addClass("passive");
        $("td.#hub1").removeClass("active").addClass("passive");
        $("td.#pinholes1").removeClass("active").addClass("passive");
        $("#material_message").hide();
        $("#tooth_count_message").hide();
        $("#material_shapes_id").hide();
        $(".selector_div").hide();
 
        $.post("<?php echo base_url(); ?>blade/thickness", {
            dia: diameter
        }, function (data) {
            $("#thickness_id").html(data);
        });
    });
    $("#thickness_id").ready(function () {
        var diameter = $("#diameter_id").val();
        //var thickness = $("select#thickness_id").val();
    });
    $("#thickness_id").change(function () {
        var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        $("td.#diameter1").removeClass("active").addClass("passive");
        $("td.#thickness1").removeClass("active").addClass("passive");
        $("td.#bore1").removeClass("passive").addClass("active");
        $("td.#hub1").removeClass("active").addClass("passive");
        $("td.#pinholes1").removeClass("active").addClass("passive");
        $("#bore").show();
       $("#bore_message").hide();
       $("#material").hide();
       $("#material_shapes_id").hide();
       $(".selector_div").hide();
       $("#thickness_message").hide();
       $("#material_message").hide();
       $("#tooth_count_message").hide(); 
       $("#auto_tooth_material_shape").hide();
       $("#calc_message").hide();      
       $("#self_calc").hide();
       $("#calc_id").hide();
       
        $("#machine").hide();
        $("#hub").hide();
        $("#pinholes").hide();
        $("#pricing_id").hide();
//        $("div.blockMsg").text("Blade Bore");
        $.post("<?php echo base_url(); ?>blade/bore", {
            dia: diameter,
            thi: thickness
        }, function (data) {
            $("#bore_id").html(data);
        });
    });
    $("#bore_id").ready(function () {
        var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        //var bore = $("select#bore_id").val();
    });
    $("#bore_id").change(function () {
        var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        $("#pricing_id").hide();
        $("#machine").hide();
        $("#tooth_count_message").hide();
        $("#auto_tooth_material_shape").hide();
        $("td.#hub1").removeClass("active").addClass("passive");
        $("td.#pinholes1").removeClass("active").addClass("passive");
        $("td.#material1").removeClass("active").addClass("passive");
        $("#hub").hide();
        $("#pinholes").hide();
        $("#calc_message").hide();      
        $("#self_calc").hide();
        $("#calc_id").hide();
 
// the user may have changed the bore selection         
        $("#material_shapes_id").hide();
        $("#material_message").hide();
        $("#material").hide();        
        $(".selector_div").hide();
 
// get bore images
 

 
 		$("#thickness_message").hide();

// get hub and pinholes first
 	    $.post("<?php echo base_url(); ?>blade/hub", {
 	       dia: diameter,
 	       thi: thickness,
 	       bor: bore
 	       }, function (data) {
 	       $("#hub_id").html(data);
 	       });
 	       
 	                      
 	       $.post("<?php echo base_url(); ?>blade/pinholes", { dia: diameter, thi: thickness, bor: bore }, 
 	   	function (data) {
 	       $("#pinholes_id").html(data);
 	       });
 	       
 	$("#hub").show();    
 	$("#pinholes").show();    
 	       
 	      $.post("<?php echo base_url(); ?>blade/bore_image2", 
 	    			{
 	    	 	 	dia: diameter,
 	    	 	 	thi: thickness,
 	    	 	    bor: bore
 	    	 	  }, function (data) {
 	    	 		  
 	    	 		 $("#img1").html(data);		  
 	    	 		  
 	    	 	  });

        $.post("<?php echo base_url(); ?>blade/machine_question", {
            dia: diameter,
            thi: thickness,
            bor: bore
        }, function (data) {
            var ask_question = data;
            if (ask_question == 1) {
            	
            	$.post("<?php echo base_url(); ?>blade/machine_question_text", {
                    dia: diameter,
                    thi: thickness,
                    bor: bore
                }, function(data){
                	$("#machine_question").text(data);
 
                });
                $("td.#diameter1").removeClass("active").addClass("passive");
                $("td.#bore1").removeClass("active").addClass("passive");
                $("td.#machine").removeClass("passive").addClass("active");
                $.post("<?php echo base_url(); ?>blade/machine", {
                    dia: diameter,
                    thi: thickness,
                    bor: bore
                }, function (data) {
                    $("#machine_id").html(data);
                });
                $("#machine").show();
            } else {
                $.post("<?php echo base_url(); ?>blade/material", {
                    dia: diameter,
                    thi: thickness,
                    bor: bore
                }, function (data) {
                    $("#material_id").html(data);
                });
                
                $("td.#material1").removeClass("passive").addClass("active");         
                $("#material").show();
                $("#material_message").fadeIn("slow");

            }

  	       $("#bore_message").fadeIn("slow"); 
                
                $("td.#diameter1").removeClass("active").addClass("passive");
                $("td.#bore1").removeClass("active").addClass("passive");
                $("td.#hub1").removeClass("passive").addClass("active");
                $("td.#pinholes1").removeClass("passive").addClass("active");
                $("td.#material1").removeClass("passive").addClass("active");
               // $("#material").show();
        });
    });
 
 
    $("#machine_id").change(function () {
    	var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("#machine_id").val();
        var machine = $("#machine_id").val();
        
        $("#tooth_count_message").hide();
        $("#pricing_id").hide();
        $("#tooth_count_message").hide(); 
        $("#auto_tooth_material_shape").hide();
        $("#calc_message").hide();      
        $("#self_calc").hide();
        $("#calc_id").hide();
        $("#calc_message").hide();
        $("#tooth_count_message").hide();
        $("#material_shapes_id").hide();
        $(".acc_trigger").hide();
        $("#switch").hide();
        $(".selector_div").hide();        
        $("td.#machine").removeClass("active").addClass("passive");
        $("td.#hub1").removeClass("passive").addClass("active");
        $("td.#pinholes1").removeClass("passive").addClass("active");
        $("td.#material1").removeClass("passive").addClass("active");
 
        if (machine == "140mm"){
            var machine_response = "Yes";
        } else {
            var machine_response = "No";
        }
 
        	
       
        $("input[name=attribute4]").val(machine_response);
 
        $.post("<?php echo base_url(); ?>blade/machine_hub", {hu: hub}, 
        function (data) {
            $("#hub_id").html(data);
        });
 
               
        $.post("<?php echo base_url(); ?>blade/pinholes", {dia: diameter,
            thi: thickness,
            bor: bore
            
        }, function (data) {
            $("#pinholes_id").html(data);
        });
                

               
        $.post("<?php echo base_url(); ?>blade/material", {
            dia: diameter,
            thi: thickness,
            bor: bore
        }, function (data) {
            $("#material_id").html(data);
        });
 
        $("#material").show();
        $("#material_message").fadeIn("slow");

    
    }); // machine id change function.
    
    $("#material_id").change(function () {
 
        var material_type = $("#material_id").val();
 
        $("td.#hub1").removeClass("active").addClass("passive");
        $("td.#pinholes1").removeClass("active").addClass("passive");
        $("td.#material1").removeClass("active").addClass("passive");
        $("input[name=attribute2]").val(material_type);
		$("#acc_container_autotooth").hide();
		$("#self_calc").hide();
	 	$("#material_shapes_id").hide();
	 	$("#pricing_id").hide();
        $("#material_message").hide();
        $("#calc_id").show();
        $("#calc_message").fadeIn("slow");
        $("#tooth_count_message").hide();
        $(".acc_trigger").show();
        $("#switch").show();
    });
 
    $("#autotooth_calc_trigger").click(function () {
        var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
 
        $(".selector_div").hide();
        
        $.post("<?php echo base_url(); ?>blade/material_shapes", {
            dia: diameter,
            thi: thickness,
            bor: bore
        }, function (data) {
            $("#material_shape_id").html(data);
        });
 
        
        $("#material_message").hide();
        $("#tooth_count_message").hide();
        $("#calc_message").fadeIn("slow");
        $("#self_calc").hide();
        $("#pricing_id").hide();
 
        $("#round_wall_thickness").hide();
        $("#square_flat_wall_thickness").hide();
        $("#square_diagonal_wall_thickness").hide();
        $("#structurals_average_thickness").hide();
       	$("#solids_width_across").hide();
        
        $("#acc_container_autotooth").show();       
        $("#self").hide();
        $("#auto_tooth_material_shape").show();   
        $("#material_shape_id").show();
        $("#material_shapes_id").show();             
    });
    
    $("#self_calc_trigger").click(function () {
        var diameter = $("#diameter_id").val();
        $("#tooth_count_message").fadeIn("slow");
        $("#material_message").hide();
        $("#acc_container_autotooth").hide();
        $("#calc_message").hide();
        $("#pricing_id").hide();
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide();
        $("#solids_width_across").hide(); 
		$("#self_calc").show();
        $("#auto_tooth_material_shape").hide();
        $("#recommend").hide();

        $.post("<?php echo base_url(); ?>blade/self_calc_teeth", {
            dia: diameter
        }, function (data) {
            $("#self_calc_teeth").html(data);
        	$("#self_calc").fadeIn("slow");
        
        });
    });
 

 
	$("#material_shape_id").ready(function () {
	 $("#material_message").hide();
	 
        $("#round").hide();
        $("#square").hide();
        $("#square_diagonal").hide();
        $("#solids").hide();
        $("#structurals").hide();
    });
    $("#material_shape_id").change(function () {
 
    	$("#material_message").hide();
    	$("material_shapes_id").show();     
        $("#round").hide();
        $("#square").hide();
        $("#square_diagonal").hide();
        $("#solids").hide();
        $("#structurals").hide();
        $("#pricing_id").hide();
        $("#round_diameter").hide();
        $("#square_across").hide();
 
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide();
        $("#solids_width_across").hide(); 
 
        $("#calc_message").hide();
        
        if ($(this).val() == "round") {
 
            $.post("<?php echo base_url(); ?>blade/wall_round_pitch", {
                
            }, function (data) {
                $("#round_wall_id").html(data);
                $("input[name=attribute3]").val("Round Tubing");
            });
            
            $("#round").show();
            $("#round_wall_thickness").show();
 
        }
        if ($(this).val() == "square") {
 
            $.post("<?php echo base_url(); ?>blade/wall_square_pitch", {
                
            }, function (data) {
                $("#square_wall_id").html(data);
                $("input[name=attribute3]").val("Square Tubing");
                
            });
 
 
        	$("#square").show();            
            $("#square_flat_wall_thickness").show();
 
        }
        if ($(this).val() == "square_diagonal") {
 
            $.post("<?php echo base_url(); ?>blade/wall_square_diagonal_pitch", {
                
            }, function (data) {
                $("#square_diagonal_id").html(data);
                $("input[name=attribute3]").val("Square Diagonal");
                
            });
            
            $("#square_diagonal").show();                      
            $("#square_diagonal_wall_thickness").show();
 
        }
        if ($(this).val() == "solids") {
 
            $.post("<?php echo base_url(); ?>blade/across_solids_pitch", {
                
            }, function (data) {
                $("#solids_id").html(data);
                $("input[name=attribute3]").val("Solids");
                
            });
 
        	$("#solids").show();           
            $("#solids_width_across").show();
        }
        if ($(this).val() == "structurals") {
 
            $.post("<?php echo base_url(); ?>blade/across_structurals_pitch", {
                
            }, function (data) {
                $("#structurals_id").html(data);
                $("input[name=attribute3]").val("Structurals");
 
            });	
        	
        	$("#structurals").show();           
            $("#structurals_average_thickness").show();
        }
    });
 
    $("#round_wall_id").change(function () {
 
        var round_wall = $("#round_wall_id").val();
 
        $("#pricing_id").hide();
        
        $.post("<?php echo base_url(); ?>blade/round_diameter", {
            round_wall_thick: round_wall
        }, function (data) {
            $("#round_diameter_id").html(data);
             $("#round_diameter").show();
             
              $("#round_tubing_diameter").show();
        });
    });
    $("#round_diameter_id").change(function () {
        var diameter = $("#diameter_id").val();
        var round_diameter = $("#round_diameter_id").val();
        var round_wall = $("#round_wall_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("div#hub_id").text();

        $("#calc_message").hide();
        $("#bore_message").hide();
 
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();
        
        $.post("<?php echo base_url(); ?>blade/round_pitch", {
            dia: diameter,
            round_dia: round_diameter,
            round_wal: round_wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
            
            $("input[name=attribute1]").val(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });
 
 
        $("#pricing_id").fadeIn("slow");
//        $("#pricing_id").show();
    });
    $("#square_wall_id").change(function () {
        var square_wall = $("#square_wall_id").val();
 
        $("#pricing_id").hide();
                
        $.post("<?php echo base_url(); ?>blade/square_across", {
            square_wal: square_wall
        }, function (data) {
            $("#square_across_id").html(data);
            $("#square_across").show();
                        
            $("#square_flat_width_across").show();
 
        });
    });
    $("#square_across_id").change(function () {
        var diameter = $("#diameter_id").val();
        var square_across = $("#square_across_id").val();
        var square_wall = $("#square_wall_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("div#hub_id").text();

        $("#calc_message").hide();
        $("#bore_message").hide();
 
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();
        
        $.post("<?php echo base_url(); ?>blade/square_pitch", {
            dia: diameter,
            square_acr: square_across,
            square_wal: square_wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data); 
            $("#recommend").show();
                       
            $("input[name=attribute1]").val(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });
 
        //$("#pricing_id").show();
        $("#pricing_id").fadeIn("slow");
    });
    $("#square_diagonal_id").change(function () {
        var diameter = $("#diameter_id").val();
        var wall = $("#square_diagonal_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("div#hub_id").text();

        $("#calc_message").hide();
        $("#bore_message").hide();
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide(); 
        
        $.post("<?php echo base_url(); ?>blade/square_diagonal_pitch", {
            dia: diameter,
            wal: wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);  
            $("#recommend").show();
                      
            $("input[name=attribute1]").val(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });
       
       // $("#pricing_id").show();
        $("#pricing_id").fadeIn("slow");
    });
    $("#structurals_id").change(function () {
        var diameter = $("#diameter_id").val();
        var across = $("#structurals_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("div#hub_id").text();

        $("#calc_message").hide();
        $("#bore_message").hide();
 
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();      
                
        $.post("<?php echo base_url(); ?>blade/structurals_pitch", {
            dia: diameter,
            acr: across
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
            
            $("input[name=attribute1]").val(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });
  
//        $("#pricing_id").show();
        $("#pricing_id").fadeIn("slow");
    });
    
    $("#solids_id").change(function () {
        var diameter = $("#diameter_id").val();
        var across = $("#solids_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var hub = $("div#hub_id").text();

        $("#calc_message").hide();
        $("#bore_message").hide();
        $("#pricing_id").hide();
 
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();         

        
        $.post("<?php echo base_url(); ?>blade/solids_pitch", {
            dia: diameter,
            acr: across
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
           
            $("input[name=attribute1]").val(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });

//        $("#pricing_id").show();
        $("#pricing_id").fadeIn("slow");
    });
 
    $("#self_calc_teeth").change(function () {
        var diameter = $("#diameter_id").val();
        var thickness = $("#thickness_id").val();
        var bore = $("#bore_id").val();
        var teeth = $("#self_calc_teeth").val();
        var hub = $("div#hub_id").text();

   	 $("#tooth_count_message").hide();
        
        $("#calc_message").hide();
        $("#bore_message").hide();
        $("#pricing_id").hide();
        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();         
        $("#calc_message").hide();
        $("#pricing_id").show();
        

        $.post("<?php echo base_url(); ?>blade/self_calc_blade", {
            dia: diameter,
            teet: teeth
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#self").show();
            
            $("input[name=attribute1]").val(data);
        });

        $.post("<?php echo base_url(); ?>blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });

        $.post("<?php echo base_url(); ?>blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
   
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
  
        $.post("<?php echo base_url(); ?>blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });

        

       // $("#pricing_id").fadeIn("slow");
     
    });
});
</script>


</head>
<body id="Body">
<a name="top"></a>

<!--  onload="init_css_buttons();" -->
<div id="mainWrapper" style="z-index:-1;">
   <div id="headerWrapper">
    <div id="designBannerOne" class="designBanner">
    <table width="943" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="45px" style="text-align:right; background-image:url(<?php echo base_url(); ?>images/headerbar.png);">
  
    <a onmouseover='this.style.cursor="pointer" ' onclick="document.getElementById('PopUp3').style.display = 'block' ">
    <img src="<?php echo base_url(); ?>images/shoponline.png" alt="Shop Online by clicking NEW BLADES/HSS or COOLANTS" style="float:left;" border="0" /></a>
	
<div id='PopUp3' style='display: none; position:fixed; top:10px; right:650px; border: solid black 1px; padding: 5px; background-color: rgb(255,255,225); color: #000; text-align: left; font-size: 12px; width: 250px; z-index:50;'><div align="center">Shop Online by clicking <br /><b>NEW BLADES/HSS</b> or <b>COOLANTS</b></div>
    <div style='text-align: right;'><a onmouseover='this.style.cursor="pointer" ' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('PopUp3').style.display = 'none' " ><span style="text-decoration: underline;">Close</span></a></div>
    </div> 
    
    <table border="0" cellspacing="10" cellpadding="0" style="float:right;">
      <tr>
        <td nowrap="nowrap"><a href="<?php echo $domain_url; ?>cart/index.php?main_page=login" style="text-decoration:none"><img src="<?php echo base_url(); ?>images/status_online.png" alt="Log In" width="16" height="16" hspace="5" border="0" />Sign In</a></td>
        <td nowrap="nowrap"><a href="<?php echo $domain_url; ?>cart/index.php?main_page=shopping_cart" style="text-decoration:none"><img src="<?php echo base_url(); ?>images/cart.png" alt="Log In" width="16" height="16" hspace="5" border="0" />View Cart</a></td>
        <td align="right"><img src="<?php echo base_url(); ?>images/visa-mastercard-logo.png" height="21" alt="Credit Cards" /></td>
        
        <td nowrap="nowrap"><form name="quick_find_header" action="<?php echo $domain_url; ?>cart/index.php?main_page=advanced_search_result" method="get">
		<input type="hidden" name="main_page" value="advanced_search_result" />
		<input type="hidden" name="search_in_description" value="1" />
		<input type="text" name="keyword" size="6" maxlength="30" style="width: 175px" value="Search PRODUCTS here" onfocus="if (this.value == 'Search PRODUCTS here') this.value = '';" onblur="if (this.value == '') this.value = 'Search PRODUCTS here';" />&nbsp;<input class="cssButton button_search"  type="submit" value="Search"  /></form></td>
        <td width="15px">&nbsp;</td>
      </tr>
    </table>
    
    </td>
  </tr>   
  <tr>
    <td><img src="<?php echo base_url(); ?>images/headerlogo.png" alt="California Saw" width="943" height="151" border="0" usemap="#nav" /></td>
  </tr>
  <tr>
    <td bgcolor="#000000">
      <table width="942" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="8" bgcolor="#000000"></td>
          <td style="background-image:url(<?php echo base_url(); ?>images/brushed.jpg);">
          <ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="<?php echo $domain_url; ?>/index.php">HOME</a>        </li>
      <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=2">ABOUT US</a></li>
      <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=9">CNC SHARPENING</a></li>
      <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=index&cPath=9">COOLANTS</a></li>
      <li><a href="#" onclick="return false" class="MenuBarItemSubmenu">NEW BLADES</a>
        <ul>
          <li><a href="<?php echo base_url(); ?>blade/index">HIGH SPEED STEEL</a></li>
          <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=15">CARBIDE TIPPED</a></li>
          <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=16">SEGMENTAL</a></li>
        </ul>
      </li>

      <li><a href="#" onclick="return false" class="MenuBarItemSubmenu">RESOURCES</a>
        <ul>
          <li><a href="<?php echo base_url(); ?>calculate/index">CALCULATORS</a></li>
          <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=18">FAQ's</a></li>
          <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=19&amp;chapter=0">SHIPPING TIPS</a></li>
<li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&id=13">WHOLESALE</a></li>
        </ul>
      </li>
      <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=12">POLICIES</a></li>
      <li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=contact_us">CONTACT US</a></li>
    </ul></td>
          <td width="8" bgcolor="#000000">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>

  <map name="nav" id="nav">
    <area shape="rect" coords="2,3,435,145" href="<?php echo $domain_url; ?>/index.php" alt="Home" />
    <area shape="rect" coords="803,8,938,144" href="<?php echo $domain_url; ?>cart/index.php?main_page=page&id=12#shipping" alt="Free Shipping" />
  </map><script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script></div>
   </div>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="contentMainWrapper">
   <tr>
    <td id="designInsert1"></td>
     <td id="navColumnOne" class="columnLeft" style="width: 170px;">
<!--  left nav begin -->
<div id="navColumnOneWrapper" style="width: 205px; padding-top:17px;">

<img src="<?php echo base_url(); ?>images/kin.png" border="0" usemap="#sideboxes" />
<map name="sideboxes" id="sideboxes"> 
  <area shape="rect" coords="1, 0, 206, 97" href="<?php echo base_url(); ?>blade/index" alt="AutoTooth" /> 
  <area shape="rect" coords="27, 121, 174, 173" href="http://www.kinkelder.nl/en" target="_blank" alt="Kinkelder" /> 
  <area shape="rect" coords="24, 183, 172, 231" href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=12#sharpeningg" alt="Sharpening" /> 
  <area shape="rect" coords="3, 241, 198, 347" href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=12#delivery" alt="Local Pickup &amp; Delivery" /> 
</map>
</div>
<!-- bof: authorize.net -->
<div style="width:100px; height:100px; margin-left:60px;">
<!-- (c) 2005, 2012. Authorize.Net is a registered trademark of CyberSource Corporation --> <div class="AuthorizeNetSeal"> <script type="text/javascript" language="javascript">var ANS_customer_id="b3bd352e-a837-4339-9016-e21eb4b82d55";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Merchant Services</a> </div>
</div>
<!-- eof: authorize.net -->
<!-- left nav end -->
     </td>
    <td id="designInsert2"></td>

    <td valign="top" id="mainPageColumn">     
     

     <div class="centerColumn" id="ezPageDefault">
<h1 id="ezPagesHeading">High Speed Steel</h1>

    <div><table cellspacing="5" cellpadding="5" border="0" width="100%">
    <tbody>
        <tr>
            <td colspan="2">
            <p><img alt="" style="width: 386px; height: 116px;" src="<?php echo base_url(); ?>images/X3.jpg" />
            <a href="<?php echo base_url();?>blade/index/#selector">
            <img border="0" align="right" width="260" height="89" alt="" src="<?php echo base_url(); ?>images/autotooth2.png" /></a>
            </p>
            <p style="text-align: left;">&nbsp;<br />
            <span style="font-size: large; font-family: Arial; font-weight:bold; font-style:italic; color: rgb(255, 255, 0);">
            We are the Largest Kinkelder Authorized Dealer<br />
            and Re-Grind Center on the West Coast !
            </span></p>
            <p>&nbsp;</p>
            <p style="text-align: left;"><span style="font-size: small; color: rgb(255, 102, 0); font-family: Verdana;">
            <strong><i>
            Please read about Blade Types before<br />
            proceeding to the New Blade Selector.</i></strong></span></p>
            <p><span style="color: rgb(0, 255, 0);font-size: medium;">
            <b>HSS Cold Saw Blade Descriptions</b></span><br />
We manufacture and sharpen several types of High Speed Steel (HSS) Cold Saw Blades for specific applications. After reading these brief descriptions, you may click on the orange Jump Down button, or scroll to the bottom of this page, to access the New Blade Selector.            
</p>
            </td>
        </tr>
        <tr>
            <td bgcolor="#cccccc" colspan="2"><span style="font-size: medium;"><span style="color: rgb(0, 0, 0);"><b>BLACK OXIDE </b></span></span></td>
        </tr>
        <tr>
            <td valign="top">
            <p><img height="147" width="300" src="<?php echo base_url(); ?>images/new-half-vt-blade.jpg" alt="" />&nbsp;</p>
            <p>&nbsp;</p>
            </td>
            <td align="left" valign="top">
            <p>
            Black Oxide HSS Cold Saw blades (also known as Vapor Treated, VT, or Steam Treated) have a Ferric Oxide surface coating for a longer blade life and reduced galling with steel. They are mainly used for cutting steels on manual and semi-automatic sawing machines. Vapor Treated blades can be used to cut small amounts of non-ferrous metals (like aluminum), but galling may be a problem. VT blades have a dark grey, almost black finish over the entire blade. We sell KINKELDER brand VT blades in all sizes, and our house brand Economy VT blade (asian) in popular sizes.</p>
            </td>
        </tr>
        <tr>
            <td bgcolor="#cccccc" colspan="2"><span style="font-size: medium;"><span style="color: rgb(0, 0, 0);"><b>BRIGHT</b></span></span></td>
        </tr>
        <tr>
            <td valign="top">
            <p><img height="151" width="300" alt="" src="<?php echo base_url(); ?>images/new-half-bright-blade.jpg" /></p>
            <p>&nbsp;</p>
            </td>
            <td align="left" valign="top">
            <p>
			Bright HSS Cold Saw blades have no surface treatment. They are ideal for reducing galling when cutting non-ferrous (without iron) metals such as Aluminum, Brass, Bronze and Copper. Bright blades have a bright, shiny surface as their name implies. We sell KINKELDER brand bright blades.
            
            </p>
            </td>
        </tr>
        <tr>
            <td bgcolor="#cccccc" colspan="2"><span style="font-size: medium;"><span style="color: rgb(0, 0, 0);"><b>EC3000</b></span></span></td>
        </tr>
        <tr>
            <td align="left" valign="top">
            <p><img height="146" width="300" alt="" src="<?php echo base_url(); ?>images/ec3000.jpg" /></p>
            <p>&nbsp;</p>
            </td>
            <td valign="top">
            <p>
            EC3000 HSS Cold Saw blades by KINKELDER are a cost effective saw blade featuring a very sophisticated, proprietary multi-coating. This special coating and procedure was developed to give the blade exceptional surface hardness and a very low friction coefficient. EC3000 blades offer an excellent price to performance ratio… high performance at an attractive price. EC3000 blades feature a multi-layered orange colored band extending in about two thirds from the edge of the blade. The final coatings are Titanium Carbon Nitride (TiCN).
            </p>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" colspan="2"><b>EC3000  Advantages:</b>
            <ul>
                <li>Ideal for cutting tubes and profiles, but  efficiencies will be realized in all applications.</li>
                <li>20% - 30% increase in life between sharpenings over VT blades. Easily outperforms Titanium Nitride (TiN) coated  blades, and often at a lower price.</li>
                <li>Cuts faster than a vapor treated blade. Higher   cutting speeds can be achieved as the coating protects the blade against  heat  and side welding.</li>
                <li>Cutting speeds and blade life over vapor treated  blades is expected to yield immediate efficiency gains.</li>
                <li>Allows you to be able to increase your machines  RPM and FEED RATE by 8-10% each <em>(on  variable speed machines only)</em>.</li>
            </ul>
            <br />
         
                        <p><span style="color: rgb(0, 255, 0); font-size: medium; font-weight:bold">KINKELDER PERFORMANCE, POWER AND SUPREME BLADES</span><br />
            
            We can also supply these special purpose KINKELDER blades upon request.</p>
            <a name="blade">&nbsp;</a></td>
        </tr>
    </tbody>
</table>
</div>
<!--  begin new blade selector -->
<div id="wrapper">


      <a name="selector"></a>
 <div style="margin-right: auto; margin-left:auto; width: 600px; height:auto; padding:10px;" id="instructions">
            <table border="0" style="width:590px">
             <tr>
              <td> 
                    <div class="blockMsg"></div>
    <a name="autotooth">&nbsp;</a><a name="selfcalc">&nbsp;</a>
             </td>
             </tr>
             <tr>
                <td>
                <form method="post" action="<?php echo base_url(); ?>blade/index/#selector">
           
                <input type="image" src="<?php echo base_url(); ?>images/reset.png" alt="RESET" />
                </form>
                </td>
             </tr>
            </table>
          
</div>
<div style="margin-right: auto; margin-left:auto; width: 690px;">
  <table border="0" id="selector_container">  
  <tr>
  <!-- Left Side -->    
    <td width="300" style="vertical-align:top;">
      <!--  height:460px; -->
      <div style="width:300px; height:auto;">
  <table border="0" style="width:100%; height:auto; margin-right:auto; margin-left:auto;">
    <!-- diameter -->
    <tr>

      <td id="diameter1">
  <div id="diameter" style="width:300px; height:39px;">
 
    <strong>Diameter</strong><br />
  <select id="diameter_id" name="diameter_id" class="selector">
    <option class="bold" value="" selected="selected">Select...</option>
    <?php foreach($diameters as $row) { ?>
    <option class="bold" value="<?php echo $row['diameter']; ?>"><?php echo $row['diameter']; ?></option>
    <?php } ?>
  </select>
  </div>
      </td>
    </tr>

    <!-- thickness -->
    <tr>
      <td id="thickness1">
  <div id="thickness" style="width:300px; height:39px;">
    <strong>Thickness</strong><br />
  <select id="thickness_id" name="thickness_id" class="selector">
  </select>
  </div>        
      </td>
    </tr>
    <!-- bore -->
    <tr>
      <td id="bore1">
    
  <div id="bore" style="width:300px; height:39px;">
    <strong>Bore</strong><br />
  <select id="bore_id" name="bore_id" class="selector">
  </select>
  </div>
        
      </td>
    </tr>

    <!-- machine question -->
    <tr>
      <td id="machine">
        <div style="width:300px; height:39px; font-weight:bold;"> <span style="font-weight:bold; color:#ffffff;" id="machine_question"></span>
<br />
                  <select id="machine_id" class="selector">
                  </select>
        </div>
      </td>
    </tr>

    
    <!-- hub -->
    <tr>
      <td id="hub1">
    <div id="hub" style="width:300px; height:39px;">
    <strong>Hub Diameter</strong><br />
    <div style="font-size:13px; font-weight:bold; color:#ffffff;" id="hub_id"></div>
    </div>

      </td>
    </tr>
    <!-- pinholes -->
    <tr>
      <td id="pinholes1">
      <div id="pinholes" style="width:300px; height:39px;">
        <strong>Pinholes</strong><br />
        <div style="font-size:13px; font-weight:bold; color:#ffffff;" id="pinholes_id"></div>
      </div>
      </td>
    </tr>
    <!-- material selection -->
    <tr>
      <td id="material1">
  <div id="material" style="width:300px; height:39px;">
         <strong>Material you will be cutting:</strong><br />
  <select name="material_id" id="material_id" class="selector">
  </select>
  </div>
   
      </td>
    </tr>

<tr>
  <td id="calc_id" style="vertical-align:top;">
<div id="testorino1" class="acc_trigger">
    <a  href="#autotooth" id="autotooth_calc_trigger">
    <img border="0" src="<?php echo base_url();?>images/autotooth_select293.png" alt="I want to have AutoTooth Automatically Calculate the Correct Number of Teeth" /></a><br />
</div>

<div id="testorino2" class="acc_trigger">
<a href="#selfcalc" id="self_calc_trigger">
<img border="0" src="<?php echo base_url();?>images/select_myself293.png" alt="I want to Select the Number of Teeth Myself" /></a>
</div>

<div style="clear:both;"></div>
 <div id="switch" style="font-style:italic;">
 <p style="color:#99ccff;"><strong>
 <i>You may switch between the two <br />
Blade Calculation methods at any time
 </i></strong>
</p>
</div>
    <div class="acc_container" id="acc_container_autotooth">
<div id="auto_tooth_material_shape">
      <strong>Material Shape</strong><br />
      <select id="material_shape_id" style="width:280px; overflow:hidden;">
	</select>
	
</div>      
  <div id="round" class="selector_div">
    <br /><strong>Round Tubing Wall Thickness:</strong><br />
  <select id="round_wall_id" name="round_wall_id" class="selector">
  </select>
  <br />
      <div id="round_diameter" class="selector_div">
      <br /><strong>Round Tubing Diameter</strong><br />
              <select id="round_diameter_id" name="round_diameter_id" class="selector">
              <option value="" selected="selected">Select...</option>
              </select>
      </div>
  </div>

  <div id="square" class="selector_div">
    <br /><strong>Square Tubing Wall Thickness</strong><br />
  <select id="square_wall_id" name="square_wall_id" class="selector">
  </select>
      <div id="square_across" class="selector_div">    
      <br /><strong>Square Tubing Width Across</strong><br />
        <select id="square_across_id" class="selector">
        <option value="" selected="selected">Select...</option>
        </select>
      </div>  
  </div>
  
  <div id="square_diagonal" class="selector_div">
    <br /><strong>Wall Thickness:</strong><br />
  <select id="square_diagonal_id" name="square_diagonal_id" class="selector">
  </select>
  </div>
      
  <div id="solids" class="selector_div">
    <br /><strong>Width Across</strong><br />
  <select id="solids_id" name="solids_id" class="selector">
  </select>
  </div>

  <div id="structurals" class="selector_div">
   <strong>Average Wall Thickness</strong><br />
  <select id="structurals_id" name="structurals_id" class="selector">
    <option value="" selected="selected">Select...</option>
  </select>
  </div>
</div><!-- acc_container auto_tooth -->
<div style="clear:both;"></div>
  
  <div class="acc_container" id="self_calc">
     <p> <strong>Number of Teeth for your Blade Selection:</strong></p>

      <select id="self_calc_teeth" class="selector">
      </select>
  </div><!-- acc_container self_calc -->
  <div style="clear:both;"></div>
  
  <p>&nbsp;</p>
  
</td></tr>
<tr><td>

</td></tr>
  </table>
  </div> 
    </td>
    <!-- end Left side -->


          <!-- Right Side -->
    <td width="350" style="vertical-align:top;">
  <div style="width:350px; float:right; height:auto;">
      <table border="0" style="width:100%; margin-right:auto; margin-left:auto; overflow:hidden;">
        <tr>
          <td style="height:auto;">
<div id="diameter_message" style="text-align:justify; padding:3px;">

<h3>Tips for Selecting Diameter </h3>
  <p>
  Here you choose the correct diameter specified for your machine.
  The only exception would be if you need to reduce your blade speed
  (also referred to as surface feet per minute, or SFM) on a fixed RPM machine.
  </p>
  <p>
  If you have a fixed speed machine and need to slow the SFM down,
  AND you will be cutting small enough stock,
  you can put a smaller blade on the saw than what is called for.
  </p>
  <p>
  Example:  If you have a machine that takes a 350mm blade and runs at 27 RPM,
  your blade will be cutting at 97 surface feet per minute.
  If you can cut your through your material with a 275mm blade,
  your SFM will be reduced to 77 SFM.
  </p>
  <p>
  This may increase your tool life significantly in some applications
  (tough/hard materials like Alloyed Steels or some Stainless Steels).
  </p>

</div>

<div id="thickness_message" style="text-align:justify; padding:3px;">

  <div style="width:300px; margin-left:5px;">
    <h3>Tips for Selecting Thickness</h3>
  
    <ul>
      <li>Choose other thicknesses to view other choices, pricing and availability
      <br /></li>
      <li>The most popular <span style="color:yellow; font-weight:bold;">thicknesses are highlighted</span> in the selections. <br />
      </li>
      <li>A different thickness may cost less due to popularity or ease of manufacturing.
      <br /></li>
      <li>Certain blades are only available in some thicknesses.<br />
      </li>
      <li>A thinner blade will cut smoother and take less power, but may not cut as square. Typically used in thin-wall tubing and other light cuts
      <br /></li>
      <li>A thicker blade will cut more square due to rigidity, but may vibrate more, and will take more power. Typically used in thick-wall pipe, solids, mitering, and heavier cuts.
      <br />
      </li>
    </ul>

  </div>
   
</div>

<div id="bore_message" style="background-color:#5b5b5b;">

			<ul class="bore_images">
			    <li>
			    <a id="img1" href="#selector">
			    
			    </a> <br />
			    </li>
			    <!--  li style="color:#00ff00;">Hover for<br /> larger image</li -->
			</ul>
			
</div>
<div id="preview"></div>
<div id="material_message" style="text-align:justify; padding:3px; overflow:hidden; margin-bottom:30px;">
<hr />
  <blockquote>
  <h3>Tips for Selecting Material Type</h3>

<p>
Telling us what material you will be cutting allows us to custom grind your blade with the proper angles to maximize performance. We understand that you may not cut only one material all the time, so here are some tips to help you make the best choice.
<br /><br />
<strong>Harder</strong> materials like Mild Steel and Stainless Steel need stronger, 
more blunt angles. Blades ground for these materials will also cut softer materials, 
but slower than would the proper grind.
<br /><br />
<strong>Softer</strong> materials like Aluminum, Brass &amp; Copper 
(although there are some very hard Coppers) need more aggressive angles. 
Blades ground for these materials will cut harder/tougher materials, but the blade 
will certainly dull faster, and you risk breaking or stripping teeth.
<br /><br />
If you cut mostly one type of material, choose that one.
<br /><br />
If you cut a lot of materials that fall into both categories above, having blades ground 
for each would be the best choice. But if you do decide to cut a lot of material from both 
categories above (like Stainless Steel and Aluminum) with the same blade 
(NOT recommended) include a note in the comments box during check out as to what you 
will be cutting, and we will grind your blades with 'middle-of-the-road' angles.
</p>
</blockquote>
</div>
<div id="calc_message" style="text-align:justify; padding:3px;">


	  <div style="width:300px; margin-left:5px; overflow:hidden;">
<h3>Tips for Selecting Number of Teeth:</h3>

	<ul>
		<li><i><strong>Our exclusive <span style="color:#FFCC00; font-weight:bold;">AutoTooth</span> is an industry first!</strong></i>
		<br /><br />
		</li>
	<li><span style="color:#FFCC00;">AutoTooth</span> takes the guess-work out and automatically calculates the correct pitch, tooth count, and grind for you based on your selections of material shape being cut.
	<br />
	</li>
	<li>Even if you decide to select the number of teeth yourself, you might want to use the <span style="color:#FFCC00;">AutoTooth</span> feature to compare what you are thinking of using with what is recommended. You may switch back and forth at any time between the two methods with a simple click.
	<br />
	</li>
	<li>If you regularly cut larger quantities of the same material shape and thickness, consider buying blades dedicated for that use.
	<br />
	</li>
	<li>If you decide to cut a variety of different material thicknesses with one blade, first use <span style="color:#FFCC00;">AutoTooth</span> to determine the proper tooth count for each application. Then click 'I want to select the number of teeth myself' and select a number of teeth that is an average for your different applications.
	<br />
	</li>
	<li>Typically, it is ideal to have about 2-4 teeth engaged in the work at all times (consider both walls when cutting tubing).
	<br />
	</li>
	<li>Too few teeth may cut faster, but you risk stripping teeth or breaking the blade.
	<br />
	</li>
	<li>Too many teeth may cut smooth, but your cut time will increase and the blade will dull prematurely.
	<br />
	</li>
	</ul>
	</div>
</div>

<!--  text-align:justify -->
<div id = "tooth_count_message" style="text-align:left; padding:3px; overflow:hidden; width:300px;">

  <p>
<strong>Even if you decide to choose the number of teeth yourself</strong>, you might want to use the <span style="color:#FFCC00;">AutoTooth</span> feature to compare what you are thinking of using with what is recommended. You may switch back and forth at any time between the two methods with a simple click.
</p>
<p>
If you regularly cut larger quantities of the same material shape and thickness, consider buying blades dedicated for that use.
</p>
<p>
If you decide to cut a variety of different material thicknesses with one blade, first use <span style="color:#FFCC00;">AutoTooth</span> to determine the proper tooth count for each application. Then click 'I want to choose the number of teeth myself' and choose a number of teeth that is an average for your different applications.
</p>
<p>
<strong>Tips on Tooth Count:</strong>
Typically, it is ideal to have about 2-3 teeth engaged in the work at all times (consider both walls of tubing).
</p>
<p>
Too few teeth may cut faster, but you risk stripping teeth or breaking the blade.
</p>
<p>
Too many teeth may cut smooth, but your cut time will increase and the blade will dull prematurely.
</p>

</div>

</td></tr>
<tr>
	<td>
	<div id="material_shapes_id">

	<div id="round_wall_thickness" style="background-color:#5b5b5b">
	<img src="<?php echo base_url(); ?>images/RoundWallThickness.jpg" alt="Round Wall Thickness" />
	</div>
	<div id="round_tubing_diameter" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/RoundTubingDiameter.jpg" alt="Round Tubing Diameter" />
	</div>

	<div id="square_flat_wall_thickness" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/SquareFlatWallThickness.jpg" alt="Square Flat Wall Thickness" />
	
	</div>
	
	<div id="square_flat_width_across" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/SquareFlatWidthAcross.jpg" alt="Square Flat Width Across" />
	
	</div>
	
	<div id="square_diagonal_wall_thickness" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/SquareDiagonalWallThickness.jpg" alt="Square Diagonal Wall Thickness" />
	
	</div>
	
	<div id="structurals_average_thickness" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/StructuralsAverageWallThickness.jpg" alt="Structurals Average Wall Thickness" />
	
	</div>
	
	<div id="solids_width_across" style="background-color:#5b5b5b;">
	<img src="<?php echo base_url(); ?>images/SolidsWidthAcross.jpg" alt="Solids Width Across" />
	
	</div>
</div>
</td></tr>
<tr>
  <td id="pricing_id">
<div style="color:#00ff00; font-weight:bold; font-size:13px;">
      <span style="font-size:18px;">Teeth and Grind Selection Is:</span> <span id="blade_select"></span> <br />
      <a href="javascript:Biopopup('<?php echo base_url(); ?>blade/grind')">
      <strong>What does the Bw or C mean?</strong>
      </a>
	<br /><br />
 </div>
<div>
<!-- begin add to cart forms -->

    <form id="asian_form" method="post" action="<?php echo $test_form_submit; ?>">
      <fieldset>
        <legend>Economy Black Oxide</legend>
    <?php echo form_csrf(); ?>
	<input type="hidden" name="attribute2" />
    <input type="hidden" name="attribute1" />
    <input type="hidden" name="attribute3" />
    <input type="hidden" name="attribute4" />

  <table>
  <tr>    
    <td>
    <div id="asian_id"></div>
    </td>
  </tr>
  </table>
  </fieldset>
  </form>

    <form id="kinkelder_form" method="post" action="<?php echo $test_form_submit; ?>">
      <fieldset>
        <legend>Kinkelder Black Oxide</legend>
    <?php echo form_csrf(); ?>
    <input type="hidden" name="attribute1" />
    <input type="hidden" name="attribute2" />
    <input type="hidden" name="attribute3" />
    <input type="hidden" name="attribute4" />

  <table>
  <tr>
    <td>
    <div id="kinkelder_id"></div>
    </td>
  </tr>
  </table>
  </fieldset>
  </form>

    <form id="kinkelder_bright_form" method="post" action="<?php echo $test_form_submit; ?>">
      <fieldset>
        <legend>Kinkelder Bright</legend>
    <?php echo form_csrf(); ?>
    <input type="hidden" name="attribute1" />
    <input type="hidden" name="attribute2" />
     <input type="hidden" name="attribute3" />
    <input type="hidden" name="attribute4" />
     
    

  <table>
  <tr>
    <td>
    <div id="kinkelder_bright_id"></div>
    </td>
  </tr>

  </table>
  </fieldset>
  </form>

    <form id="kinkelder_ec3000_form" method="post" action="<?php echo $test_form_submit; ?>">
      <fieldset>
        <legend>Kinkelder EC 3000</legend>
    <?php echo form_csrf(); ?>

    <input type="hidden" name="attribute1" />
    <input type="hidden" name="attribute2" />
    <input type="hidden" name="attribute3" />
    <input type="hidden" name="attribute4" />
    

  <table>
  <tr>
    <td>
    <div id="kinkelder_ec3000_id"></div>
    
    </td>
  </tr>
  </table>
  </fieldset>
  </form>  
  <p style="color:#99CCFF;"><strong><i>Quantity Discounts will be available on the next page</i></strong></p>
</div>
</td>
   </tr>
      </table>
    <!-- end right side -->
  </div>
    </td>

    </tr>
  </table>
    <div style="clear:both;"></div> 
        
</div>

</div>
<div style="clear:both;">&nbsp;</div>
<!--  end new blade selector -->

</div>

    </td>
    <td id="designInsert3"></td>

     
    <td id="designInsert4"></td>

   </tr>
  </table>

 <div id="designBannerThree" class="designBanner">
 <map name="logos" id="logos">
    <area shape="rect" coords="28,13,135,77" href="http://www.kinkelder.nl/en" target="kin" alt="Kinkelder" />
    <area shape="rect" coords="166,16,299,83" href="http://www.lenoxtools.com/Pages/Category.aspx?category=Fluids" target="len" alt="Lenox" />
    <area shape="rect" coords="321,18,470,80" href="http://www.skarpaz.com/home.html" target="skar" alt="Skarpaz" />
    <area shape="rect" coords="502,19,637,82" href="http://www.itwfpg.com/acculube/lubricants/general/LB2000.html" target="accu" alt="Accu-Lube" />
    <area shape="rect" coords="669,23,822,78" href="http://relton.com/cutting_fluids.html#rel-saw" target="rel" alt="Relton" />
    <area shape="rect" coords="828,5,918,90" href="http://iska.org/" target="iska" alt="ISKA" />
  </map>
  <img src="<?php echo base_url(); ?>images/logos.jpg" alt="Logos" width="943" height="85" border="0" usemap="#logos" /></div>


 <div id="storeFooter">

  <div id="navSuppWrapper"><div id="navSupp"><ul><li><a href="<?php echo $domain_url; ?>cart/index.php?main_page=index">Home</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=2&amp;chapter=0">About Us</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo base_url(); ?>blade/index">New HSS Blades</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=9&amp;chapter=0">CNC Sharpening</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=index&amp;cPath=9">Coolants &amp; Lubricants</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=12&amp;chapter=0">Policies</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo base_url(); ?>calculate/index">Calculators</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=18&amp;chapter=0">Frequently Asked Questions</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=19&amp;chapter=0">Shipping Tips</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=contact_us">Contact Us</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=page&amp;id=13&amp;chapter=0">Wholesale Accounts</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=login">Log In</a>
&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?php echo $domain_url; ?>cart/index.php?main_page=shopping_cart">View Cart</a></li></ul></div></div>

  <div id="designBannerFour" class="designBanner"><div align="center"><font color="#333333">&copy; 2009-<?php echo date('Y'); ?>  California Cold Saw, Bay Area Carbide Inc. All Rights Reserved.</font></div></div>
 </div>

 </div>

</body>
</html>