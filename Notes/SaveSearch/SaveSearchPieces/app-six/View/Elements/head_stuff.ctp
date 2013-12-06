
	<?php echo $this->Html->charset( ); ?>
	<title>VacationFish - <?php echo $title_for_layout; ?></title>

	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min.css');
//		echo $this->Html->css('bootstrap-responsive.min.css');
		echo $this->Html->css('redmond/jquery-ui-1.8.18.custom.css');
		echo $this->Html->css('new.css');
		echo $this->Html->css('print.css', 'stylesheet', array('media' => 'print'));
	?>

	<!--[if IE 8]><?php echo $this->Html->css('ie8.css'); ?><![endif]-->
	<!--[if IE 7]><?php echo $this->Html->css('ie7.css'); ?><![endif]-->

	<?php
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
		echo $this->Html->script('bootstrap.min.js');

		echo $this->Html->scriptblock('var ROOT_URL = "'.$this->Html->url('/').'";');
	?>