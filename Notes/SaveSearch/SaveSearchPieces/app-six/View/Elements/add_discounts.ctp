<?php $this->Html->script('add_sort.js', array('inline' => false)); ?>

<?php

	$count = count($this->request->data['Discount']);
	$values = range(5, 60, 5);
	$values = array_combine($values, $values);

?>

		<div class="addable" id="discounts">

			<?php if ( ! empty($this->request->data['Discount'])) { ?>

				<?php foreach ($this->request->data['Discount'] as $idx => $disc) { ?>

				<div class="removable">
					<div class="row">

						More than
							<?php
								echo $this->Form->input('Discount.'.$idx.'.id', array('type' => 'hidden', 'value' => $disc['id']));
								echo $this->Form->input('Discount.'.$idx.'.lower_bound', array(
									'type' => 'text',
									'value' => $disc['lower_bound'],
									'label' => false,
									'div' => false,
									'maxlength' => 3,
									'style'  => 'width:20px',
								));
							?>
						days =
							<?php
								echo $this->Form->input('Discount.'.$idx.'.discount', array(
									'type' => 'select',
									'options' => $values,
									'value' => $disc['discount'],
									'label' => false,
									'div' => false,
									'style' => 'width:70px',
								));
							?>
						% off

						<?php echo $this->Html->image('btn-minus.png', array('alt' => 'Delete', 'title' => 'Delete This Entry', 'class' => 'image-minus delete')); ?>

					</div>
					<div class="seperator-big"></div>
				</div>

				<?php } ?>

			<?php } ?>

				<div class="removable clone" style="display:none;">
					<div class="row">

						More than
							<?php
								echo $this->Form->input('Discount.NNN.lower_bound', array(
									'type' => 'text',
									'label' => false,
									'div' => false,
									'maxlength' => 3,
									'style'  => 'width:20px',
								));
							?>
						days =
							<?php
								echo $this->Form->input('Discount.NNN.discount', array(
									'type' => 'select',
									'options' => $values,
									'label' => false,
									'div' => false,
									'style' => 'width:70px',
								));
							?>
						% off

						<?php echo $this->Html->image('btn-minus.png', array('alt' => 'Delete', 'title' => 'Delete This Entry', 'class' => 'image-minus delete')); ?>

					</div>
					<div class="seperator-big"></div>
				</div>

			<?php if (false && 5 > $count) { ?>
				<div class="removable">
					<div class="row">

						More than
							<?php
								echo $this->Form->input('Discount.'.$count.'.lower_bound', array(
									'type' => 'text',
									'label' => false,
									'div' => false,
									'maxlength' => 3,
									'style'  => 'width:20px',
								));
							?>
						days =
							<?php
								echo $this->Form->input('Discount.'.$count.'.discount', array(
									'type' => 'select',
									'options' => $values,
									'label' => false,
									'div' => false,
									'style' => 'width:70px',
								));
							?>
						% off

						<?php echo $this->Html->image('btn-minus.png', array('alt' => 'Delete', 'title' => 'Delete This Entry', 'class' => 'image-minus delete')); ?>

					</div>
					<div class="seperator-big"></div>
				</div>
			<?php } ?>

				<div id="add_button" align="center"<?php echo ((5 > $count) ? '' : ' style="display:none;"'); ?>>
					<span class="add cnt_discount blue-btn-sm add-discount">+ Add Another Discount</span>
					<div class="seperator-big"></div>
				</div>

			<?php $this->Html->scriptblock('counters["discount"] = '.(count($this->request->data['Discount']) + 1).';', array('inline' => false)); ?>

		</div> <!-- .addable -->

