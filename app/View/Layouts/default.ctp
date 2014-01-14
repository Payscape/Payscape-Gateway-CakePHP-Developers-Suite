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
          <li class="active"><a href="<?php echo $this->base; ?>/">Home</a></li>
          <li class="dropdown">
              <a href="<?php echo $this->webroot; ?>" class="dropdown-toggle" data-toggle="dropdown">Transactions <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                <?php echo $this->Html->link('Sale Credit Card', array('controller' => 'transactions', 'action' => 'add_credit_card')); ?>
                </li>
                <li>
                <?php echo $this->Html->link('Sale Check', array('controller' => 'transactions', 'action' => 'add_check')); ?>
                </li>
				<li>
                <?php echo $this->Html->link('Auth Credit Card', array('controller' => 'transactions', 'action' => 'authorize_credit_card')); ?>
                </li>   
               <li>
                <?php echo $this->Html->link('Validate Credit Card', array('controller' => 'transactions', 'action' => 'validate_credit_card')); ?>
               </li>              
          <li>
          	<?php echo $this->Html->link('List Transactions', array('controller' => 'transactions', 'action' => 'index')); ?>
          </li> 


              </ul>
           </li> 
        </ul>
        <h3 class="text-muted">Payscape Lab</h3>
      </div>

      <div class="jumbotron">
        <h1>Payscape CakePHP Developers Suite</h1>
        		<?php 
		$description = "Payscape Advisor";
		echo $this->Html->link(
					$this->Html->image('payscape_home_logo.png', array('alt' => $description, 'border' => '0')),
					'http://www.payscape.com/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
        <p> Rapid eCommerce Web Development with CakePHP and the Payscape Direct Post API.</p>
      </div>

      <div class="span9">
      <div class="span4"><?php echo $this->Session->flash(); ?></div>
      
<?php echo $this->fetch('content'); ?>
        
      </div>

      <div class="footer">
        <p>&copy; Payscape Advisors 2014</p>
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
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <?php 
    echo $this->Html->script('bootstrap.min');
    
    ?>
    
  </body>
</html>
