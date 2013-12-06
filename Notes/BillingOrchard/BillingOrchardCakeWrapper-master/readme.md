# BillingOrchard Wrapper v.1 #

A CakePHP Component that will interact with the BillingOrchard.com API.
Allows for exchanges with all relevent database tables through Add, Edit, View, and Delete Functions.

## Requirements ##

* PHP 5.3.3
* CakePHP 2

## Compatibility ##

* v.1 - CakePHP 2, PHP 5.3

## Features ##

* View BillingOrchard Users
* Add, Edit, View and Delete BillingOrchard Clients
* Add, Edit, View and Delete BillingOrchard HourlyServices
* Add, Edit, View and Delete BillingOrchard Invoices
* Add and View BillingOrchard Payments
* Add, Edit, View and Delete BillingOrchard BilledMisc
* Add, Edit, View and Delete BillingOrchard MiscItems
* Add, Edit, View and Delete BillingOrchard Subscribers
* Add, Edit, View and Delete BillingOrchard RecurringBilling

## Installation ##

1. Copy BillingOrchardComponent.php to app/Controllers/Components/
2. From your BillingOrchard.com account settings, retrieve and update the ApiKey and UserID in BillingOrchardComponent.php.
3. In your controller add public $components = array('BillingOrchard');

##Documentation##
All of the primary function for the BillingOrchard.com API are included in this wrapper. Full field definitions can be found at http://billingorchard.com/api_documentation.cfm. Field naming conventions and required fields are included inside each of the Add functions. All data is returned from BillingOrchard's API as a JSON string and is converted to an Array that can then be parsed by the controller. The following convention is universal to all available functions. 

Example Add Client:
```
$client = array(
	'ClientLogin' => 'ClientLoginName',
	'ClientPassword' => 'Password',
	'Client' => 'Actual Client Name',
	'Email' => 'full@emailaddress.com'
);
$this->BillingOrchard->AddClients($client);
```
Example Edit Client:
```
$client = array(
	'ClientID' => 7893 //Sample,
	'Tel' => '777-777-7777',
	'Address' => '123 Address Street',
	'Address2' => 'APT 123',
	'City' => 'GreatCity',
	'State' => 'GA'
);
$this->BillingOrchard->EditClients($client);
```
Example View Client:
```
$this->BillingOrchard->ViewClients(7893); //ID is optional
```
Example Delete Client:
```
$this->BillingOrchard->DeleteClients(7893); //ID is required
```
