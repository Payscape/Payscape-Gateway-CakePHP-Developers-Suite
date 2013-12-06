<?php $this->Html->script('jquery.anythingslider', array('inline' => false)); ?>
<?php $this->Html->css('anythingslider', null, array('inline' => false)); ?>

<div class="padder20">

<?php if ( ! empty($Property['PropertyImage'][0]['image']['manage']) ) { ?>

	<div class="edit-box relative">

		<ul id ="slider">

		<?php
			$prime_img_cnt = 0;
			foreach ($Property['PropertyImage'] as $key => $val) {
				$prime_img_cnt++;
				?>

			<li data-id="<?= $val['id'] ?>">
				<?php echo $this->Html->image(my_ife($val['image']['main'], 'manage_missing.png'), array('title' => '#htmlcaption_'.$prime_img_cnt, 'width' => '641', 'height' => '428')); ?>

				<div style="background:none;" class="caption-bottom">
					<?php echo $this->Form->input('Description', array('type' =>'text' , 'class' => 'txt_field' ,'label' => false ,'div' => false , 'placeholder' => 'Describe this photo here', 'value' => $val['name']));?>
					<div class="saved" style="display:none;">Saved</div>
				</div>
			</li>
		<?php
			}
		?>

		</ul>

	</div>

	<div class="photo-edit-tab">
		<?php echo $this->Html->image('edit-divider-up.png');  ?>
		<span class="right">

			<?php echo $this->Html->link('Delete' ,array('controller' => 'properties' , 'action' => 'delete_photo') , array('class' => 'grey-btn' , 'id' => 'deleteImg'));?>
			<span id="prev"></span>
			<span id="next"></span>

		</span>
		<?php echo $this->Html->image('edit-divider-down.png');  ?>
	</div>

<?php } else { ?>

	 <p>Please upload your property photos.</p>

<?php } ?>

<?php if ( ! empty($Property['PropertyImage'])) { ?>
		<div class="photo-gallery">
				<div class="photo-flag">Main img</div>
		<ul class="sortable">

		<?php foreach ($Property['PropertyImage'] as $key=>$val) { ?>
			<?php if (isset($val['image']['thumb'])) { ?>
				<?php if($key == 0) { ?>

			<li id="<?php echo $val['id']?>" class="relative"><?php echo $this->Html->image($val['image']['thumb']);  ?></li>

				<?php } elseif (0 == (($key + 1) % 4)) { ?>

			<li id="<?php echo $val['id']?>"><?php echo $this->Html->image($val['image']['thumb']);  ?></li>

				<?php } else { ?>

			<li id="<?php echo $val['id']?>"><?php echo $this->Html->image($val['image']['thumb']);  ?></li>

				<?php } ?>
			<?php } ?>
		<?php } ?>
		</ul>
	</div>

	<?php } ?>
</div>

<?php echo $this->Html->scriptblock('
	var aslider = null;
	var img_id = "";
	var photo_desc_url = '. $this->Js->value(Router::url(array("controller" => "properties" , "action" => "add_photo_description"))).";".'
	$(document).ready( function( ) {
		$("#slider").anythingSlider({
			buildNavigation : false,
			appendForwardTo : $("#next"),
			appendBackTo    : $("#prev"),
			buildStartStop  : false
		});
		aslider = $("#slider").data("AnythingSlider");
	});
'); ?>

