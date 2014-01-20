#Payscape Gateway CakePHP Developers Suite
Rapid eCommerce development with CakePHP and the Payscape Gateway.
Includes examples for all of the methods in the Payscape Gateway Direct Post API 
and their success responses. 

Controllers, Views and Forms are included to jump start your development
Utilizes the CakePHP framework for rapid web development.
Built with the latest release of Twitter Bootstrap for Responsive web development.

Database schema included in /schema/transactions.sql to create the table that saves transactions and their details.

## Requirements
* PHP 5.2.8 or greater
* Database server in one of these flavors 
*mySQL 4.2 or greater, PostgreSQL, Microsoft SQL Server or SQLite*
* cURL - if you wish to use cURL posts, or you may opt to use the native Cake HTTPSocket for your posts.

## Installation 
### Clone With GIT
* Open your command line interface
* Navigate to the directory where you want to create your application
* Run the following command to install Payscape Gateway CakePHP Developers Suite, including the Payscape Gateway CakePHP Plugin.
* That dot . at the end will install the repo within the current directory
* --recursive pulls the Payscape Gateway CakePHP Plugin submodule when you clone the Developers Suite supermodule  
```
git clone --recursive https://github.com/Payscape/Payscape-Gateway-CakePHP-Developers-Suite.git . 
```

### Download the ZIP File
* Download the ZIP file to your machine from here: https://github.com/Payscape/Payscape-Gateway-CakePHP-Developers-Suite/archive/master.zip
* Unzip the archive and copy it to your local development server.

### Configuration
* Edit /Config/database.php for your database connection 
* Copy /Plugin/Payscape/Config/payscape.php to your /app/Config folder
* Edit payscape.php for your Payscape username and password
* Make sure that your /app/tmp directory is writable. 

## Database
Import schema/transactions.sql into your database
 	  
	
## Payscape Gateway CakePHP Plugin v3.0
See the readme.md file in the Payscape Plugin for examples of the methods available in the Payscape Gateway.

## cURL notes	  
/webroot/crt/cacert.pem is included so that you may use cURL. 
You may also download this file at the cURL website http://curl.haxx.se/ca/cacert.pem  
	  
You may use either cURL or Cake's HTTPSocket for your send() function.
Both are included here. 
	
##Features	  
* Sale() detects if your transaction is Credit Card or eCheck and sends the correct params 
* Two send() methods are included, one that uses Cake's HTTPSocket, as well as one that uses cURL.
* To use the Cake HTTPSocket version, simply rename sendHTTPSocket() to send(), and the current send() to sendcURL(). 
* Payscape Gateway CakePHP Plugin exposes all of the methods of the Payscape NMI API
* See Payscape Direct Post API Documentation for complete notes on variables: http://payscape.com/developers/direct-post-api.php *Direct Post API / Documentation / Transaction Variables*
	  
## Transactions available
* Sale - credit card transaction
* Sale - eCheck ACH transaction
* Validate - credit card validation
* Update - update Shipping Information for a credit card transaction
* Auth - authorize a credit card tansaction
* Capture - capture a previously autorized credit card transaction
* Refund - refund amounts for credit card transaction
* Credit - credit a credit card transaction
* Void - void credit card transaction
* See the readme.md file in /app/Plugin/Payscape for examples of these transactions.
 	  
*1/20/2014*