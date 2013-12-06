
	</div> <!-- .content -->

	<div class="footer row">
		<div class="span6">&copy; 2012<?php if (2012 < date('Y')) { echo '&ndash'.date('Y'); } ?> VacationFish</div>
		<div class="span6 text-right links">
			<?php echo $this->Html->link('Footer Links', '#'); ?>
			<?php echo $this->Html->link('Footer Links', '#'); ?>
			<?php echo $this->Html->link('Footer Links', '#'); ?>
		</div>
	</div>

<!-- social button scripts -->
	<!-- pinterest -->
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

	<!-- google + -->
	<script type="text/javascript">
		window.___gcfg = {
			lang: 'en-US',
			parsetags: 'onload'
		};

		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	</script>

	<!-- facebook -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

<!-- email_friend modal -->
	<div class="modal hide fade" id="email_friend">
	<?php echo $this->Form->create('Message', array('class' => 'form-horizontal', 'url' => array('action' => 'email_friend'))); ?>
		<?php echo $this->Form->input('here', array('type' => 'hidden', 'value' => $this->Html->url($this->params['url']['url'], true))); ?>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Send to Friend</h3>
		</div>
		<div class="modal-body">

			<?php echo $this->Boot->input('your_name', array('label' => 'Your Name')); ?>
			<?php echo $this->Boot->input('your_email', array('label' => 'Your Email')); ?>
			<?php echo $this->Boot->input('friends_name', array('label' => 'Friend\'s Name')); ?>
			<?php echo $this->Boot->input('friends_email', array('label' => 'Friend\'s Email')); ?>
			<?php echo $this->Boot->input('comments', array('label' => 'Message', 'type' => 'textarea')); ?>

		</div>
		<div class="modal-footer form-actions">
			<div class="">
				<?php echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'div' => false)); ?>
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
		</div>
	<?php echo $this->Form->end( ); ?>
	</div>

