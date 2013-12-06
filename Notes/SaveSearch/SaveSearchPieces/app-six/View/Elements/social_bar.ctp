
	<div class="bordered top-rounded social">
		<div class="text-right social">
			<ul class="social-bar-listing">
				<li>
					<!-- twitter: note data-* attrs -->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $this->Html->url('/', true); ?>" data-text="VacationFish...  Awesome!" data-count="none" data-hashtags="hashtag,another" data-dnt="true">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</li>

				<li>
					<!-- pinterest: note URL query arguments
						also note: must include script at bottom of page -->
					<a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fvacationfish.com&media=http%3A%2F%2Fvacationfish.com%2Fimage.png&description=Description%20text" class="pin-it-button" count-layout="none"
					><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
				</li>

				<li>
					<!-- google +: note tag attributes- https://developers.google.com/+/plugins/+1button/#plusonetag-parameters
						also note settings in script at bottom of page -->
					<g:plusone href="<?php echo $this->Html->url('/', true); ?>" size="medium" annotation="none" recommendations="false"></g:plusone>
				</li>

				<li class="email">
					<!-- email -->
					<?php echo $this->Html->link('<i class="icon-envelope"></i>', '#email_friend', array('class' => 'btn btn-mini', 'data-toggle' => 'modal', 'escape' => false)); ?>
				</li>

				<li>
					<!-- facebook: note the data-* attrs
						also note: must include script at bottom of page -->
					<div class="fb-like" data-href="http://vacationfish.com" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false" data-font="arial"></div>
				</li>
			</ul>
		</div>
	</div>

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

<!-- social button scripts -->

	<!-- pinterest -->
	<?php $this->Html->script('//assets.pinterest.com/js/pinit.js', array('block' => 'scriptBottom')); ?>

	<!-- google + -->
	<?php $this->Html->scriptblock("
		window.___gcfg = {
			lang: 'en-US',
			parsetags: 'onload'
		};

		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	", array('block' => 'scriptBottom')); ?>

	<!-- facebook -->
	<?php $this->Html->scriptblock('
		document.write(\'<div id="fb-root"></div>\');
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, \'script\', \'facebook-jssdk\'));
	', array('block' => 'scriptBottom')); ?>

