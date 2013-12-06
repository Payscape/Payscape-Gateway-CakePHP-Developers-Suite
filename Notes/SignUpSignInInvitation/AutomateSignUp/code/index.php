<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Papermashup.com | Cufon Font Replacement</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

	<!-- Color Box CSS -->
	<link media="screen" rel="stylesheet" target="_blank" href="css/colorbox.css" />
    <!-- Style For the Subscription Box -->
	<link media="screen" rel="stylesheet" target="_blank" href="css/popup.css" />
    <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js" type="text/javascript"></script>
    <script language="javascript" src="js/colorbox.js"></script>
    
<script>

$("document").ready(function (){ 

       // load the overlay

        if (document.cookie.indexOf('visited=true') == -1) {
			//var fifteenDays = 1000*60*60*24*15;
			var fifteenDays = 1000*60; // one minute
			var expires = new Date((new Date()).valueOf() + fifteenDays);
			document.cookie = "visited=true;expires=" + expires.toUTCString();
			$.colorbox({width:"580px", inline:true, href:"#subscribe_popup"});
		}
		
	//	$(".open_popup").colorbox({width:"580px", inline:true, href:"#subscribe_popup"});
	    $(function(){
	        setTimeout(function(){
	      		$(".open_popup").colorbox({open:true, width:"580px", inline:true, href:"#subscribe_popup"});
	        },5000); // 5 seconds
	    });
 });


</script>
</head>
<body>

<?php include '../includes/header.php';
 $link = '| <a href="http://papermashup.com/using-cufon-font-replacement/">Back To Tutorial</a>';
?>

<p>The subscription popup will activate if no cookie is set. Once the popup is closed a cookie is set which expires every 15 days. You can manually activate the subscription box below.</p>

<a href="#" class="open_popup">Click here to open the popup</a>

<!-- This contains the hidden content for inline calls for the subscribe box -->
<div style='display:none'>
  <div id='subscribe_popup' style='padding:10px;'>
    <h2 class="box-title">Never miss an update from Papermashup</h2>
    <h3 class="box-tagline">Get notified about the latest tutorials and downloads.</h3>
    <!-- BEGIN #subs-container -->
    <div id="subs-container" class="clearfix">
      <!-- BEGIN .box-side -->
      <div class="box-side left">
        <div class="box-icon"><a class="email" target="_blank" href="http://feedburner.google.com/fb/a/mailverify?uri=AshleyFord-Papermashupcom&loc=en_US"><img src="images/email.png"/></a></div>
        <h4><a target="_blank" href="http://feedburner.google.com/fb/a/mailverify?uri=AshleyFord-Papermashupcom&loc=en_US">Subscribe by Email</a></h4>
        <h5>Get alerts directly into your inbox after each post and stay updated.</h5>
        <a class="sub" target="_blank" href="http://feedburner.google.com/fb/a/mailverify?uri=AshleyFord-Papermashupcom&loc=en_US" title="Subscribe Now!">Subscribe</a>
        <!-- END .box-side -->
      </div>
      <div id="box-or">OR</div>
      <!-- BEGIN .box-right -->
      <div class="box-side right">
        <div class="box-icon"><a class="rss" target="_blank" href="http://feeds2.feedburner.com/AshleyFord-Papermashupcom"><img src="images/rss.png"/></a></div>
        <h4><a target="_blank" href="http://feeds2.feedburner.com/AshleyFord-Papermashupcom">Subscribe by RSS</a></h4>
        <h5>Add our RSS to your feedreader to get regular updates from us.</h5>
        <a class="sub" target="_blank" href="http://feeds2.feedburner.com/AshleyFord-Papermashupcom" title="Subscribe Now!">Subscribe</a>
        <!-- END .box-side -->
      </div>
      <!-- BEGIN #subs-container -->
    </div>
  </div>
</div>
<!-- END subscribe popup-->

<?php include '../includes/footer.php';?>

</body>
</html>
