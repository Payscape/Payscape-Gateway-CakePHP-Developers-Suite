<?php

	if ( ! isset($max_rating)) {
		$max_rating = 5;
	}

	$max_rating = (int) $max_rating;

?>

	<div class="rating" data-value="<?php echo number_format($value, 2); ?>" title="<?php echo number_format($value, 2); ?>">
		<?php
			for ($i = 0.25; $i <= $max_rating; $i += 1) {
				if ($value < $i) {
					echo $this->Html->image('rateNone.png', array('alt' => ' '));
				}
				elseif (($value >= $i) && ($value < ($i + 0.5))) {
					echo $this->Html->image('rateHalf.png', array('alt' => '/'));
				}
				else {
					echo $this->Html->image('rateFull.png', array('alt' => '*'));
				}
			}
		?>
	</div>
