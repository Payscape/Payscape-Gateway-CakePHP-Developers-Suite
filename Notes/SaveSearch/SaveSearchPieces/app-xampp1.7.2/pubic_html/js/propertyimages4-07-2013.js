
/*
 *  uploading files using plupload plugin
 **/
$(document).ready(function(){

	var id = $("#PropertyId").val();
	var count_img=0;
	var property_id = $("#PropertyId").val();

	if (counters["prop_image"])
		count_img = counters["prop_image"]-1;

	var add_img=count_img;

	$('input[type = submit]').click(function() {
		var filename = $('#upload').val();
		if(filename != '' ) {
			var ext = filename.split('.').pop();
			 if (!(ext == 'jpg' || ext == 'png' || ext == 'jpeg' || ext == 'gif')) {
				alert('Error: Image should be jpg,png,jpeg,gif');return false;
		}
		}

	});



	/*
	 * File uploads using drag and drop feature starts here .
	 */
	$(".drag-here").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : site_url,
		max_file_size : '20mb',
		chunk_size : '1mb',
		unique_names : true,
		filters : [
		{
			title : "Image files",
			extensions : "jpg,gif,png,jpeg"
		},
		]

	});

	$("li.plupload_droptext").html("Drag and Drop Photos Here");

	var uploader = $(".drag-here").pluploadQueue();
	/*
	 * Set limit for maximum file uploads , this must be within number 8
	 */

	uploader.bind('FilesAdded', function(up, files) {
		if(!(up.state != 2 && files.length > 0 && add_img+files.length <= 8)){
			alert('Error : Maximum 8 files are allowed. if you want to add more photos please delete existing photos.');
			up.splice(8-add_img,files.length);
		}
		up.start();
	});
        
	uploader.bind('UploadProgress', function(up, file) {
                $('li.plupload_uploading a').on({
                    click: function(e){
                        up.removeFile(file);
                        up.stop();
                        up.start();                       
                    }
                });
	});        

	uploader.bind('UploadComplete',function(files){
			$('input[type=submit]').trigger("click");
		});

	/*
	 * adding hidden fields based on response coming from controller
	 * which is in json encoded format .
	 */

	uploader.bind('FileUploaded',function(u,file,res){
		var form = $('.drag-here');
		res = $.parseJSON(res.response);

		if(typeof(res.errors) != 'undefined') {
			$('<input />').attr({'type' : 'hidden', 'name' : 'data[error]'}).val(res.errors.image).appendTo(form);
		} else {

			$('<input  />').attr({
				'type':'hidden',
				'name':'data[PropertyImage]['+count_img+']'+'[image][name]'
			}).val(res.name).appendTo(form);
			$('<input  />').attr({
				'type':'hidden',
				'name':'data[PropertyImage]['+count_img+']'+'[image][type]'
			}).val(res.type).appendTo(form);
			$('<input  />').attr({
				'type':'hidden',
				'name':'data[PropertyImage]['+count_img+']'+'[image][tmp_name]'
			}).val(res.tmp_name).appendTo(form);
			$('<input  />').attr({
				'type':'hidden',
				'name':'data[PropertyImage]['+count_img+']'+'[image][error]'
			}).val(res.error).appendTo(form);
			$('<input  />').attr({
				'type':'hidden',
				'name':'data[PropertyImage]['+count_img+']'+'[image][size]'
			}).val(res.size).appendTo(form);
			count_img++;
		}
	});

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
});