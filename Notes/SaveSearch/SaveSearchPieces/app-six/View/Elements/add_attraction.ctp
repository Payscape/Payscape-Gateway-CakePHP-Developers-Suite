<?php // $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', array('inline' => false)); ?>
<?php $this->Html->script('add_sort.js', array('inline' => false)); ?>

<div class="select add">

	<div class="holder">

		<div class="clone">
			<?php echo $this->Form->input('LocalAttraction.NNN.name'); ?>
			<?php echo $this->Form->input('LocalAttraction.NNN.attraction_type'); ?>
			<?php echo $this->Form->input('LocalAttraction.NNN.city'); ?>
			<?php echo $this->Form->input('LocalAttraction.NNN.description'); ?>
			<?php echo $this->Form->input('LocalAttraction.NNN.image', array('type' => 'file')); ?>
			<?php echo $this->Html->image('icon-minus.png', array('class' => 'delete cnt_loc_attr', 'title' => 'Delete this Attraction', 'alt' => 'Delete this Attraction')); ?>
		</div>

	<?php if (isset($this->request->data[$model]) && count($this->request->data[$model])) { ?>

		<?php $this->Html->scriptblock('counters["loc_attr"] = '.(count($this->request->data[$model]) + 1).';', array('inline' => false)); ?>

		<?php foreach ($this->request->data[$model] as $key => $entry) { ?>

		<div>
			<?php if ( ! empty($entry['id'])) { ?>
			<?php echo $this->Form->input($model.'.'.$key.'.id', array('type' => 'hidden', 'value' => $entry['id'])); ?>
			<?php } ?>

			<?php echo $this->Form->input($model.'.'.$key.'.name', array('value' => $entry['name'])); ?>
			<?php echo $this->Form->input($model.'.'.$key.'.utility_id', array('value' => $entry['utility_id'], 'options' => $utilities, 'empty' => true)); ?>
			<?php echo $this->Form->input($model.'.'.$key.'.number', array('value' => $entry['number'], 'label' => 'Phone Number')); ?>
			<?php echo $this->Html->image('icon-minus.png', array('class' => 'delete cnt_loc_attr', 'title' => 'Delete this Attraction', 'alt' => 'Delete this Attraction')); ?>
		</div>

		<?php } ?>

		<div>
			<?php echo $this->Form->input($model.'.'.($key + 1).'.name'); ?>
			<?php echo $this->Form->input($model.'.'.($key + 1).'.utility_id', array('options' => $utilities, 'empty' => true)); ?>
			<?php echo $this->Form->input($model.'.'.($key + 1).'.number', array('label' => 'Phone Number')); ?>
			<?php echo $this->Html->image('icon-minus.png', array('class' => 'delete cnt_loc_attr', 'title' => 'Delete this Attraction', 'alt' => 'Delete this Attraction')); ?>
		</div>

	<?php } else { ?>

		<?php $this->Html->scriptblock('counters["loc_attr"] = 1;', array('inline' => false)); ?>

		<div>
			<?php echo $this->Form->input($model.'.0.name'); ?>
			<?php echo $this->Form->input($model.'.0.utility_id', array('options' => $utilities, 'empty' => true)); ?>
			<?php echo $this->Form->input($model.'.0.number', array('label' => 'Phone Number')); ?>
			<?php echo $this->Html->image('icon-minus.png', array('class' => 'delete cnt_loc_attr', 'title' => 'Delete this Attraction', 'alt' => 'Delete this Attraction')); ?>
		</div>

	<?php } ?>

	</div>

	<?php echo $this->Html->link('Add Another Attraction', 'javascript:;', array('class' => 'add cnt_loc_attr', 'title' => 'Add Another Attraction')); ?>

</div>

