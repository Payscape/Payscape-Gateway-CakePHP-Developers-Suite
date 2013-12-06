<?php

	$map = my_ife($map, false);
	$abbrs = array(
		'daily' => 'dy',
		'weekly' => 'wk',
		'monthly' => 'mo',
	);

?>
<div class="info-table">
	<table class="table table-bordered table-striped table-condensed">
		<tbody>
			<?php if ( ! $map) { ?>
			<tr>
				<td class="text">City</td>
				<td><?php echo $pr['city']; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="text">Rate</td>
				<td>$<?php echo number_format($pr[$this->request->data['Search']['rate_by'].'_rate'], 2).' / '.$abbrs[$this->request->data['Search']['rate_by']]; ?></td>
			</tr>
			<tr>
				<td class="text">Bedrooms</td>
				<td><?php echo $pr['bedrooms']; ?></td>
			</tr>
			<tr>
				<td class="text">Bathrooms</td>
				<td><?php echo $pr['bathrooms']; ?></td>
			</tr>
			<?php if ( ! $map) { ?>
			<tr>
				<td class="text">Sleeps</td>
				<td>9</td>
			</tr>
			<?php } ?>
			<tr>
				<td class="text">Sq. Footage</td>
				<td><?php echo number_format($pr['square_footage']); ?></td>
			</tr>
		</tbody>
	</table>
</div>

