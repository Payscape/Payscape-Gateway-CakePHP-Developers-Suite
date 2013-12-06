<?php 
/*
	echo "<pre>";
	if(isset($user)){
		var_dump($user);
		
	}
	echo "</pre>";
	exit();
*/

	$count = count($user['Property']);
?>

<?php $this->extend('/Common/dashboard'); ?>
<?php echo $this->Html->script('iphone-style-checkboxes', array('inline' => false));?>
<?php echo $this->Html->css('iphone', null, array('inline' => false));?>
<?php $this->start('the_stuff'); ?>

		<span class="right"><?php
		echo $this->Html->link('Create New Listing' , array(
					'controller' => 'properties',
					'action' => 'create', 'basic'
				),
				array(  'id' => 'create_new_listing',
					'class' => 'white-btn',
				)
			);
		?>
		</span>
		<h2 class="indent">Manage My listings
		<?php if ($count) { ?>
							<span class="counter"><?php echo $count?></span>
						<?php } ?>
		
		</h2>
		<div class="clear">&nbsp;</div>
		<?php
		if (isset($user['Property']) && count($user['Property'])) {
			foreach($user['Property'] as  $val) {
				?>
			<div class="gray-box">
				<div class="home-photo">
				<?php
					$property_image = 'grid_missing.png';
					//if (isset($val['PropertyImage'][0]['image']['grid']) && file_exists(IMAGES.$val['PropertyImage'][0]['image']['grid'])) {
					//if (isset($val['PropertyImage'][0]['image']); // && file_exists(IMAGES.$val['PropertyImage'][0]['image']['grid'])) 
					if (isset($val['PropertyImage'][0]['image'])){
						$property_image = '/img/files/'. $val['PropertyImage'][0]['property_id'] . '/images/' . $val['PropertyImage'][0]['image'];
					}
					// Notice (8): Undefined index: id [APP\View\Properties\listings.ctp, line 42]


					echo $this->Html->image($property_image, array(
						'width' => 210 ,
						'height' => 158 ,
						'url' => array(
							'controller' => 'properties',
							'action' => 'view',
							$val['id'],
						)
					));
				?>
				</div>
				<div class="profile-desc">
					<h2><?php echo $this->Html->link($val['title'],  array('controller' => 'properties' ,'action' => 'view' , $val['id'])); ?></h2>
					<p>
						<?php
							$resolve = '';
							if(empty($val['property_type_id'])){
								$resolve.= '<li>Type</li>';
							}
							if(empty($val['description'])){
								$resolve.= '<li>Description</li>';
							}
							if(empty($val['address']) || empty($val['zip'])){
								$resolve.= '<li>Address</li>';
							}
							if(empty($val['area_latitude']) || empty($val['area_longitude'])){
								$resolve.= '<li>Location</li>';
							}
							if(empty($val['state_id'])){
								$resolve.= '<li>State</li>';
							}
							if(empty($val['daily_rate']) || ! is_numeric($val['daily_rate']) || (0 >= $val['daily_rate'])){
								$resolve.= '<li>Price</li>';
							}
							if($property_image == 'grid_missing.png'){
								$resolve.= '<li>Photo</li>';
							}

						?>

<?php if($val['toc']==0){ ?>						
<div class="row">
	<h5 id="acceptMessage<?php echo $val['id']; ?>"></h5>
	<br><input type="text" style="width:20px;" id="tocResponse<?php echo $val['id']; ?>" value="0"><br>
	
		<input id="acceptTerms<?php echo $val['id']; ?>" type="radio" name="rememberaccept<?php echo $val['id']; ?>" value="1">
		<span class="footer">I have read and agree to VacationFish 
    <a target="_blank" href="<?php echo $this->webroot;?>pages/terms_policies/terms" target="_terms">
    Terms Of Service</a></span>
    <br><input class="showHideVisability<?php echo $val['id']; ?>" type="radio" name="rememberaccept<?php echo $val['id']; ?>" value="0">
      	<span class="footer">I do not agree.</span>
    </div>
<script>
jQuery(function(){

	// update toc

	$("#acceptTerms<?php echo $val['id']; ?>").live('click', function(u<?php echo $val['id']; ?>) {

	var propertyid<?php $val['id']; ?> = <?php echo $val['id']; ?>;
	var accept<?php echo $val['id']; ?> = $("#acceptTerms<?php echo $val['id']; ?>").val();

	$.post(ROOT_URL+"properties/update_toc/"+<?php echo $val['id']; ?>, {
	"data[Property][property_id]": propertyid<?php $val['id']; ?>,
	"data[Property][toc]": accept<?php echo $val['id']; ?>
        },  function (data) {

        	var obj = $.parseJSON(data);

        	 var toc<?php echo $val['id']; ?> = obj.toc;
        	 var message<?php echo $val['id']; ?> = obj.message;
            
            $("#tocResponse<?php echo $val['id']; ?>").val( toc<?php echo $val['id']; ?> );
            $("#acceptMessage<?php echo $val['id']; ?>").append( message<?php echo $val['id']; ?> );

           // alert("tocResponse<?php echo $val['id']; ?> = " + toc<?php echo $val['id']; ?>);
        });
	});
});
</script>
		<?php } else { ?>
<input type="text" id="tocResponse<?php echo $val['id']; ?>" value="<?php echo $val['toc']; ?>">	
<?php } ?>					
	<div class="row" id="toggleVisibility<?php echo $val['id']; ?>">		
						<div class="input checkbox" style="float:left;">
						<?php
							$checked = false;
							$msg = "Your listing isn't visible yet.";
							if (isset($val['published'])) {
								if ($val['published']) {
									$checked = true;
									$msg = 'Your listing is visible';
								}
							}

							echo $this->Form->input('visible', array(
								'type' => 'checkbox',
								'label' => false ,
								'class' => 'listing_visibility',
								'div' => 'false',
								'disabled' => ! empty($resolve),
								'checked' => $checked,
								'rel' => $val['id']
							));
							
							$idtoc = "toc".$val['id'];
							
							echo $this->Form->input('accept',
								array(
								'class'=>'accept',		
								'type'=>'text',
								'label'=>'false',
								'div'=>'false',
								'id'=>$idtoc,
								'value'=>$val['toc'],		
										));
							
			
						?>
						
						</div>
				</div>		
		
	
						<span style="margin-left:15px;" id="listing_msg_<?php echo $val['id']; ?>"><?php echo $msg; ?></span><br/>
						<div id="resolve_first" class="clear">
						<?php if ( ! empty($resolve)) : ?>
							<span class="complete_msg">Please Complete the following:</span><br/>
							<ul class="resolve_items"><?php echo $resolve;?></ul>
						 <?php endif; ?>
						</div>
					</p>

					<p>
					<?php echo $this->Html->link('Edit Listing' ,array(
								'controller' => 'properties' , 'action' => 'create' ,
									 $val['id']) ,
							array('class' => 'sm-white-btn')
							);?>&nbsp;

					<?php echo $this->Html->link('View Calendar' ,array(
								'controller' => 'properties' , 'action' => 'create' ,
								'calendar' , $val['id']) ,
							array('class' => 'sm-white-btn')
							);?>&nbsp;

					<?php echo $this->Html->link('Send a Tour' ,array(
								'controller' => 'properties' , 'action' => 'send_a_tour' 
									 , $val['id']) ,
							array('class' => 'sm-white-btn thickbox')
							);?>

						<br/><small>
						<?php echo $this->Html->link('Permanently Delete this Listing' ,
									array(
										'controller' => 'properties' ,
										'action' => 'delete_property',
										$val['id']
									),
									array('class' => 'redtext'),
									'Are you sure, You want to delete this property'
							);
						?>
						</small>
					</p>

				</div>
			</div>
				<?php
			}
		}
		else { ?>
			<div class="gray-box">
				You don't have any properties for listing ....
			</div>
		<?php } ?>
<!--  Commenting since we might use it in later versions
		<!--<div class="white-box">
			<h2>Alerts</h2>
			<ul class="alert-list">
				<li>
					<span class="icon">
					<?php
					echo $this->Html->image('alert-icon.png' , array(
									'width' => 24 ,
									'height'=> 21
					));
					?>
					</span>
					<div class="desc">
						<?php
							$alert_msg = "Please confirm your email address by
								clicking on the link we just emailed you. If you
								cannot find the email, you can request a new
								confirmation email or change your email address.
								";
							echo $this->Html->link($alert_msg , '#');
						?>
					</div>
				</li>

				<li>
					<span class="icon">
					<?php
					echo $this->Html->image('alert-icon.png' , array(
									'width' => 24 ,
									'height'=> 21
					));
					?>
					</span>
					<div class="desc">
						<?php
							$alert_msg = "Please confirm your email address by
								clicking on thelink we just emailed you. If you
								cannot find the email, you can request a new
								confirmation email or change your email address.
								";
							echo $this->Html->link($alert_msg , '#');
						?>
					</div>
				</li>

			</ul>
		</div>script
		<div class="white-box">
			<h2>Messages (2 new)</h2>
			<ul class="msg-list">
				<li>
					<span class="icon">
						<?php
						echo $this->Html->image('msg-icon.png' ,
										array('width' => 25 , 'height' => 23));
						?>

					</span>
					<div class="desc">
						<?php
							echo $this->Html->link(
								'Please confirm your email address....' ,'#');
						?>
					</div>
				</li>
				<li>
					<span class="icon">
						<?php
						echo $this->Html->image('msg-icon.png' ,
										array('width' => 25 , 'height' => 23));
						?>
					</span>
					<div class="desc">
						<?php
							echo $this->Html->link(
								'Please confirm your email address by clicking
									on the link we just emailed you. ...' ,'#');
						?>
					</div>
				</li>
			</ul>
		</div> -->


	<?php
	   echo $this->Html->scriptblock("
		$(window).load(function() {
			$('.listing_visibility').iphoneStyle({
				onChange: function(elem, value) {
					var property_id = $(elem).attr('rel');
	   				var accept = $('.accept').val(); 
					if( value.toString() == 'true') var visibility_status = '1';
					else var visibility_status = '0';

					$( '#listing_msg_'+ property_id ).html('<img src=\'".Router::url('/')."img/loading.gif\' />&nbsp;Please wait...');
										$( '#listing_msg_'+ property_id ).load('".Router::url(array('controller' => 'properties', 'action' => 'update_visibility'))."/'+ property_id + '/'+ visibility_status + '/' + accept, function() {
												if( value.toString() == 'true') $( '#listing_msg_'+ property_id ).html('Your listing is visible');
												else $( '#listing_msg_'+ property_id ).html('Your listing isn\'t visible yet.');
										});
								}
			});
		});
		");
	?>

<?php $this->end( ); ?>


<script>
$(window).load(function() {
	$('.listing_visibility').iphoneStyle({
		onChange: function(elem, value) {
			var property_id = $(elem).attr('rel');
				var accept = $('.accept').val(); 
			if( value.toString() == 'true') var visibility_status = '1';
			else var visibility_status = '0';

			$( '#listing_msg_'+ property_id ).html('<img src=\'".Router::url('/')."img/loading.gif\' />&nbsp;Please wait...');
								$( '#listing_msg_'+ property_id ).load('".Router::url(array('controller' => 'properties', 'action' => 'update_visibility'))."/'+ property_id + '/'+ visibility_status + '/' + accept, function() {
										if( value.toString() == 'true') $( '#listing_msg_'+ property_id ).html('Your listing is visible');
										else $( '#listing_msg_'+ property_id ).html('Your listing isn\'t visible yet.');
								});
						}
	});
});
</script>
