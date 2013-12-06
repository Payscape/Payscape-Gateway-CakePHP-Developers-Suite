// we have this working from within our view
// and it performs nicely just like this. 

/*
 * with a timer
 * */

$("document").ready(function (){ 
       $(function(){
    	    setTimeout(function(){
    	    	$("#Invite").click();  
    	    },10000); // 10 seconds
});
       
       /*
        * with a cookie and a timer
        * 
        */*/
        
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