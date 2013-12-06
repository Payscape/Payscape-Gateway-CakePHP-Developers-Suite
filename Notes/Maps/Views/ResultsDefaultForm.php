<div style="display:none;">

<?php echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'resutls'), 'class' => 'Search', 'id'=>'Search')); ?>
<?php echo $this->Form->submit('Search', array('div' => false), array('id'=>'Kangaroo')); ?>
<?php 

echo $this->Form->hidden('Search.n_latitude', array('data-geo' => 'locality'));
echo $this->Form->hidden('Search.e_longitude', array('data-geo' => 'locality'));
echo $this->Form->hidden('Search.s_latitude', array('data-geo' => 'locality'));
echo $this->Form->hidden('Search.w_longitude', array('data-geo' => 'locality'));

?>
<?php echo $this->Form->end( ); ?>

</div>