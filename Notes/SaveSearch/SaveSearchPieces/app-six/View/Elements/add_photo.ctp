<?php // $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', array('inline' => false)); ?>
<?php $this->Html->script('add_sort.js', array('inline' => false)); ?>

<?php

	$model = 'PropertyImage';
	$model_join = 'BedsProperty';
	$var_name = Inflector::variable(Inflector::pluralize($model));

?>
<div class="input select add">
	<label><?php echo $model; ?></label>
	<div class="holder">
		<div class="clone">
			<?php echo $this->Form->text($model.'.NNN.number'); ?> of
			<?php echo $this->Form->select($model.'.NNN.id', ${$var_name}, null, array('class' => 'narrow')); ?>
			<?php echo $this->Html->image('delete.png', array('class' => 'delete', 'title' => 'Delete this '.$model, 'alt' => 'Delete this '.$model)); ?>
		</div>

	<?php if (isset($this->data[$model]) && count($this->data[$model])) { ?>

		<?php $this->Html->scriptblock('var add_sort_start = '.(count($this->data[$model]) + 1).';', array('inline' => false)); ?>

		<?php foreach ($this->data[$model] as $key => $entry) { ?>

		<div>
			<?php echo $this->Form->text($model.'.'.$key.'.number', array('value' => (int) $entry[$model_join]['number'])); ?> of
			<?php echo $this->Form->select($model.'.'.$key.'.id', ${$var_name}, $entry[$model_join][strtolower($model).'_id'], array('class' => 'narrow')); ?>
			<?php echo $this->Html->image('delete.png', array('class' => 'delete', 'title' => 'Delete this '.$model, 'alt' => 'Delete this '.$model)); ?>
		</div>

		<?php } ?>

		<div>
			<?php echo $this->Form->text($model.'.'.($key + 1).'.number'); ?> of
			<?php echo $this->Form->select($model.'.'.($key + 1).'.id', ${$var_name}, null, array('class' => 'narrow')); ?>
			<?php echo $this->Html->image('delete.png', array('class' => 'delete', 'title' => 'Delete this '.$model, 'alt' => 'Delete this '.$model)); ?>
		</div>

	<?php } else { ?>

		<?php $this->Html->scriptblock('var add_sort_start = 1;', array('inline' => false)); ?>

		<div>
			<?php echo $this->Form->text($model.'.0.number'); ?> of
			<?php echo $this->Form->select($model.'.0.id', ${$var_name}, null, array('class' => 'narrow')); ?>
			<?php echo $this->Html->image('delete.png', array('class' => 'delete', 'title' => 'Delete this '.$model, 'alt' => 'Delete this '.$model)); ?>
		</div>

	<?php } ?>

	</div>

	<?php echo $this->Html->image('add.png', array('class' => 'add', 'title' => 'Add New '.$model, 'alt' => 'Add New '.$model)); ?>
</div>

<div class="row">
	<div class="span15">
		<?php echo $this->Form->input('PropertyImage.0.image', array('type'=>'file', 'label' => '')); ?>
		<?php echo $this->Html->image('btn-plus.png', array('alt' => 'Plus', 'class' => 'image-plus')); ?>
	</div>
</div>

<?php if ( ! empty($this->data['PropertyImage'])) { ?>
<table class="table table-bordered table-striped uploaded-images">
	<tbody>

	<?php foreach ($this->data['PropertyImage'] as $property_image) { $pi = $property_image['PropertyImage']; ?>
		<tr>
			<td>
				<?php echo $this->Form->input('PropertyImage.PropertyImage.n', array('type' => 'hidden', 'value' => $pi['id'])); ?>
				<?php echo $this->Html->image($pi['image']['thumb']); ?>
			</td>
			<td><?php echo $this->Html->image('btn-minus.png', array('alt' => 'Minus', 'class' => 'image-minus')); ?></td>
		</tr>
	<?php } ?>

	</tbody>
</table>
<?php } ?>
