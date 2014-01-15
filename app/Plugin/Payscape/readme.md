
#Payscape Direct Post API CakePHP Plugin v3.0
	  
## Set Up	  
* Place this Plugin in your app/Plugin directory.
* Edit Config/payscape.php:
	  userid = your Payscape username
	  userpass = your Payscape password
* Move /Config/payscape.php to your /app/Config folder.
	  
* Load the Plugin in your Config/bootstrap file. 
```	  
CakePlugin::load('Payscape');
```	  
* Include the Payscape Component in your Controller 
```
public $components = array('Payscape.Payscape');
```	  

## cURL Notes
* /webroot/crt/cacert.pem is included so that you may use cURL. 
	  
* You may use either cURL or Cake's HTTPSocket for your send() function.
* Both are included here. 
	  
# Features	  
* Sale() detects if your transaction is Credit Card or eCheck and sends the correct params 
* Two send() methods are included, one that uses Cake's HTTPSocket, as well as one that uses cURL.
* To use the Cake HTTPSocket version, simply rename sendHTTPSocket() to send(), and the current send() to sendcURL(). 
	  
* Payscape Gateway CakePHP Plugin exposes all of the methods of the Payscape NMI API
	  
* See Payscape Direct Post API Documentation for complete notes on variables here http://payscape.com/developers/direct-post-api.php
* See the Payscape CakePHP Developers Suite for examples of each of the methods.
	  
1/15/2014
	  
