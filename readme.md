
#Payscape Gateway CakePHP Developers Suite#
============================================
	 
Includes examples for all of the methods in the Payscape Gateway Direct Post API

##Configuration 
1. Create the table `transactions` in your database. 
2. Import schema/transactions.sql into your database
3. Edit config.php for your base URL.
4. Edit db-config.php for your database credentials.
 	  
	
##Payscape Direct Post API CakePHP Plugin v3.0
	  
1. Place the Payscape plugin folder in your app/Plugin directory. 
2. Place Payscape/Config/payscape.php in your /app/Config folder
3. Edit userid: replace with your User ID from your Payscape account
4. Edit userpass: replace with your Password from your Payscape account
	  
	  
Load the Plugin in your Config/bootstrap file. 
```
CakePlugin::load('Payscape');
```	  
Include the Payscape Component in your Controller 
```
public $components = array('Paginator', 'Session', 'Payscape.Payscape');
```
	  
/webroot/crt/cacert.pem is included so that you may use cURL. 
You may also download this file at the cURL website http://curl.haxx.se/ca/cacert.pem 
	 
	  
You may use either cURL or Cake's HTTPSocket for your send() function.
Both are included here. 
	  
Sale() detects if your transaction is Credit Card or eCheck and sends the correct params 
Two send() methods are included, one that uses Cake's HTTPSocket, as well as one that uses cURL.
To use the Cake HTTPSocket version, simply rename sendHTTPSocket() to send(), and the current send() to sendcURL(). 
	  
	  
Add 'Payscape' to your array of components in your Controller, or AppController 
to make the Class available for all of your Controllers
	  
Payscape Gateway CakePHP Plugin exposes all of the methods of the Payscape NMI API
	  
See Payscape Direct Post API Documentation for complete notes on variables:
	  
*Direct Post API / Documentation / Transaction Variables*
http://payscape.com/developers/direct-post-api.php
	  
##Features## 
* Sale - credit card transaction
* Sale - eCheck ACH transaction
* Validate - credit card validation
* Update - update Shipping Information for a credit card transaction
* Auth - authorize a credit card tansaction
* Capture - capture a previously autorized credit card transaction
* Refund - refund amounts for credit card transaction
* Credit - credit a credit card transaction
* Void - void credit card transaction
 	  
1/15/2014
	  
	 