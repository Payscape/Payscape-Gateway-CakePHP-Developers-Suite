<?php $pr = $property['Property']; ?>
<?php $st = $property['AdminCode']; ?>
<?php $pt = $property['PropertyType']; ?>

<?php 
	$geonames_id = $pr['geoname_id'];
	
	echo "geonames_id: $geonames_id";
	exit();
?>



<?php 
/* 
 * for testing
*/
	
/*
	echo "<pre>";
	print_r($st);
	exit();
*/

/*
	echo "<pre>";
	print_r($property);
	exit();
	echo "</pre>";
*/	
/*	
	echo "<br>PR ID: <br>";
	echo $pr['id'];
	
	echo "<br>ST ABBR: <br>";
	echo $st['abbr'];
	echo "<br>PR</br>";
	//print_r($pr);
	echo "</pre>";
	
	exit();
	
	
/*
 */
//	echo "<pre>";
	//debug($this->Paginator);
//	echo "<br> next";
if(isset($this->Paginator)){
	$paginator_options = $this->Paginator->options;
	//debug($paginator_options);
	if(!empty($paginator_options['url']['page'])){
	$currentpage = $paginator_options['url']['page'];
	} else {
		$currentpage = 1;
	}
} else {
	$currentpage = 1;
}	
//	echo "<br>CURRENT PAGE: ";
//	echo $currentpage;
//	echo "</pre>";
//	exit(); 
	
	


?>


	<li class="vfid_<?php echo $pr['id']; ?>">
		<div class="cf">
		
			<div class="thumb"><?php 
//			echo $this->Html->image(ife($property['PropertyImage'][0]['image']['list'], 'list_missing.png'), array('url' => array('controller' => 'properties', 'action' => 'view', $pr['id']), array('target' => 'viewbox')));
 
			echo $this->Html->image( 'files/'. $pr['user_id'] . '/' . $pr['id'] . '/images/' . ife($property['PropertyImage'][0]['image'], 'list_missing.png'), array('url' => array('controller' => 'properties', 'action' => 'view', $pr['id'], 'page' => $currentpage)));
					
			?>
		</div>
			<div class="details">
	
			<h3><?php echo $this->Html->link($pr['title'], array( 'controller' => 'properties', 'action' => 'view', $pr['id'], 'page' => $currentpage)); ?></h3>
			<h4><?php //echo $pt['name']; ?> - <?php echo $pr['city']; ?>  <?php echo $st['nameAscii']; ?></h4>
			<h4><?php echo $pt['name']; ?>, <span class="city"></span>, <span class="state"></span>, <span class="country"></span></h4>
				<p><?php echo excerpt($pr['description'], 15); ?></p>
				<div class="row icon">
					<?php //echo $this->element('amenity_icons', array('prop' => $pr)); ?>
					<?php
						if ( ! empty($_SESSION['Auth']['User']['id'])) {
							if (in_array($pr['id'], $pid)) {
								echo $this->Html->link('<span>Add to wishlist</span>', 'javascript:void(0);', array('class' => 'wishlist-btn inactive', 'escape' => false));
							}
							else {
								echo $this->Html->link(
									$this->Html->tag('span', "Add to wishlist"),
									array('controller' => 'wishlistitems', 'action' => 'add', $pr['id']),
									array('class' => 'wishlist-btn thickbox', 'escape' => false)
								);
							}
						}
						else {
							echo $this->Html->link(
								$this->Html->tag('span', "Add to wishlist"),
								array('controller' => 'users', 'action' => 'login_pop'),
								array('class' => 'wishlist-btn thickbox', 'escape' => false)
							);
						}
					?>
				</div>
			</div>

		
			<div class="price-cnt">
				<div class="price">
				<span>From</span> $<?= number_format($pr['daily_rate']); ?> <span>Per night</span>
				</div>
				<?php echo (( ! empty($property['Discount'])) ? '<div class="offer">Multi-Night<br>Discount</div>' : '') ?>
			</div>
		</div>
	</li>
	<script>

	get_geonames();
	
	var geonames_jqXHR = false;
	function get_geonames( ) {

		var geonames_id = <?php echo $geonames_id; ?>;

		if (geonames_jqXHR) {
			geonames_jqXHR.abort( );
		}

		geonames_jqXHR = $.post(
			ROOT_URL+'properties/getGeo/'+geonames_id,
			{
			},
			function (response) {
				var results = jQuery.parseJSON(response);
				if (1 == results.status) {
					$('.city').html(results.city);
					$('.state').html(results.state);
					$('.country').html(results.country);
					geonames_jqXHR = false;
				}
			}
		);

	</script>