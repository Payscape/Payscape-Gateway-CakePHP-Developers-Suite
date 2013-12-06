<div class="feedbackform-wrapper">
	<?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'contact', 'action' => 'feedback'))); ?>
		<?php echo $this->Form->input('subject', array('placeholder' => 'What is this feedback about?', 'label' => false, 'size' => 50)); ?>
		<?php echo $this->Form->input('message', array('cols' => 110, 'rows' => 10, 'placeholder' => 'Your Feedback', 'label' => false)); ?>
		<div class="feedbackform-bottom">
			<div class="feedbackform-left"><?php echo $this->Form->submit('Send Feedback', array('class' => 'btn pink-btn')); ?></div>
			<div class="feedbackform-right">
				This form is for suggestions. If you have a specific issue that needs to be resolved please look through our
				<?php echo $this->Html->link('FAQs', array('controller' => 'faqs', 'action' => 'index')); ?>,
				see the <?php echo $this->Html->link('How It Works', array('controller' => 'pages', 'action' => 'display', 'how_it_works', 'how_it_works')); ?> page,
				or <?php echo $this->Html->link('email us', array('controller' => 'contact', 'action' => 'index')); ?>.
			</div>
		</div>
	<?php echo $this->Form->end( ); ?>
</div>
