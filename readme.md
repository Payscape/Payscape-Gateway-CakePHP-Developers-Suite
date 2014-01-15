
#Payscape Gateway CakePHP Developers Suite#
Rapid eCommerce development with CakePHP and the Payscape Gateway.
Includes examples for all of the methods in the Payscape Gateway Direct Post API 
and their success responses. 

Controllers, Views and Forms are included to assist your development

Build with the latest release of Twitter Bootstrap for Responsive web development.

Database schema included builds the table that saves transactions and their details.

## Requirements
* PHP 5.2.8 or greater
* Database server in one of these flavors:
** mySQL 4.2 or greater
** PostgreSQL
** Microsoft SQL Server
** SQLite
* cURL if you wish to use cURL posts, or you may opt to use the native Cake HTTPSocket for your posts.

## Database
Import schema/transactions.sql into your database
 	  
	
##Payscape Gateway CakePHP Plugin v3.0
	  
1. Place the Payscape plugin folder in your app/Plugin directory. 
2. Move Payscape/Config/payscape.php to your /app/Config folder
3. Edit payscape.php userid: replace with your User ID from your Payscape account
4. Edit payscape.php userpass: replace with your Password from your Payscape account
5. Load the Plugin in your Config/bootstrap file. 
```
CakePlugin::load('Payscape');
```	  
6. Include the Payscape Component in your Controller 
```
public $components = array('Paginator', 'Session', 'Payscape.Payscape');
```
See the readme.md file in the Payscape Plugin for examples of the methods available in the Payscape Gateway

## cURL notes	  
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
	  
	 