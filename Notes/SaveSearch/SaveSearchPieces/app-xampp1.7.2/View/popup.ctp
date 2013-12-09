<?php echo $this->Html->scriptblock('
	var addto_wishlist_url = "'.Router::url(array('controller' => 'wishlistitems', 'action' => 'add')).'";
	var ajax_load_search_url = "'.Router::url(array('controller' => 'searches', 'action' => 'ajax_load_search')).'";
', array('inline' => false)); ?>


<h2>Save this search</h2>
<div class="modal-form">
	<?php echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'save_search'))); ?>
		<?php echo $this->Form->hidden('type', array('value' => 'link')); ?>

		<div class="row">
			<?php
				echo $this->Form->input('name', array('label' => false, 'div' => false,'class' => 'validate[required]', 'data-prompt-position' => 'topLeft:-180','placeholder' => 'Enter your save search title'));
				echo $this->Form->hidden('data');
			?>
		</div>

		<div class="row" align="center">
			<?php echo $this->Form->submit('Save', array('class' => 'pink-btn', 'div' => false)); ?>
		</div>

	<?php $this->Form->end( ); ?>
</div>

<?php

	echo $this->Html->scriptblock('
		jQuery("#SavedSearchFrm").validationEngine( );
		jQuery("#SearchData").val(parent.$("#SearchResultsForm").serialize( ));
	');

	
	<?php echo $this->Html->script('results.js'); ?>