
	
	$(document).ready(function(){

	
        var id = $("#PropertyId").val();
        var count_img=0;
        var property_id = $("#PropertyId").val();
        
        if (counters["prop_image"])
            count_img = counters["prop_image"]-1;
        
        var add_img=count_img;
        
        var no_of_photos = $("#slider li").size();
        
        var jqXHF = false;
        $('.txt_field').bind('keyup' , function() {
            if (jqXHF) {
                jqXHF.abort( );
            }

            img_id = aslider.$currentPage.attr("data-id");

            if (no_of_photos == 1) {
                img_id = $("#slider li").attr('data-id');
            }

            var img_description = this.value;

            jqXHF = $.ajax({
                url  : photo_desc_url,
                type : 'post',
                data : {'id' : img_id , 'name' : img_description},
                success : function( ) {
                    $(".saved").show( ).fadeOut(2000);
                }
            });
        });
        
        $('#deleteImg').click(function(e) {
            img_id = aslider.$currentPage.attr("data-id");
            /*
             * if only one image is there than no sliding action is appeared
             * so for getting image_id with no sliding action gives unfavourable results
             */

            if(no_of_photos == 1) {
                img_id = $("#slider li").attr('data-id');
            }
            e.preventDefault();
            if(confirm("Are you sure you want to delete this image?") == true) {
            $('#image_'+img_id).remove();
            var url = $(this).attr('href') + '/' + property_id +'/' + img_id + '/tab2';
            window.location = url;
            }
        });
        
        $(".sortable").sortable({                  
            update : function(e, ui){
               var elements = $(this).children();
               var size = $(this).children().size();
               var ids = [];
               for(i=0;i<size;i++){
                    ids[i] = elements[i].id; 
               }
               $.post(ROOT_URL+'PropertyImages/sort', {'ids':ids},
                     function(data){
                          //alert('Images Sorted');
                     }
                );
             }
          });
        
        /* from two.js */

        $('table.uploaded-images tbody').sortable({
//        	containment: 'parent',
        	tolerance: 'pointer',
        	revert: true,
        	placeholder: 'ui-state-highlight',
        	stop: function(evt, ui) {
        		// go through each element here and change the
        		// sort order field to the current sort position
        		$(this).find('tr').each( function(i, elem) {
        			$(elem).find('div.sort input').val(i + 1);
        		});
        	}
        }).find('tr').css('cursor', 'move');
});