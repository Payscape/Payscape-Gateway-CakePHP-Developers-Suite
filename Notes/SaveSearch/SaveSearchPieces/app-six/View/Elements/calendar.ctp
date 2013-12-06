<?php
/*

	usage:
		echo $this->element('calendar', array('mo' => 4, 'yr' => 2012, 'reserved' => array( ), 'small' => false, 'last' => false, 'links' => false));

	options:
		'mo' => [int] the month to show (optional, defaults to current month)
		'yr' => [int] the year to show (optional, defaults to current year)
		'reserved' => [array] the reservation array in the following format (optional, defaults to empty array)
			$reserved[$yr][$mo][$dy] = array('Reservation' => array( ... ));
			-- repeated for every date that is reserved
		-- OR --
		'reserved' => [array] the reservation array in the following format (optional, defaults to empty array)
			$reserved[$unix_date] = [id of reservation] OR 'past';
			-- repeated for every date that is reserved
		'small' => [bool] flag to show the small calendar (optional, defaults to false)
		'last' => [bool] flag to add the 'last' class onto the calendar for the manage page (optional, defaults to false)
		'links' => [bool] flag to add the links for the manage page (optional, defaults to false)
		'js' => [bool] flag to add the javascript for the send email form (optional, defaults to false)

*/

// set the timezone to UTC so we don't mess anything up
$TZ = date_default_timezone_get( );
date_default_timezone_set('UTC');

// defaults
$mo = (int) my_ife($mo, date('n'));
$yr = (int) my_ife($yr, date('Y'));
$reserved = (array) my_ife($reserved, array( ), false);
$small = (bool) my_ife($small, false);
$last = (bool) my_ife($last, false);
$links = (bool) my_ife($links, false);

// set the classes
$_small = ( ! empty($small) ? ' small' : '');
$_last = ( ! empty($last) ? ' last' : '');

// create a unix timestamp for the date given
$date = strtotime($yr.'-'.str_pad($mo, 2, '0', STR_PAD_LEFT).'-01');
$mo = date('n', $date);

// calculate how many leading days are shown
$leading = date('w', $date);

// grab the first day we should be showing
$first_date = strtotime('-'.$leading.' days', $date);
$first_day = date('j', $first_date);

// calculate how many trailing days are shown
$this_month = date('t', $date);
$trailing = (7 * 6) - ($leading + $this_month);

// don't output the first week separator, we handle that ourselves
$first_skipped = (bool) $leading;
$unix = $first_date;

?>

		<div class="calendar<?php echo $_small.$_last.' date_'.$yr.'_'.str_pad($mo, 2, '0', STR_PAD_LEFT); ?>">
			<div>
				<div class="month"><?php echo date('F Y', $date); ?></div>
				<div class="week">
					<?php

						$prev_res = false;

						// output a leading hidden day so there is a record of whether or not
						// a reservation that comes into this month started here or is passing through
						// but if there is no reservation, just skip it
						$prev_res = false;
						if ( ! empty($reservations[$first_date - DAY])) {
							$tyr = $yr;
							$tmo = $mo - 1;
							if (0 == $mo) {
								--$tyr;
								$tmo = 12;
							}

							$prev_res = $reservations[$first_date - DAY];

							$classes = array(
								'other',
								'td-date',
								'hidden',
								'date_'.$tyr.'_'.str_pad($tmo, 2, '0', STR_PAD_LEFT).'_'.str_pad($first_day - 1, 2, '0', STR_PAD_LEFT),
								'cal_'.date('Y_m_d', $first_date - DAY + (DAY / 2)),
								'reserved',
								'res_'.$reservations[$first_date - DAY],
								'l_res',
								'r_res',
							);

							echo '<div class="'.implode(' ', $classes).'"></div>';
						}

						// output the leading days
						if ( ! empty($leading)) {
							// we should never have to output a week div here

							for ($i = $first_day, $end = ($first_day + $leading - 1); $i <= $end; ++$i) {
								$tyr = $yr;
								$tmo = $mo - 1;
								if (0 == $mo) {
									--$tyr;
									$tmo = 12;
								}

								$classes = array(
									'other',
									'td-date',
									'date_'.$tyr.'_'.str_pad($tmo, 2, '0', STR_PAD_LEFT).'_'.str_pad($i, 2, '0', STR_PAD_LEFT),
									'cal_'.date('Y_m_d', $unix + (DAY / 2)), // add half day to prevent DST issues
								);

								if ( ! empty($reservations[$unix])) {
									$classes[] = 'reserved';
									$classes[] = 'res_'.$reservations[$unix];


									if ($reservations[$unix] !== $prev_res) {
										if (false === $prev_res) {
											$classes[] = 'r_res';
										}
										else {
											$classes[] = 'l_res';
											$classes[] = 'r_res';
										}
									}

									$prev_res = $reservations[$unix];
								}
								else {
									if ($prev_res) {
										$classes[] = 'l_res';
									}

									$prev_res = false;
								}

								?><div class="<?php echo implode(' ', $classes); ?>"><?php echo $i; ?></div><?php

								$unix += DAY;
							}
						}

						// output the proper days
						for ($i = 1; $i <= $this_month; ++$i) {
							// output the week div if we need to
							if (1 == (($leading + $i) % 7)) {
								if ($first_skipped) {
									echo '
				</div>
				<div class="week">
					';
								}
								else {
									$first_skipped = true;
								}
							}

							$classes = array(
								 'date_'.$yr.'_'.str_pad($mo, 2, '0', STR_PAD_LEFT).'_'.str_pad($i, 2, '0', STR_PAD_LEFT),
								 'td-date',
								 'cal_'.date('Y_m_d', $unix + (DAY / 2)), // add half day to prevent DST issues
							);

							$slot_id = '';
							$link_options = array(
								'class' => 'avail_add',
							);

							if ( ! empty($reserved[$yr][$mo][$i])) {
								$res = $reserved[$yr][$mo][$i];
								if ( ! empty($res['Reservation'])) {
									$res = $res['Reservation'];
								}

								$classes[] = 'taken';
								$classes[] = 'res_'.$res['id'];
								$slot_id = $res['id'];
								$link_options['class'] = 'avail_exists';
								$link_options['data-toggle'] = 'modal';
							}
							elseif ( ! empty($reservations[$unix])) {
								$classes[] = 'reserved';
								$classes[] = 'res_'.$reservations[$unix];


								if ($reservations[$unix] !== $prev_res) {
									if (false === $prev_res) {
										$classes[] = 'r_res';
									}
									else {
										$classes[] = 'l_res';
										$classes[] = 'r_res';
									}
								}

								$prev_res = $reservations[$unix];
							}
							else {
								if ($prev_res) {
									$classes[] = 'l_res';
								}

								$prev_res = false;
							}

							if (((int) date('Y') === (int) $yr) && ((int) date('n') === (int) $mo) && ((int) date('j') === (int) $i)) {
								$classes[] = 'today';
							}

							$out = $i;
							if ($links) {
								$out = $this->Html->link($out, '#resmodal'.$slot_id, $link_options);
							}

							?><div<?php echo (($classes) ? ' class="'.implode(' ', $classes).'"' : ''); ?>><?php echo $out; ?></div><?php

								$unix += DAY;
						}

						// output the trailing days
						if ( ! empty($trailing)) {
							for ($i = 1; $i <= $trailing; ++$i) {
								// output the week div if needed
								if (1 == (($leading + $this_month + $i) % 7)) {
									echo '
				</div>
				<div class="week">
					';
								}

								$tyr = $yr;
								$tmo = $mo + 1;
								if (13 == $mo) {
									++$tyr;
									$tmo = 1;
								}

								$classes = array(
									'other',
									'td-date',
									'date_'.$tyr.'_'.str_pad($tmo, 2, '0', STR_PAD_LEFT).'_'.str_pad($i, 2, '0', STR_PAD_LEFT),
									'cal_'.date('Y_m_d', $unix + (DAY / 2)), // add half day to prevent DST issues
								);

								if ( ! empty($reservations[$unix])) {
									$classes[] = 'reserved';
									$classes[] = 'res_'.$reservations[$unix];


									if ($reservations[$unix] !== $prev_res) {
										if (false === $prev_res) {
											$classes[] = 'r_res';
										}
										else {
											$classes[] = 'l_res';
											$classes[] = 'r_res';
										}
									}

									$prev_res = $reservations[$unix];
								}
								else {
									if ($prev_res) {
										$classes[] = 'l_res';
									}

									$prev_res = false;
								}

								?><div class="<?php echo implode(' ', $classes); ?>"><?php echo $i; ?></div><?php

								$unix += DAY;
							}
						}
					?>
				</div>
			</div>
		</div><!-- .calendar -->


<?php

// revert the timezone
date_default_timezone_set($TZ);

