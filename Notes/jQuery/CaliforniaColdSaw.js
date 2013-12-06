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
 
        $.post("https://californiacoldsaw.com/inquiry/blade/thickness", {
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
        $.post("https://californiacoldsaw.com/inquiry/blade/bore", {
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
 	    $.post("https://californiacoldsaw.com/inquiry/blade/hub", {
 	       dia: diameter,
 	       thi: thickness,
 	       bor: bore
 	       }, function (data) {
 	       $("#hub_id").html(data);
 	       });
 	       
 	                      
 	       $.post("https://californiacoldsaw.com/inquiry/blade/pinholes", { dia: diameter, thi: thickness, bor: bore }, 
 	   	function (data) {
 	       $("#pinholes_id").html(data);
 	       });
 	       
 	$("#hub").show();    
 	$("#pinholes").show();    
 	       
 	      $.post("https://californiacoldsaw.com/inquiry/blade/bore_image2", 
 	    			{
 	    	 	 	dia: diameter,
 	    	 	 	thi: thickness,
 	    	 	    bor: bore
 	    	 	  }, function (data) {
 	    	 		  
 	    	 		 $("#img1").html(data);		  
 	    	 		  
 	    	 	  });

        $.post("https://californiacoldsaw.com/inquiry/blade/machine_question", {
            dia: diameter,
            thi: thickness,
            bor: bore
        }, function (data) {
            var ask_question = data;
            if (ask_question == 1) {
            	
            	$.post("https://californiacoldsaw.com/inquiry/blade/machine_question_text", {
                    dia: diameter,
                    thi: thickness,
                    bor: bore
                }, function(data){
                	$("#machine_question").text(data);
 
                });
                $("td.#diameter1").removeClass("active").addClass("passive");
                $("td.#bore1").removeClass("active").addClass("passive");
                $("td.#machine").removeClass("passive").addClass("active");
                $.post("https://californiacoldsaw.com/inquiry/blade/machine", {
                    dia: diameter,
                    thi: thickness,
                    bor: bore
                }, function (data) {
                    $("#machine_id").html(data);
                });
                $("#machine").show();
            } else {
                $.post("https://californiacoldsaw.com/inquiry/blade/material", {
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
 
        $.post("https://californiacoldsaw.com/inquiry/blade/machine_hub", {hu: hub}, 
        function (data) {
            $("#hub_id").html(data);
        });
 
               
        $.post("https://californiacoldsaw.com/inquiry/blade/pinholes", {dia: diameter,
            thi: thickness,
            bor: bore
            
        }, function (data) {
            $("#pinholes_id").html(data);
        });
                

               
        $.post("https://californiacoldsaw.com/inquiry/blade/material", {
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
        
        $.post("https://californiacoldsaw.com/inquiry/blade/material_shapes", {
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

        $.post("https://californiacoldsaw.com/inquiry/blade/self_calc_teeth", {
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
 
            $.post("https://californiacoldsaw.com/inquiry/blade/wall_round_pitch", {
                
            }, function (data) {
                $("#round_wall_id").html(data);
                $("input[name=attribute3]").val("Round Tubing");
            });
            
            $("#round").show();
            $("#round_wall_thickness").show();
 
        }
        if ($(this).val() == "square") {
 
            $.post("https://californiacoldsaw.com/inquiry/blade/wall_square_pitch", {
                
            }, function (data) {
                $("#square_wall_id").html(data);
                $("input[name=attribute3]").val("Square Tubing");
                
            });
 
 
        	$("#square").show();            
            $("#square_flat_wall_thickness").show();
 
        }
        if ($(this).val() == "square_diagonal") {
 
            $.post("https://californiacoldsaw.com/inquiry/blade/wall_square_diagonal_pitch", {
                
            }, function (data) {
                $("#square_diagonal_id").html(data);
                $("input[name=attribute3]").val("Square Diagonal");
                
            });
            
            $("#square_diagonal").show();                      
            $("#square_diagonal_wall_thickness").show();
 
        }
        if ($(this).val() == "solids") {
 
            $.post("https://californiacoldsaw.com/inquiry/blade/across_solids_pitch", {
                
            }, function (data) {
                $("#solids_id").html(data);
                $("input[name=attribute3]").val("Solids");
                
            });
 
        	$("#solids").show();           
            $("#solids_width_across").show();
        }
        if ($(this).val() == "structurals") {
 
            $.post("https://californiacoldsaw.com/inquiry/blade/across_structurals_pitch", {
                
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
        
        $.post("https://californiacoldsaw.com/inquiry/blade/round_diameter", {
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
        
        $.post("https://californiacoldsaw.com/inquiry/blade/round_pitch", {
            dia: diameter,
            round_dia: round_diameter,
            round_wal: round_wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
            
            $("input[name=attribute1]").val(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
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
                
        $.post("https://californiacoldsaw.com/inquiry/blade/square_across", {
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
        
        $.post("https://californiacoldsaw.com/inquiry/blade/square_pitch", {
            dia: diameter,
            square_acr: square_across,
            square_wal: square_wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data); 
            $("#recommend").show();
                       
            $("input[name=attribute1]").val(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
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
        
        $.post("https://californiacoldsaw.com/inquiry/blade/square_diagonal_pitch", {
            dia: diameter,
            wal: wall
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);  
            $("#recommend").show();
                      
            $("input[name=attribute1]").val(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
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
                
        $.post("https://californiacoldsaw.com/inquiry/blade/structurals_pitch", {
            dia: diameter,
            acr: across
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
            
            $("input[name=attribute1]").val(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
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

        
        $.post("https://californiacoldsaw.com/inquiry/blade/solids_pitch", {
            dia: diameter,
            acr: across
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#recommend").show();
           
            $("input[name=attribute1]").val(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#asian_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
            
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
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
     $("#pricing_id").hide();
        $("#calc_message").hide();
        $("#bore_message").hide();

        $("#round_tubing_diameter").hide(); 
        $("#round_wall_thickness").hide(); 
        $("#square_flat_width_across").hide(); 
        $("#square_flat_wall_thickness").hide(); 
        $("#square_diagonal_wall_thickness").hide(); 
        $("#structurals_average_thickness").hide(); 
        $("#solids_width_across").hide();         
        $("#calc_message").hide();
        $("#pricing_id").show();
        

        $.post("https://californiacoldsaw.com/inquiry/blade/self_calc_blade", {
            dia: diameter,
            teet: teeth
        }, function (data) {
            $("#blade_select").html(data);
            $(".blade_select").html(data);
            $("#self").show();
            
            $("input[name=attribute1]").val(data);
        });

        $.post("https://californiacoldsaw.com/inquiry/blade/get_asian", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#asian_id").html(data);
        });

        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_id").html(data);
        });
   
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_bright", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_bright_id").html(data);
        });
  
        $.post("https://californiacoldsaw.com/inquiry/blade/get_kinkelder_ec3000", {
            dia: diameter,
            thi: thickness,
            bor: bore,
            hu: hub
        }, function (data) {
            $("#kinkelder_ec3000_id").html(data);
        });

        

        $("#pricing_id").fadeIn("slow");
     
    });
});
</script>