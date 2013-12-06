<?php 

$base_url = $this->base;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    	<?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

  <title><?php echo $title_for_layout; ?></title>

    <!-- Bootstrap core CSS -->

    
    <?php 
    // New UI CSS below
    echo $this->Html->css('bootstrap.css');
    echo $this->Html->css('jumbotron-narrow.css');
    echo $this->Html->css('custom.css');
    
    ?>

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php 
    echo $this->Html->meta('icon');
    ?>
    
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="/">Home</a></li>
          <li>
          	<?php echo $this->Html->link('View Transactions', array('controller' => 'transactions', 'action' => 'index')); ?>
          </li> 
                    <li>
          	<?php echo $this->Html->link('New Transaction', array('controller' => 'transactions', 'action' => 'add')); ?>
          </li>
        </ul>
        <h3 class="text-muted">Payscape Lab</h3>
      </div>

      <div class="jumbotron">
        <h1>Payscape Development Lab</h1>
        		<?php 
		$description = "Payscape Advisor";
		echo $this->Html->link(
					$this->Html->image('payscape_home_logo.png', array('alt' => $description, 'border' => '0')),
					'http://www.payscape.com/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
      </div>

      <div class="span9">
      <div class="span4"><?php echo $this->Session->flash(); ?></div>
      
<?php echo $this->fetch('content'); ?>
        
      </div>

      <div class="footer">
        <p>&copy; Payscape Advisors 2013</p>
      </div>
<footer>
		<?php 
		$description = "Payscape Advisor";
		echo $this->Html->link(
					$this->Html->image('payscape_footer_logo.png', array('alt' => $description, 'border' => '0')),
					'http://www.payscape.com/',
					array('target' => '_blank', 'escape' => false)
				);
		?>


</footer>
<?php echo $this->element('sql_dump'); ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <?php 
    echo $this->Html->script('bootstrap', array('inline' => false));
    
    ?>
    
  </body>
</html>
