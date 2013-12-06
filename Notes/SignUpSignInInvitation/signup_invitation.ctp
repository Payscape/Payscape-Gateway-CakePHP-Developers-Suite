<?php echo $this->Html->css('validationEngine', array('inline'=>FALSE)); ?>
<?php echo $this->Html->script('languages/jquery.validationEngine-en', array('inline'=>FALSE)); ?>
<?php echo $this->Html->script('jquery.validationEngine', array('inline'=>FALSE)); ?>

<h1>Log In</h1>
<h2>Get more out of your VacationFish...</h2>
<span>Take advantage of special VacationFish features including Save Search, my Wishlist, and more!</span>
<div class="modalpopup-form">
			<h3>
				<?php echo __('Find the best places to stay recommended')?>
				<br><?php echo __('by your friends')?>. 
				<?php echo $this->Html->link('Learn More', array('controller' => 'pages', 'action' => 'display', 'how_it_works', 'how_it_works')); ?>
			</h3>
			<p>
				<a id="clicker" class="fb-btn" href="javascript:void(0);"><img width="38" height="38" alt="Connect with Facebook" class="vm" src="img/facebook.png "> Log In with Facebook </a>
			</p>
	<p>
	*Note: if you have multiple Facebook accounts, 
	<br>you may need to log out of Facebook to use Log in with Facebook.
	</p>
	<script>
		jQuery(function(){

			$("#clicker").on('click', function( ) {

				fb_login();			
			});
			

		//	alert("Yow!");

		});

</script>

			<br>
			<div class="seperator">&nbsp;</div>
			<strong class="largetext"><?php echo __('or');?></strong>
			<?php echo $this->Form->create('User', array('action' => 'login', 'id' => 'Invitation'));?>
			<div class="login-email-form">
				<div class="row">
					<?php echo $this->Form->input('email', array('tabindex' => 1, "placeholder" => "Email Address", 'class' => 'validate[required,custom[email]]', 'data-prompt-position' => 'topLeft:-180' , "label"=>false));?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('password', array('value' => '', 'tabindex' => 2, "placeholder" => "Password", 'class' => 'validate[required]', 'data-prompt-position' => 'topLeft:-180' , "label"=>false));?>
				</div>
				<div class="row">
					<p><?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember me next time'));?></p>
				</div>
				<div class="row">
					<?php echo $this->Form->submit('Log In',array('class' => 'white-btn','id'=>'id_login')); ?>
				</div>
				<div class="row">
				<?php
					echo $this->Html->link('Forgot Password?', array('admin' => false, 'prefix' => false, 'controller' => 'forgots', 'action' => 'index'));
				?>
					<?php 
					//echo $this->Html->link('Forgot Password?', array('admin' => false, 'prefix' => false, 'controller' => 'users', 'action' => 'forgot_password'));
					?>
				&nbsp;
				<?php
					echo $this->Html->link('Need an account?',array('admin' => false, 'prefix' =>false, 'controller' => 'users', 'action' => 'add'));
				?>
				</div>
			</div>
			<?php echo $this->Form->end()?>
		</div>


<?php echo $this->Html->script('jquery.validate.min.js'); ?>
<?php echo $this->Html->scriptblock('
	$("#Invitation").validate( );

'); ?>

