<script>
$("document").ready(function (){ 
	
       if (document.cookie.indexOf('visited=true') == -1) {

			var interLude = 1000*60*60*24;
			var expires = new Date((new Date()).valueOf() + interLude);
			document.cookie = "visited=true;expires=" + expires.toUTCString();
		    $(function(){
		        setTimeout(function(){
		        	$("#Invite").click();
		    	  },10000); // 10 seconds
		
		    });
		}

});
</script>