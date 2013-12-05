
	

<!DOCTYPE html>
<html>
<head>
	<?php //echo $this->Html->charset( ); ?>
  
    <?php //echo $this->Html->scriptblock('var ROOT_URL = "'.Router::url('/').'";'); ?>
    
<title><?php echo $title_for_layout; ?></title>

	<?php
	/*
		if (isset($seo_keywords)) {
			echo $this->Html->meta('keywords', $seo_keywords);
		}

		if (isset($seo_description)) {
			echo $this->Html->meta('description', $seo_description);
		}
	*/	
	?>

	        
    <meta name="author" content="Payscape Advisors">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    
    <meta name="google-site-verification" content="hkKLmJSTweBGBwf5P8sxIyqPbZSHnQbGmIxr5OUKB8Y" />
    <meta name="google-site-verification" content="ZrYy1gV49E8nc58OPLwz266fmR7OW8xIxmpP4t4VVpg" />
   	<meta name="google-site-verification" content="H89kdAUS99v5wn1N04VzSiEPNsjdAEhR3hZCDu2WZdo" />
    <meta name="msvalidate.01" content="5EA1CAB5C47B3474801E45ECAD2E68CA" />
    
    <!-- Le styles -->
    <?php
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');

    
    ?>
    
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap_payscape.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'> 
       
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/payscape_ie.css" />
    <![endif]-->
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    
    <!-- Fav and touch icons 
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">-->
    
    <!-- Social Sharing -->
    <script>var switchTo5x=false;</script>
	<script src="http://w.sharethis.com/button/buttons.js"></script>
    <script>stLight.options({publisher: "bea435d1-ffbc-46c3-9590-3cbcdf9af139", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    


    	<?php
	//	echo $this->Html->script('initialize.js');
	//	echo $scripts_for_layout;
	?>
    
</head>
<body>
<!-- NAVBAR 1
================================================== -->
<div class="navbar navbar-fixed-top" style="padding:0 0px 0 0px;">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="/"><img src="assets/img/payscape_home_logo.png" alt="Payscape Advisors"></a>
      <button class="we-hiring" onClick="window.location='http://payscape.com/careers/'"></button>
      <div class="nav-collapse collapse pull-right nav-pull-up">
          <ul class="nav">
            <li class="dropdown lh_twenty">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown">HOME <b class="caret"></b></a>
             
            </li>
            <li><a href="/developers/">DEVELOPERS</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">COMPANY <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/overview.php">Overview</a></li>
                <li class="divider"></li>
                <li><a href="/careers/">Careers</a></li>
                <li class="divider"></li>
                <li><a href="/core-values.php">Core Values</a></li>
                <li class="divider"></li>
                <li><a href="/partners/">Partners</a></li>
                <li class="divider"></li>
                <li><a href="http://insights.payscape.com/" target="_blank">Blog-O-Scape</a></li>
                <li class="divider"></li>
                <li><a href="/media">Media</a></li>
              </ul>
            </li>
            <li><a href="/signup.php"><i class="topNav-icon-orange topNav-icon-signup"></i> SIGNUP</a></li>                
            <li><a href="/contact.php"><i class="topNav-icon-orange topNav-icon-contact"></i> CONTACT</a></li>
            <li class="dropdown">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="topNav-icon-orange topNav-icon-login"></i> LOGIN</a>
                <ul class="dropdown-menu">
                	<li><a href="https://secure.nmi.com/merchants/login.php" target="_blank">Merchant Login</a></li>
                    <li><a href="https://www.firstview.net/PayscapeAdvisors/" target="_blank">Statement Login</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
    
<!-- NAVBAR 2 Smooth Scroll
================================================== 
<div class="navbar-bottom" style="background-color:#493b3b;">


    <div class="container">
        <div class="nav-collapse" style="text-align:center;">
            <div class="buttonNav-icon-white">
            	<a href="#paymentFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_payment.png" alt="Payment Gateway" /><h2>PAYMENT GATEWAY</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="#electronicFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_electronic.png" alt="Electronic Payments" /><h2>ELECTRONIC PAYMENTS</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="#invoicingFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_invoicing.png" alt="Online Invoicing" /><h2>ONLINE INVOICING</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="#registrationFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_registration.png" alt="Online Registration" /><h2>ONLINE REGISTRATION</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="#capitalFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_capital.png" alt="Working Capital" /><h2>WORKING CAPITAL</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="#mobileFeaturette" class="smoothScroll"><img class="" src="images/icons_large_white_mobile.png" alt="Mobile Payments" /><h2>MOBILE PAYMENTS</h2></a>
            </div>-->
        <!--</div> /.nav-collapse -->
    <!--</div> /.container -->
<!--</div> /.navbar-bottom -->

<!-- NAVBAR 2
================================================== -->
<div class="navbar-bottom" style="background-color:#493b3b;">
    <div class="container">
        <div class="nav-collapse" style="text-align:center;">
            <div class="buttonNav-icon-white">
            	<a href="/payment-gateway.php"><img class="" src="/images/icons_large_white_payment.png" alt="Payment Gateway" /><h2>PAYMENT GATEWAY</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="/online-invoicing.php" class="smoothScroll"><img class="" src="/images/icons_large_white_invoicing.png" alt="Online Invoicing" /><h2>ONLINE INVOICING</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="/online-registration.php" class="smoothScroll"><img class="" src="/images/icons_large_white_registration.png" alt="Online Registration" /><h2>ONLINE REGISTRATION</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="/working-capital.php" class="smoothScroll"><img class="" src="/images/icons_large_white_capital.png" alt="Working Capital" /><h2>WORKING CAPITAL</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="/mobile-payments.php" class="smoothScroll"><img class="" src="/images/icons_large_white_mobile.png" alt="Mobile Payments" /><h2>MOBILE PAYMENTS</h2></a>
            </div>
            <div class="buttonNav-icon-white">
            	<a href="/retail-payments.php" class="smoothScroll"><img class="" src="/images/icons_large_white_electronic.png" alt="Retail Payments" /><h2>RETAIL PAYMENTS</h2></a>
            </div>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar-bottom --><!-- Carousel
================================================== -->
<!-- START THE FEATURETTES -->
<div class="carouselClear"></div>


<!-- PAGE CONTENT
================================================== -->
<div class="container">
<div class="clearfix">&nbsp;</div>


	<div class="flash-msg-cnt">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
			</div>


		<?php //echo $content_for_layout; ?>	
			


<hr>
</div>








   
<div class="clearfix"></div>
 
<div class="findOutMobile">
	<button class="mobileButton mobilePurple" onClick="window.location='working-capital.php'">FIND OUT MORE</button>
</div>


<div style="clear:both; height:0px;" id="mobileFeaturette"></div>
<div class="featurette blue negMargin threeFifty">
	<div class="container">
	

	
	
	
    <div class="mobilePayments pull-left"></div>
    	<div class="body-icon body-icon-mobile"></div>
        <!--<img class="featurette-image pull-left" src="">-->
        <div class="featureHeader featureRight">
        	<h2 class="featurette-heading">Mobile Payments</h2>
        </div>
        <p class="lead leadBlue featureRight">Accept payments anywhere, anytime. <div class="findOutFull findOutArrow pull-right"><a href="mobile-payments.php" class="findOutFull">Find Out More.</a></p>
        </div>
    </div>
</div>
<div class="findOutMobile">
	<button class="mobileButton mobileBlue" onClick="window.location='mobile-payments.php'">FIND OUT MORE</button>
</div>


<div style="clear:both; height:0px;" id="capitalFeaturette"></div>
<div class="featurette white negMargin threeFifty">
    <div class="container">
    <div class="body-icon body-icon-electronic"></div>
    	<div class="leftInvoicing">
        <div class="featureHeader">
        	<h2 class="featurette-heading">Retail Payments</h2>
        </div>
        <p class="lead leadPurple">From credit and debit card processing to electronic check conversion, we offer multiple payment processing solutions to grow your business. <div class="findOutFull findOutArrow pull-left"><a href="retail-payments.php" class="findOutFull">Find Out More.</a></p></div>
</div>
    <div class="electronicPayments pull-right"></div>
    </div>
</div>
<div class="findOutMobile">
	<button class="mobileButton mobilePurple" onClick="window.location='retail-payments.php'">FIND OUT MORE</button>
</div>


<!-- /END THE FEATURETTES -->

<!-- FOOTER -->
<!--<div class="footerGap"></div>-->
<div class="footerFull">
  <div class="container">
    <div class="row">
    	<div class="span2">
        <p class="footerLead">SOLUTIONS</p>
        <a class="footerLinks" href="/payment-gateway.php">Payment Gateway API</a><br>
        <a class="footerLinks" href="/mobile-payments.php">Mobile Payments API</a><br>
        <a class="footerLinks" href="/retail-payments.php">Merchant Account Integration</a><br />
        <a class="footerLinks" href="/online-registration.php">Online Registration API</a><br>
        <a class="footerLinks" href="/online-invoicing.php">Online Invoicing API</a><br>
        <a class="footerLinks" href="/working-capital.php">Working Capital</a><br>
        <a class="footerLinks" href="/developers/icode.php">Shopping Cart Integration</a>
      </div>
      <div class="span2">
        <p class="footerLead">INDUSTRY SOLUTIONS</p>
        <a class="footerLinks" href="/b2b/">B2B</a><br>
        <a class="footerLinks" href="/e-commerce/">E-Commerce</a><br>
        <a class="footerLinks" href="/retail/">Retail</a><br>
        <a class="footerLinks" href="/non-profit/">Non-Profit</a><br>
        <a class="footerLinks" href="/restaurant/">Restaurant</a><br>
        <a class="footerLinks" href="/home-care/">Home Care</a><br>
        <a class="footerLinks" href="/partners/association-partners.php">Associations</a><br>
      </div>
      <div class="span2">
        <p class="footerLead">COMPANY</p>
        <a class="footerLinks" href="/overview.php">Overview</a><br>
        <a class="footerLinks" href="/careers/">Careers</a><br>
        <a class="footerLinks" href="/our-culture.php">Our Culture</a><br>
        <a class="footerLinks" href="/core-values.php">Core Values</a><br>
        <a class="footerLinks" href="/partners/">Partners</a><br>
        <a class="footerLinks" href="http://insights.payscape.com/" target="_blank">Blog-O-Scape</a><br>
        <a class="footerLinks" href="/media/">Media</a>
      </div>
      <div class="span2">
        <p class="footerLead">CLIENT TOOLS</p>
        <a class="footerLinks" href="http://www.shopmerchantsupplies.com/sf8/CustomerSignIn.aspx?m=PayscapeAdvisorsGrp1&g=Axces4Payscape" target="_blank">Order Materials</a><br>
        <a class="footerLinks" href="https://secure.nmi.com/merchants/login.php" target="_blank">Merchant Login</a><br />
        <a class="footerLinks" href="https://www.firstview.net/PayscapeAdvisors/" target="_blank">Statement Login</a><br />
        <a class="footerLinks" href="https://payscapeadvisors.trustkeeper.net/pcismart/" target="_blank">PCI Compliance</a><br />
        <a class="footerLinks" href="https://www.pcisecuritystandards.org/" target="_blank">PCI Security Standards</a><br />
        <p class="footerLead">ACCOUNT MANAGER</p>
        <a class="footerLinks" href="https://www.dailydashboard.net/" target="_blank">Daily Dashboard Login</a><br>
        <a class="footerLinks" href="https://p3.payscapeadvisors.com/psa/index.php?action=Login&module=Users" target="_blank">P3 Login</a>
      </div>
      <div class="span2 text-center">
        <img src="assets/img/payscape_footer_logo.png" />
      </div>
      <div class="span2">
        <p class="footerLead">CONTACT US</p>
        <p class="footerLinks">Tel: 1.888.351.6565<br>
        Fax: 404.350.6564<br>
        <a class="footerLinks" href="mailto:info@payscape.com">info@payscape.com</p></a>
        <p class="footerLead">CORPORATE</p>
        <p class="footerLinks">729 Lambert Dr.<br>
        Atlanta, GA 30324</p>
        <div class="socialIconsFull">
          <div class="socialFacebook" onClick="window.open('https://www.facebook.com/payscape','_blank');"></div>
          <div class="socialLinkedIn" onClick="window.open('http://www.linkedin.com/company/payscape-advisors','_blank');"></div>
          <div class="socialTwitter" onClick="window.open('https://twitter.com/_Payscape','_blank');"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="span12">
        <div class="footerMice">
          <p>Copyright &copy; 2013 Payscape Advisors. Payscape Advisors is a registered ISO/MSP of Fifth Third Bank, Cincinnati, OH.</p>
        </div>
      </div>
    </div> 
  </div>
</div>

<div class="footerMobile">
  <div class="container">
    <div class="row">
      <div class="span12 text-center">
        <img src="/assets/img/payscape_footer_logo.png" />
      </div>
    </div>
    <div class="row">
      <div class="span12 text-center">
        <p class="footerLead">CONTACT US</p>
        <p class="footerLinks">Tel: 1.888.351.6565<br>
        Fax: 404.350.6564<br>
        <a class="footerLinks" href="mailto:info@payscape.com">info@payscape.com</p></a>
      </div>
    </div>
    <div class="row">
      <div class="span12 text-center">
        <p class="footerLead">CLIENT TOOLS</p>
        <a class="footerLinks" href="http://www.shopmerchantsupplies.com/sf8/CustomerSignIn.aspx?m=PayscapeAdvisorsGrp1&g=Axces4Payscape" target="_blank">Order Materials</a><br>
        <a class="footerLinks" href="https://secure.nmi.com/merchants/login.php" target="_blank">Merchant Login</a><br />
        <a class="footerLinks" href="https://www.firstview.net/PayscapeAdvisors/" target="_blank">Statement Login</a><br />
        <p class="footerLead">ACCOUNT MANAGER</p>
        <a class="footerLinks" href="https://www.dailydashboard.net/" target="_blank">Daily Dashboard Login</a><br>
        <a class="footerLinks" href="https://p3.payscapeadvisors.com/psa/index.php?action=Login&module=Users" target="_blank">P3 Login</a>
      </div>  
    </div>
    <div class="row">
      <div class="span12 text-center">
        <div class="footerMice">
          <p>Copyright &copy; 2013 Payscape Advisors. Payscape Advisors is a registered ISO/MSP of Fifth Third Bank, Cincinnati, OH.</p>
        </div>
      </div>
    </div> 
  </div>
</div>


 

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster 

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap-transition.js"></script>
<script src="../assets/js/bootstrap-alert.js"></script>
<script src="../assets/js/bootstrap-modal.js"></script>
<script src="../assets/js/bootstrap-dropdown.js"></script>
<script src="../assets/js/bootstrap-scrollspy.js"></script>
<script src="../assets/js/bootstrap-tab.js"></script>
<script src="../assets/js/bootstrap-tooltip.js"></script>
<script src="../assets/js/bootstrap-popover.js"></script>
<script src="../assets/js/bootstrap-button.js"></script>
<script src="../assets/js/bootstrap-collapse.js"></script>
<script src="../assets/js/bootstrap-carousel.js"></script>
<script src="../assets/js/bootstrap-typeahead.js"></script>-->

<script src="assets/js/jquery-1.7.1.min.js"></script>
<script src="assets/js/bootstrap.js"></script>

<script type="text/javascript">
$('#invoicingModal').on('show', function () {
  $('div.modal-body').html('<iframe width="640" height="360" src="http://www.youtube.com/embed/idYsDSSjiQg?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');  
});
$('#invoicingModal').on('hide', function () {
  $('div.modal-body').html('');  
});
$('#careersVideoModal').on('show', function () {
  $('div.modal-body').html('<iframe width="640" height="360" src="http://www.youtube.com/embed/bnwg_BQmOWk?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');  
});
$('#careersVideoModal').on('hide', function () {
  $('div.modal-body').html('');  
});
$('#careersBeachModal').on('show', function () {
  $('div.modal-body').html('<iframe width="640" height="360" src="http://www.youtube.com/embed/lt-RYzmLjEc?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');  
});
$('#careersBeachModal').on('hide', function () {
  $('div.modal-body').html('');  
});
$('#partnersVideoModal').on('show', function () {
  $('div.modal-body').html('<iframe width="640" height="360" src="http://www.youtube.com/embed/IvREbPTTyFQ?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');  
});
$('#partnersVideoModal').on('hide', function () {
  $('div.modal-body').html('');  
});

  !function ($) {
	$(function(){
	  // carousel demo
	  $('#myCarousel').carousel()
	})
  }(window.jQuery)
  
	$(document).ready(function() {
	});
	$('#improved .head').click(function(e){
		e.preventDefault();
		$(this).closest('li').find('.content').not(':animated').slideToggle();
	});
	
</script>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9671709-1");
pageTracker._trackPageview();
} catch(err) {}</script>


<!-- Social Sharing -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

 
	</body>
</html>