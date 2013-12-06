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
	$this->Html->css(array('plupload', 'plupload_queue'), null, array('inline' => false));
	$this->Html->script(array('jquery.plupload.queue', 'plupload', 'plupload.html5', 'propertyimages', 'outerHTML-2.1.0-min', 'create_two'), array('inline' => false));
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

					<?php echo $this->Form->create('PropertyImage', array('url' => array('controller' => 'properties', 'action' => 'create', 'photos', $Property['Property']['id']), 'type' => 'file')); ?>

					<div class="drag-here">
						Your browser doesn't support native upload. Try the latest version of Firefox or Safari.
					</div>

					<?php
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
					?>

					<?php echo $this->Form->input('Property.id', array('type' => 'hidden', 'value' => $Property['Property']['id'])); ?><br />

					<h2 align="center">or Upload a photo</h2>
					<div class="seperator"></div>
					<div class="row" align="center">
						<?php echo $this->Form->input('PropertyImage.upload.image', array('type' => 'file', 'id' => 'upload', 'div' => false, 'label' => false)); ?>
						<?php echo $this->Form->submit('Upload Image', array('class' => 'btn blue-btn btn-info btn-large save_images', 'div' => false, 'id' => 'submit', 'name' => 'save_images')); ?>
					</div><br />

					<?php echo $this->Form->end( ); ?>

				</div>
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

