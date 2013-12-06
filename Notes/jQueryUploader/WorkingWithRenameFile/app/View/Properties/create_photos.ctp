
<?php
$active_tab = '';
if (isset($this->request->pass[2])) {
	$active_tab = $this->request->pass[2];
}

$count = 0;
if ( ! empty($Property['PropertyImage'])) {
	$count = count($Property['PropertyImage']);
}
?>
<?php if ( ! empty($id)) { echo $this->element('property_info_panel'); } ?>
<?php $this->Html->scriptblock('var counters = {"sort" : 0};', array('inline' => false));?>
<?php
	//$this->Html->css(array('plupload', 'plupload_queue'), null, array('inline' => false));
 
	$this->Html->css(array(
			'properties/bootstrap.min', 
			'properties/style',
			'properties/jquery.fileupload-ui',
			), null, array('inline' => false));
?>	




	<noscript><link rel="stylesheet" href="css/properties/jquery.fileupload-ui-noscript.css"></noscript>	
<?php 

/* scripts for Edit Photos sort */

//		echo $this->Html->script('jquery.plupload.queue', array('inline' => false));
//		echo $this->Html->script('plupload', array('inline' => false));
		
//		echo $this->Html->script('propertyimages', array('inline' => false));
//		echo $this->Html->script('create_two', array('inline' => false));


/* scripts for jQueryUpload */


 echo $this->Html->script('properties/vendor/jquery.ui.widget', array('inline' => false));

echo $this->Html->script('properties/javascript-templates/tmpl.min', array('inline' => false));
echo $this->Html->script('properties/load-image/load-image.min', array('inline' => false));
echo $this->Html->script('properties/canvas-to-blob/canvas-to-blob.min', array('inline' => false));
echo $this->Html->script('properties/bootstrap-gallery/bootstrap-image-gallery.min', array('inline' => false));
echo $this->Html->script('properties/jquery.iframe-transport', array('inline' => false));
echo $this->Html->script('properties/jquery.fileupload', array('inline' => false));
echo $this->Html->script('properties/jquery.fileupload-fp', array('inline' => false));
echo $this->Html->script('properties/jquery.fileupload-ui', array('inline' => false));
echo $this->Html->script('properties/main');

//echo $this->Html->script('properties/properties');
///echo $this->Html->script('properties/properties_sort');
echo $this->Html->script('properties/sort_photos');

?>

<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]>
<?php 
//echo $this->Html->script('/properties/cors/jquery.xdr-transport');
?>
<![endif]-->
?>

<div class="myphoto-cnt">

	<div class="myphoto-sidebar">
		<?php echo $this->element('listing_left_panel'); ?>
	</div>

	<div class="myphoto-content">
		<div class="inner-tab-cnt" id="ddpagetabs">
			<a href="javascript:void(0);" onclick="expandcontent('sc1', this, 'ddpagetabs')"><?php echo __('Upload'); ?></a>
			<a href="javascript:void(0);" onclick="expandcontent('sc2', this, 'ddpagetabs')" class="<?php echo ! empty($active_tab) ? 'current' : '' ;?>">
				<?php if ($count) { ?>
					<span class="counter"><?php echo $count?></span>
				<?php } ?>
				<?php echo __('Edit'); ?>
			</a>
		</div>
		<div class="inner-tab-data">
			<div id="sc1" class="tab-content">
				<div class="padder">

	<div class="container" style="background-color:#ff0000; width:600px;">
					<?php //echo $this->Form->create('PropertyImage', array('url' => array('controller' => 'properties', 'action' => 'create', 'photos', $Property['Property']['id']), 'type' => 'file')); ?>
<!-- bof: new form -->
					<div>
			<h2><?php echo $this->Html->link('Upload Files!',  array('controller' => 'file_upload' ,'action' => 'index' , $property_id),array('target'=>'aarf')); ?></h2>
			<br>
			<?php 
			
			/// echo $this->Html->link('Enter', '/pages/home/', array('class' => 'button', 'target' => '_blank'));
			
			echo $this->Html->link('Upload Files', '/file_upload/image_upload/index/' . $property_id, array('class' => 'button', 'target' => '_files'));
				
			?>
					</div>
		<div>
		<?php 
		//	'script_url' => SITE_URL.'service_pictures/upload/',
		$script_url = "properties/upload";
		
		//'img'.DS.'files'.DS.$property_id.'images'.DS
		$upload_dir = "img/files/$property_id/images/";
		
		//	'upload_url' => SITE_URL.'img/offer_picture/',
		$upload_url =  'img/files/' . $property_id . '/images/';
		
		echo "<br>SCRIPT URL $script_url";
		echo "<br>UPLOAD DIR $upload_dir";
		echo "<br>UPLOAD URL $upload_url";
		
		?>
		
		</div>			
					
					<?php 			//echo $this->Form->create('PropertyImage', array('url' => array('controller' => 'properties', 'action' => 'create', 'photos', $Property['Property']['id']), 'type' => 'file', 'id' => 'fileupload')); ?>
		<?php 	echo $this->Form->create('PropertyImage', array('url' => array(
				'controller' => 'properties', 
				'action' => 'upload', $Property['Property']['id']), 
				'type' => 'file', 'id' => 'fileupload')); 
		?>
			
		<div class="row fileupload-buttonbar">
	            <div class="span7">
	                <span class="btn btn-success fileinput-button">
	                    <i class="icon-plus icon-white"></i>
	                    <span>Add files...</span>
	                    <input type="file" name="files[]" multiple>
	                </span>
	                <button type="submit" class="btn btn-primary start">
	                    <i class="icon-upload icon-white"></i>
	                    <span>Start upload</span>
	                </button>
	                <button type="reset" class="btn btn-warning cancel">
	                    <i class="icon-ban-circle icon-white"></i>
	                    <span>Cancel upload</span>
	                </button>
	                <button type="button" class="btn btn-danger delete">
	                    <i class="icon-trash icon-white"></i>
	                    <span>Delete</span>
	                </button>
	                <input type="checkbox" class="toggle">
	            </div>
	            <div class="span5">
	                <div class="progress progress-success progress-striped active fade">
	                    <div class="bar" style="width:0%;"></div>
	                </div>
	            </div>
	        </div>
	        <div class="fileupload-loading"></div>
	        <br>
	        <strong>stick it just below here!</strong>
	<div style="width:600px; background-color:#000000;"> 
	    
	        <table class="table table-striped" style="border:solid #00ff00 1px;"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">

	        
	        </tbody></table>
	</div>
	</div>
	<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
	    <div class="modal-header">
	        <a class="close" data-dismiss="modal">&times;</a>
	        <h3 class="modal-title"></h3>
	    </div>
	    <div class="modal-body"><div class="modal-image"></div></div>
	    <div class="modal-footer">
	        <a class="btn modal-download" target="_blank">
	            <i class="icon-download"></i>
	            <span>Download</span>
	        </a>
	        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
	            <i class="icon-play icon-white"></i>
	            <span>Slideshow</span>
	        </a>
	        <a class="btn btn-info modal-prev">
	            <i class="icon-arrow-left icon-white"></i>
	            <span>Previous</span>
	        </a>
	        <a class="btn btn-primary modal-next">
	            <span>Next</span>
	            <i class="icon-arrow-right icon-white"></i>
	        </a>
	    </div>
	</div>
	
<!--  eof: new form elements -->					
					<div class="drag-here">
						Your browser doesn't support native upload. Try the latest version of Firefox or Safari.
					</div>

					<?php
					/*
					 * pluploader
					 * 
					 
						if ( ! empty($Property['PropertyImage'])) {
							foreach ($Property['PropertyImage'] as $key => $val) {
								if ( ! empty($val['id'])) {
									echo $this->Form->input("PropertyImage.{$key}.id", array('type' => 'hidden', 'id' => 'image_'.$val['id'], 'value' => $val['id']));
								}
							}

							if ($val['image']['manage'] != '') {
								echo $this->Form->input('image_count', array('type' => 'hidden', 'value' => count($Property['PropertyImage'])));
							}
						}
					*
					*
					*/	
						
					?>

					<?php echo $this->Form->input('Property.id', array('type' => 'hidden', 'value' => $Property['Property']['id'])); ?><br />

					<h2 align="center">or Upload a photo</h2>
					<div class="seperator"></div>
	<!-- 				
					<div class="row" align="center">
 
						<?php //echo $this->Form->input('PropertyImage.upload.image', array('type' => 'file', 'id' => 'upload', 'div' => false, 'label' => false)); ?>
						<?php //echo $this->Form->submit('Upload Image', array('class' => 'btn blue-btn btn-info btn-large save_images', 'div' => false, 'id' => 'submit', 'name' => 'save_images')); ?>
					</div><br />
 -->
					<?php echo $this->Form->end( ); ?>
					
					<!-- bof: -->
<!-- modal-gallery is the modal dialog used for the image gallery -->
					<?php 
					/*
					 * 
					 
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
*
*
**/
					?>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td>{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td>{% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td>
            <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>
					
					
					<!-- eof: custom -->

				</div> <!-- padder -->
			</div>

			<div id="sc2" class="tab-content">
				<?php echo $this->element('edit_listing_photos'); ?>
			</div>
		</div>
	</div>
</div>

<?php

//$cnt_prop_img = count(my_ife($Property['PropertyImage'], array( )));
$cnt_prop_img = $count;
$this->Html->scriptblock('counters["prop_image"] = '.($cnt_prop_img + 1).';', array('inline' => false));
$this->Html->scriptblock('var site_url = "'.Router::url(array('controller' => 'properties', 'action' => 'create', 'photos' ,$id)).'?file=1";', array('inline' => false));
echo $this->Html->script('tabs');

if ('tab2' == $active_tab) {
	echo $this->Html->scriptblock('do_onload_new("ddpagetabs","sc2","1");');
}
else {
	echo $this->Html->scriptblock('do_onload_new("ddpagetabs","sc1","0");');
}

?>

